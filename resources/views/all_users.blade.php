@include('layout.header')

{{--  @section('admin_content')  --}}
      <!-- .................More Page Start ......................... -->
    <div class="container-fluid px-0 mx-0 ">
        <!-- .................Home Page NavBar Start ......................... -->
            @include('layout.admin_navbar')
        <!-- .................Home Page NavBar End ......................... -->

        <!-- -------heading container - start -->
        <div class="container-fluid">
            <div class="row py-5 px-xl-5 justify-content-between">
                <div class="col-md-5 col-12 align-self-center">
                    <h1 class="">
                        <Strong>All Users</Strong>
                    </h1>
                </div>
            </div>
        </div>
        <!-- ------heading container - end -->

        <!-- container for All Players - start -->
        <div class="container-fluid bg-white br_47px-s mh_69vh-s">
            <div class="row pt-5 px-xl-5">
                <div class="col-12  pt-3 table-responsive">
                    <table class="table overflow-auto table-borderless">
                        <thead class="bg_green-s ">
                          <tr class="text-white">
                            <th class="col-2 mw_8_125rem-s">Name</th>
                            <th  class="col-3 mw_18_75rem-s">Address</th>
                            <th  class="col-2">Position</th>
                            <th class="col-2">Matches</th>
                            <th class="col-2" >Missed</th>
                            <th class="col-2">Amount</th>
                            <th class="col-2 mw_9_125rem-s ">Rating</th>
                            <th class="col-2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($allUsers as $user)
                                <tr>
                                    <th class=" " >
                                        <img src="{{ $user->profile->profile_image != null ? asset($user->profile->profile_image) : asset('assets/images/user_img.png') }}" class="rounded-circle" width="51" height="51" alt="user img">
                                        <span class="ml-xl-3 ml-2">{{ $user->profile->username }}</span>
                                    </th>
                                    <td  class="align-middle" >{{ $user->profile->address->address }}</td>
                                    <td class="align-middle">{{ $user->position }}</td>
                                    <td class="align-middle">{{ $user->profile->played_matches == null ? '0' : $user->profile->played_matches  }}</td>
                                    <td  class="align-middle">{{ $user->profile->missed_matches == null ? '0' : $user->profile->missed_matches}}</td>
                                    <td class="align-middle">$<span>{{ $user->profile->price }}</span></td>
                                    <td class="text-right align-middle">
                                        <p class="text-warning mb-2 ">
                                               @php
                                                    $empty_rating = 5 - round($user->profile->rating);
                                                    // var_dump($empty_rating, $profile_ratings->rating);
                                                @endphp
                                                {{-- @for ($i = 0; $i < $user->profile->rating +1; $i++) --}}
                                                @for ($i = 0; $i < round($user->profile->rating); $i++)
                                                    <i class="fas fa-star " aria-hidden="true">  </i>
                                                @endfor
                                                @for ($i = 0; $i < $empty_rating; $i++)
                                                    <i class="far fa-star " aria-hidden="true">  </i>
                                                @endfor
                                                {{ round($user->profile->rating) }}
                                                {{--  <span class="rating_textt"> ${{ $user->profile->price }} </span>  --}}

                                            {{--  <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i> 5.0  --}}
                                        </p>
                                    </td>
                                    <td class="align-middle delete_user-d">
                                        <img src="{{ asset('assets/images/delete.svg') }}" class="img-fluid delete_row-d" width="50" alt="delete">
                                        <input type="hidden" name="" class="signle_user_uuid-d" value="{{ $user->uuid}}" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        <!-- container for All Players - end -->
    </div>

{{--  @endsection  --}}

@include('layout.footer')
