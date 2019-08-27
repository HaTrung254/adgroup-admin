@extends('frontend.layouts.master')
@section('content')
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate fadeInUp ftco-animated">
                    @foreach($products as $key => $item)
                        @if($key % 3 == 0)
                            <div class="row" style="margin-top: 30px">
                        @endif
                            <div class="col col-md-4">
                                <div class="card prd-card">
                                    <img src="@asset('/'. $item->image_url)" alt="" class="card-img-top">
                                    <div class="card-body">
                                        <hr>
                                        <h5 class="card-title" style="font-size: 1rem; text-align: center">{{ $item->title }}</h5>
                                    </div>
                                </div>
                            </div>
                        @if($key % 3 == 0)
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="col-lg-4 sidebar ftco-animate fadeInUp ftco-animated">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon ion-ios-search"></span>
                                <input type="text" class="form-control" placeholder="Tìm kiếm">
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
                        <h3 class="heading"> <strong>Danh mục sản phẩm</strong></h3>
                        <ul class="categories">
                            @foreach($productCates as $item)
                                <li><a href="#">{{ $item->title }} <span>({{ $item->product_count }})</span></a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
                        <h3 class="heading"><strong>Giới thiệu</strong></h3>
                        <p>Lời giới thiệu ngắn về an dương</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
