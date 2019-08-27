@extends('frontend.layouts.master')
@section('content')
    <!-- home slider -->
    <section id="home-section" class="hero">
        <div class="home-slider js-fullheight owl-carousel">
            @foreach($sliders as $item)
            <div class="slider-item js-fullheight">
                <div class="overlay"></div>
                <div class="container p-0">
                    <div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end"
                         data-scrollax-parent="true">
                        <div class="one-third order-md-last js-fullheight">
                            <img src="@asset($item->image_url)" alt="" style="height: 100%; width: auto;">
                        </div>
                        <div class="one-forth d-flex js-fullheight align-items-center ftco-animate"
                             data-scrollax=" properties: { translateY: '70%' }">
                            <div class="text">
                                <span class="subheading"><strong>{{ $item->vertical_title }}</strong></span>
                                <div class="horizontal">
                                    <h3 class="vr">{{ $item->horizontal_title }}</h3>
                                    <h1 class="mb-4 mt-3">
                                        {{ $item->title }} <br><span>{{ $item->sub_title }}</span>
                                        </h1>
                                    <div style="max-height: 100px">{!! $item->content !!}</div>
                                    <p><a href="#" class="btn btn-primary px-5 py-3 mt-3">Xem thêm</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </section>
    <!-- end home slider -->

    <!-- featured product slider -->
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">{{ __('title.noibat') }}</h2>
                    <p class="text-black">{{ __('title.noibat_description') }}</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="owl-carousel owl-theme prd-slider">
                @foreach($noibatProduct as $product)
                <div class="card">
                    <a href="#">
                        <img src="@asset('/'.$product->image_url)" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center"> <strong>{{ $product->title }}</strong></h5>
                            <p class="card-text">Ảnh ở chế độ chân không cao : 3nm - 8 nm</p>
                            <p class="card-text text-black">Giá bán: {{ !empty($product->price) ? number_format($product->price). "đ" : "Liên hệ" }}</p>
                            <a href="" class="card-link btn btn-primary center">Liên Hệ Ngay</a>
                        </div>
                    </a>
                </div>
                @endforeach
                {{--<div class="card">--}}
                    {{--<a href="#">--}}
                        {{--<img src="@asset('/front-end/images/sem.jpg')" alt="" class="card-img-top">--}}
                        {{--<div class="card-body">--}}
                            {{--<h5 class="card-title" style="text-align: center"> <strong> Prisma e SEM </strong></h5>--}}
                            {{--<p class="card-text">Ảnh ở chế độ chân không cao : 3nm - 8 nm</p>--}}
                            {{--<p class="card-text text-black">Giá bán: 1đ</p>--}}
                            {{--<a href="" class="card-link btn btn-primary center">Liên Hệ Ngay</a>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            </div>
            <h4 class="center text-white"><a href="">Xem tất cả &#8594</a></h4>
        </div>
    </section>
    <!-- end featured prroduct slider -->

    <!-- available product slider -->
    <section class="ftco-section bg-dark">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4 text-white">Sản phẩm sẵn có</h2>

                    <p class="text-white">Những thiết bị hàng đầu phục vụ cho công tác nghiên cứu trong phòng thí
                        nghiệm cũng như ứng dụng trong công nghiệp</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="owl-carousel owl-theme prd-slider">
                <div class="card">
                    <a href="#">
                        <img src="images/sem.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center"> <strong> Prisma e SEM </strong></h5>
                            <p class="card-text">Ảnh ở chế độ chân không cao : 3nm - 8 nm</p>
                            <p class="card-text text-black">Giá bán: 1đ</p>
                            <a href="" class="card-link btn btn-primary center">Liên Hệ Ngay</a>
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a href="#">
                        <img src="images/sem.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center"> <strong> Prisma e SEM </strong></h5>
                            <p class="card-text">Ảnh ở chế độ chân không cao : 3nm - 8 nm</p>
                            <p class="card-text text-black">Giá bán: 1đ</p>
                            <a href="" class="card-link btn btn-primary center">Liên Hệ Ngay</a>
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a href="#">
                        <img src="images/sem.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center"> <strong> Prisma e SEM </strong></h5>
                            <p class="card-text">Ảnh ở chế độ chân không cao : 3nm - 8 nm</p>
                            <p class="card-text text-black">Giá bán: 1đ</p>
                            <a href="" class="card-link btn btn-primary center">Liên Hệ Ngay</a>
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a href="#">
                        <img src="images/sem.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center"> <strong> Prisma e SEM </strong></h5>
                            <p class="card-text">Ảnh ở chế độ chân không cao : 3nm - 8 nm</p>
                            <p class="card-text text-black">Giá bán: 1đ</p>
                            <a href="" class="card-link btn btn-primary center">Liên Hệ Ngay</a>
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a href="#">
                        <img src="images/sem.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center"> <strong> Prisma e SEM </strong></h5>
                            <p class="card-text">Ảnh ở chế độ chân không cao : 3nm - 8 nm</p>
                            <p class="card-text text-black">Giá bán: 1đ</p>
                            <a href="" class="card-link btn btn-primary center">Liên Hệ Ngay</a>
                        </div>
                    </a>
                </div>
            </div>
            <h4 class="center"><a href="">Xem tất cả &#8594</a></h4>
        </div>
    </section>
    <!-- end available prroduct slider -->

    <!-- Đại diện hãng thiết bị -->
    <section class="ftco-section ftco-no-pb ftco-no-pt bg-light js-section2-height">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 non-padding-content">
                    <img src="@asset('/front-end/images/img1.png')" alt="" class="fit-image">
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="fit-image large-padding-content">
                        <div class="heading-section-bold mb-4 mt-md-5">
                            <div class="ml-md-0">
                                <h2 class="mb-4">Giới thiệu về An Dương Group</h2>
                            </div>
                        </div>
                        <div class="pb-md-5">
                            <p>But nothing the copy said could convince her and so it didn’t take long until a few
                                insidious
                                Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into
                                their

                                agency, where they abused her for their.</p>
                            <div class="row ftco-services">
                                <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                                    <div class="media block-6 services">
                                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                                            <span class="flaticon-002-recommended"></span>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="heading">Refund Policy</h3>
                                            <p>Even the all-powerful Pointing has no control about the blind texts it is
                                                an
                                                almost unorthographic.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                                    <div class="media block-6 services">
                                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                                            <span class="flaticon-001-box"></span>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="heading">Premium Packaging</h3>
                                            <p>Even the all-powerful Pointing has no control about the blind texts it is
                                                an
                                                almost unorthographic.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                                    <div class="media block-6 services">
                                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                                            <span class="flaticon-003-medal"></span>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="heading">Superior Quality</h3>
                                            <p>Even the all-powerful Pointing has no control about the blind texts it is
                                                an
                                                almost unorthographic.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end Đại diện hãng thiết bị -->

    <!-- slider các hãng đại diện -->
    <section class="ftco-section ftco-no-pb ftco-no-pt">
        <br> <br>
        <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">Các hãng đang đại diện</h2>
        </div>
        <div class="logo-slider owl-carousel owl-theme js-logo-slider-height container">
            <div class="js-logo-slider-height"><img class="" src="@asset('/front-end/images/Eppendorf-Logo.png')" alt=""></div>
            <div class="js-logo-slider-height"><img class="" src="@asset('/front-end/images/micotrac-logo.png')" alt=""></div>
            <div class="js-logo-slider-height"><img class="" src="@asset('/front-end/images/thermo-fisher-logo.png')" alt=""></div>
            <div class="js-logo-slider-height"><img class="" src="@asset('/front-end/images/thermo-fisher-logo.png')" alt=""></div>
            <div class="js-logo-slider-height"><img class="" src="@asset('/front-end/images/thermo-fisher-logo.png')" alt=""></div>
            <div class="js-logo-slider-height"><img class="" src="@asset('/front-end/images/thermo-fisher-logo.png')" alt=""></div>
            <div class="js-logo-slider-height"><img class="" src="@asset('/front-end/images/thermo-fisher-logo.png')" alt=""></div>
            <div class="js-logo-slider-height"><img class="" src="@asset('/front-end/images/thermo-fisher-logo.png')" alt=""></div>
        </div>

    </section>
    <!-- end slider các hãng đại diện -->

    <hr>
@endsection