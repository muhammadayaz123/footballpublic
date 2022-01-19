<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Media;
use App\Models\Comment;
use App\Models\Profile;
use App\Exceptions\Handle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Filters\Video\VideoFilters;

class MediaController extends Controller
{

	public function uploadPost(Request $request){
		$validator = Validator::make($request->all(), [

            'profile_uuid' => 'required|exists:profiles,uuid',
            'type'         => 'in:photo,video,pdf',
            'media'        => 'required|file',
            'caption'      => 'required|string',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        //upload media

        $media = $this->uploadMedias($request,'media',$request->type)->getData();

        if(!$media->status)
            return sendError('Internal server error',[]);

        $media = $media->data[0];

        //check profile

        $profile = Profile::where('uuid',$request->profile_uuid)->first();

        if(NULL == $profile)
            return sendError('Invalid profile',[]);

        try{

            $upload_media = new Media;

            $upload_media->uuid            = Str::uuid();
            $upload_media->profile_id      = $profile->id;
            $upload_media->name            = $media->title;
            $upload_media->filename        = $media->filename;
            $upload_media->tag             = $media->tag;
            $upload_media->media_type      = $request->type;
            $upload_media->path            = $media->path;
            $upload_media->media_ratio     = $media->ratio;
            $upload_media->media_thumbnail = $media->thumbnail;

            //create post

            if($upload_media->save()){

                $upload_post = new Post;

                $upload_post->uuid       = Str::uuid();
                $upload_post->profile_id = $profile->id;
                $upload_post->media_id   = $upload_media->id;
                $upload_post->caption    = $request->caption;

                if(!$upload_post->save()){
                    unlink(public_path().'/'.$media->path);
                    DB::rollBack();
                    return sendError('Internal Server Error',[]);
                }

                $data['post'] = Post::where('id', $upload_post->id)->with(['media','profile'])->first();

                DB::commit();

                return sendSuccess('post',$data);

            } else {
                unlink(public_path().'/'.$media->path);
                DB::rollBack();
                return sendError('Internal Server Error',[]);
            }

        } catch(Exception $ex) {
            DB::rollBack();
            return sendError($ex->getMessage(), $ex->getTrace());
        }
	}

    public function uploadMedias(Request $request, $fieldName = 'media', $nature = 'profile_image', $multiple = false){

        $uploadedFiles = [];
        if($multiple){

            if($request->hasFile($fieldName)){

                foreach ($request->file($fieldName) as $media) {
                    $file = $media;
                    $video_xtensions = ['flv', 'mp4', 'mpeg', 'mkv', 'avi'];
                    $image_xtensions = ['png', 'jpg', 'jpeg', 'gif', 'bmp'];
                    $doc_xtensions   = ['pdf'];
                    $allowedFilesExtensions = array_merge($video_xtensions, $image_xtensions, $doc_xtensions);

                    $file_extension = $file->getClientOriginalExtension();

                    if (in_array($file_extension, $allowedFilesExtensions)) {

                        $temp['title'] = $file->getClientOriginalName();
                        $temp['tag']   = $nature;
                        $temp['type']  = (in_array($file_extension, $doc_xtensions))? 'pdf' : 'image';

                        $targetName = $nature . rand(1000, 9999) . '.' . $file_extension;
                        $temp['filename'] = $targetName;

                        // upoad file on server
                        $file->move(getUploadDir($nature), $targetName);
                        $targetPath = getUploadDir($nature).$targetName;
                        $temp['path'] = 'uploads/'.$nature .'/'.$targetName;

                        if (in_array($file_extension, $doc_xtensions)) {
                            $temp['ratio'] = 1;
                        }else{
                            $imageSize = getimagesize($targetPath);
                            $temp['ratio'] = $imageSize[0] / $imageSize[1];
                        }

                        // generate thumbnail
                        $thumbnailFilename = $nature.'_thumbnail_' . rand(10, 999999) . '.png';

                        // dd($targetPath);
                        // $contents = \FFMpeg::openUrl($targetPath)
                        // ->export()
                        // ->addFilter(function (VideoFilters $filters) {
                        // $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
                        // })
                        // // ->disk('local')
                        // // ->save(getUploadDir($nature, true), $thumbnailFilename);
                        // ->save($thumbnailFilename);
                        // $temp['thumbnail'] = getUploadDir($nature, true) . $thumbnailFilename;

                        $temp['thumbnail'] = $temp['path'];
                        $uploadedFiles[] = array_merge($uploadedFiles, $temp);
                    }else{

                        return sendError('File Extension is not supported.', null);
                    }
                }
            }else{
                return sendError('Please provide files.', null);
            }
        } else {

            $file = $request->file($fieldName);
            // dd($file);

            $video_xtensions = ['flv', 'mp4', 'mpeg', 'mkv', 'avi'];
            $image_xtensions = ['png', 'jpg', 'jpeg', 'gif'];
            $doc_xtensions   = ['pdf'];

            $allowedFilesExtensions = array_merge($video_xtensions, $image_xtensions, $doc_xtensions);

            $file_extension = $file->getClientOriginalExtension();

            if (in_array($file_extension, $allowedFilesExtensions)) {
                $temp['title'] = $file->getClientOriginalName();
                $temp['tag'] = $nature;
                $temp['type'] = (in_array($file_extension, $doc_xtensions)) ? 'pdf' : 'image';

                $targetName = $nature . rand(1000, 9999) . '.' . $file_extension;
                $temp['filename'] = $targetName;


                // upoad file on server
                $file->move(getUploadDir($nature), $targetName);
                $targetPath = getUploadDir($nature) . $targetName;
                $temp['path'] = 'uploads/'. $nature . '/' . $targetName;
                if(false == getimagesize($targetPath)){
                    $temp['ratio'] = 1;
                }else{
                    $imageSize = getimagesize($targetPath);
                    $temp['ratio'] = $imageSize[0] / $imageSize[1];
                }

                // generate thumbnail

                // $start = \FFMpeg\Coordinate\TimeCode::fromSeconds(1);
                // $clipFilter = new \FFMpeg\Filters\Video\ClipFilter($start);

                $thumbnailFilename = $nature . '_thumbnail_' . rand(10, 999999) . '.png';
                // dd($targetPath, $thumbnailFilename);
                // $contents = FFMpeg::openUrl($targetPath)
                //     ->addFilter(function (VideoFilters $filters) {
                //         $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
                //     })
                //     ->export()
                //     ->toDisk('public')
                //     ->inFormat(new \FFMpeg\Format\Video\X264)
                //     ->save($thumbnailFilename);
                //     dd($contents);

                $contents = "/downloads -i ". $file->getClientOriginalName() . " -vf fps = 1/60 output-%03d.png";
                system($contents);
                // dd($contents);

                $temp['thumbnail'] = getUploadDir($nature, true) . $contents;
                $temp['thumbnail'] = $temp['path'];
                $uploadedFiles[] = array_merge($uploadedFiles, $temp);
            } else {
                return sendError('File Extension is not supported.', null);
            }
        }

        return sendSuccess('Success.', $uploadedFiles);
    }

    public function postComment(Request $request){

        $validator = Validator::make($request->all(), [

            'profile_uuid' => 'required_without:comment_uuid|exists:profiles,uuid',
            'post_uuid'    => 'required_without:comment_uuid|exists:posts,uuid',
            'comment'      => 'required|string',
            'comment_uuid' => 'required_without:profile_uuid|exists:comments,uuid',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $profile = Profile::where('uuid',$request->profile_uuid)->first();

        if(NULL == $profile)
            return sendError('Invalid profile',[]);

        $post = Post::where('uuid',$request->post_uuid)->first();

        if(NULL == $post)
            return sendError('Invalid post',[]);

        try {

            $comment = Comment::where('uuid',$request->comment_uuid)->first();
            if(NULL == $comment){

                $comment = new Comment;

                $comment->uuid       = Str::uuid();
                $comment->profile_id = $profile->id;
                $comment->post_id    = $post->id;

                $post->comment_count+=1;
                $post->save();
            }

            $comment->comment    = $request->comment;

            if(!$comment->save()) {

                DB::rollBack();
                return sendError('Internal Server Error',[]);
            }

            DB::commit();

            $data['comment'] = Comment::where('id',$comment->id)->with('profile')->first();

            return sendSuccess('Commented',$data);

        } catch(Exception $ex) {
            DB::rollBack();
            return sendError($ex->getMessage(), $ex->getTrace());
        }
    }

    public function postLike(Request $request){

        $validator = Validator::make($request->all(), [

            'profile_uuid' => 'required|exists:profiles,uuid',
            'post_uuid'    => 'required|exists:posts,uuid',
            'like'      => 'required|in:1,0',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $profile = Profile::where('uuid',$request->profile_uuid)->first();

        if(NULL == $profile)
            return sendError('Invalid profile',[]);

        $post = Post::where('uuid',$request->post_uuid)->first();

        if(NULL == $profile)
            return sendError('Invalid post',[]);

        try {

            $like = Like::where('profile_id',$profile->id)->where('post_id',$post->id)->first();

            if(NULL == $like){

                $like = new Like;

                $like->uuid       = Str::uuid();
                $like->profile_id = $profile->id;
                $like->post_id    = $post->id;
                $like->like       = $request->like;

                if(!$like->save()) {

                    DB::rollBack();
                    return sendError('Internal Server Error',[]);
                }

                $post->like_count+=1;
                $post->save();

                DB::commit();

                $data['like'] = Like::where('id',$like->id)->with(['profile','post'])->first();

                return sendSuccess('Liked',$data);
            }

            $post->like_count-=1;
            $post->save();

            $like->delete();

            DB::commit();

            return sendSuccess('Unliked',[]);

        } catch(Exception $ex) {
            DB::rollBack();
            return sendError($ex->getMessage(), $ex->getTrace());
        }
    }

    public function getPost(Request $request){
        $validator = Validator::make($request->all(), [

            'profile_uuid' => 'exists:profiles,uuid',
            // 'profile_id' => 'exists:profiles,id',
            'post_uuid'    => 'exists:posts,uuid',

        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        // dd($request->all(), '343');

        $post = Post::orderBy('created_at', 'DESC');

        if(isset($request->post_uuid)){

            $post = $post->where('uuid',$request->post_uuid);

            $data['post'] = $post->with(['media','comments','likes'])->first();

            return sendSuccess('post',$data);
        }

        $profile = Profile::where('uuid',$request->profile_uuid ?? $request->user()->profile->uuid)->first();

        if(NULL == $profile)
            return sendError('Invalid profile',[]);

        $post = $post->where('profile_id',$profile->id)->first();
        // dd($post);


        if($post !=Null)
        {
            $data['post'] = $post->with(['media', 'comments'])->where('profile_id', $profile->id)->get();

            return sendSuccess('post',$data);
        }
        return sendSuccess('Null', null);


    }


    public function deletePost(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'profile_id' => 'exists:users,id',
            'post_uuid'    => 'exists:posts,uuid',

        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }


        $post = Post::where('uuid', $request->post_uuid)->where('profile_id', $request->profile_id)->with(['media'])->first();
        // dd($post);


        if ($post != Null) {
           $post->delete();

            return sendSuccess('post deleted successfully', []);
        }
        return sendSuccess('post did not delete successfully', null);
    }


}
