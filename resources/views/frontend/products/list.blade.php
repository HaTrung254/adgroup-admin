@extends('frontend.layouts.master')
@section('content')
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate fadeInUp ftco-animated">
                    @if(!empty($keySearch))
                        <span style="color: #423f3b">@trans('title.find_1') {{ count($products) }} @trans('title.find_2_product')</span>
                    @elseif(count($products) == 0)
                        <span style="color: #423f3b">@trans('title.update_product')</span>
                    @endif
                    @foreach($products as $key => $item)
                        @if($key != 0  && $key % 3 == 0)
                            </div>
                        @endif
                        @if($key % 3 == 0)
                            <div class="row" style="margin-top: 30px">
                        @endif
                            <div class="col col-md-4">
                                <a href="{{ routeLangWithParams('product_detail', [$item->cate_url, $item->url]) }}">
                                    <div class="card prd-card">
                                        <img src="@asset('/'. $item->image_url)" alt="" class="card-img-top">
                                        <div class="card-body text-center">
                                            <h5 class="card-title" style="font-size: 1rem"><b>{{ $item->title }}</b></h5>
                                            <span>@trans('title.price'): @if(!empty($item->price)) {{ number_format($item->price) }} @trans('title.money') @else @trans('title.dangcapnhat') @endif</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @if($key == count($products) - 1)
                            </div>
                        @endif
                    @endforeach
                    <div class="row front-pagination">
                        {{ $products->links() }}
                    </div>
            </div>
            <div class="col-lg-4 sidebar ftco-animate fadeInUp ftco-animated">
                    <div class="sidebar-box">
                        <form action="{{ routeLang('product_list') }}" method="post" class="search-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <span class="icon ion-ios-search"></span>
                                <input type="text" name="key" value="@if(!empty($keySearch)) {{ $keySearch }} @endif" class="form-control" placeholder="@trans('title.search_enter')">
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
                        <h3 class="heading"> <strong>@trans('title.danhmucsanpham')</strong></h3>
                        <ul class="categories">
                            <li><a href="{{ routeLang('product_list') }}">@trans('title.all')</a></li>
                            @foreach($productCates as $item)
                                <li><a href="{{ routeLangWithParams('product_cate_list', $item->url) }}">{{ $item->title }} <span>({{ $item->product_count }})</span></a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
                        <h3 class="heading"><strong>@trans('title.gioithieu')</strong></h3>
                        <p>@trans('title.company_des')</p>
                    </div>
                </div>
        </div>
    </section>
@endsection
