@include('layout.header')

  <div class="container-fluid px-0 mx-0 ">
        <!-- .................Home Page NavBar Start ......................... -->

                  @include('layout.admin_navbar')

        <!-- .................Home Page NavBar End ......................... -->

           <!-- -------heading container - start -->
        <div class="container-fluid">
            <div class="row py-5 px-xl-5 justify-content-between">
                <div class="col-md-5 col-12 align-self-center">
                    <h1 class="">
                        <Strong>Setting</Strong>
                    </h1>
                </div>
            </div>
        </div>
        <!-- ------heading container - end -->

        <!-- container for All Players - start -->
        <div class="container-fluid bg-white br_47px-s mh_69vh-s">
            <div class="row pt-5 px-xl-5">
                <div class="col-12 my-3">
                    <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                        <div class="align-self-center">
                            <h6 class="mb-0"><strong>Comment</strong></h6>
                        </div>
                        <div class="align-self-center d-flex">
                            <form action="{{ route('set_post_comment_length') }}" method="post" id="post_comment_length-d">
                                @csrf
                                <div class="form-group mb-0">
                                    <input type="number" class="form-control border-0 rounded-0 post_comment-d spinner_remove-s"  name='post_comment_length' id='number_box_3' value={{ $comment->post_comment_length ?? '' }}  placeholder="300"/>
                                </div>
                                <button type="submit" class="btn bg_green-s text-white rounded-0" id="set_post_comment-d">OK</button>
                            </form>
                        </div>
                    </div>
                </div>
                {{--  <div class="col-12 my-3">
                    <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                        <div class="align-self-center">
                            <h6 class="mb-0"><strong>Comment</strong></h6>
                        </div>
                        <div class="align-self-center d-flex">
                            <div class="form-group mb-0">
                                <input type="number" class="form-control border-0 rounded-0 spinner_remove-s"  name='comment' id='number_box_3'  placeholder="300"/>
                            </div>
                            <button type="submit" class="btn bg_green-s text-white rounded-0">OK</button>
                        </div>
                    </div>
                </div>  --}}
                {{--  <div class="col-12 my-3">
                    <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                        <div class="align-self-center">
                            <h6 class="mb-0"><strong>Comment</strong></h6>
                        </div>
                        <div class="align-self-center d-flex">
                            <div class="form-group mb-0">
                                <input type="number" class="form-control border-0 rounded-0 spinner_remove-s"  name='comment' id='number_box_3'  placeholder="300"/>
                            </div>
                            <button type="submit" class="btn bg_green-s text-white rounded-0">OK</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-3">
                    <div class="d-flex bg_grey-s py-4 px-3 br_10px-s text-dark justify-content-between">
                        <div class="align-self-center">
                            <h6 class="mb-0"><strong>Comment</strong></h6>
                        </div>
                        <div class="align-self-center d-flex">
                            <div class="form-group mb-0">
                                <input type="number" class="form-control border-0 rounded-0 spinner_remove-s"  name='comment' id='number_box_3'  placeholder="300"/>
                            </div>
                            <button type="submit" class="btn bg_green-s text-white rounded-0">OK</button>
                        </div>
                    </div>
                </div>  --}}
            </div>
        </div>
        <!-- container for All Players - end -->
    </div>


@include('layout.footer')
