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
                        @if($key != 0 && $key != count($products) - 1 && $key % 3 == 0)
                            </div>
                        @endif
                        @if($key % 3 == 0)
                            <div class="row" style="margin-top: 30px">
                        @endif
                            <div class="col col-md-4">
                                <a href="{{ route('product_detail', $item->id) }}">
                                    <div class="card prd-card">
                                        <img src="@asset('/'. $item->image_url)" alt="" class="card-img-top">
                                        <div class="card-body">
                                            <hr>
                                            <h5 class="card-title" style="font-size: 1rem; text-align: center">{{ $item->title }}</h5>
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
                        <form action="{{ route('product_search_list') }}" method="post" class="search-form">
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
                            @foreach($productCates as $item)
                                <li><a href="{{ route('product_list', $item->id) }}">{{ $item->title }} <span>({{ $item->product_count }})</span></a></li>
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
