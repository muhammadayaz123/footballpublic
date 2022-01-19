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
                        <Strong>All Stadiums</Strong>
                    </h1>
                </div>
            </div>
        </div>
        <!-- ------heading container - end -->

        <!-- container for All Players - start -->
        <div class="container-fluid bg-white br_47px-s mh_69vh-s">
            <div class="row pt-5 px-xl-5">
                @foreach ($allStadiums as $stadium)
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 py-2 px-1">
                        <div class="card br_25px-s py-3 border-0 home_card mh_188px-s ">
                            <div class="card-body py-4 text-white">
                                <h5 class="card-title">{{ $stadium->name }}</h5>
                                <h6>
                                    <i class="fa fa-map-marker mr-2" aria-hidden="true"></i>
                                    <span>{{ $stadium->address }}</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- container for All Players - end -->
    </div>


@include('layout.footer')
