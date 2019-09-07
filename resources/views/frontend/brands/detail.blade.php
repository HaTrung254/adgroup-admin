@extends('frontend.layouts.master')
@section('content')

<section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate fadeInUp ftco-animated text-center">
            <img style="width: 100%;margin-bottom: 10px" src="@asset('/'. $brand->image_url)">
            {!! $brand->content !!}
          </div> <!-- .col-md-8 -->
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
                    <h3 class="heading"><strong>{{ $brand->title }}</strong></h3>
                    <i style="text-align: justify;"> {{ $brand->description }} </i>
                </div>
            </div>
      </div>
    </section>
@endsection