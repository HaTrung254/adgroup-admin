@extends('frontend.layouts.master')
@section('content')
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate fadeInUp ftco-animated">
                    @if(!empty($keySearch))
                        <span style="color: #423f3b">@trans('title.find_1') {{ count($brands) }} @trans('title.find_2_product')</span>
                    @elseif(count($brands) == 0)
                        <span style="color: #423f3b">@trans('title.update_product')</span>
                    @endif
                    @foreach($brands as $item)
                        <div class="row" style="margin-top: 30px">
                            <a href="{{ routeLangWithParams('brand_detail',  $item->url) }}">
                                <div class="card prd-card" style="border:none">
                                    <img src="@asset('/'. $item->image_url)" alt="" class="card-img-top">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><b>{{ $item->title }}</b></h5>
                                        <span> {{ $item->description }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="row front-pagination">
                        {{ $brands->links() }}
                    </div>
            </div>
            <div class="col-lg-4 sidebar ftco-animate fadeInUp ftco-animated">
                <div class="sidebar-box">
                    <form action="{{ routeLang('brand_list') }}" method="post" class="search-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <span class="icon ion-ios-search"></span>
                            <input type="text" name="key" value="@if(!empty($keySearch)) {{ $keySearch }} @endif" class="form-control" placeholder="@trans('title.search_enter')">
                        </div>
                    </form>
                </div>

                <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
                    <h3 class="heading"><strong>@trans('title.gioithieu')</strong></h3>
                    <p>@trans('title.company_des')</p>
                </div>
            </div>
        </div>
    </section>
@endsection
