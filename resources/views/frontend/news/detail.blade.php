@extends('frontend.layouts.master')
@section('content')

<section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate fadeInUp ftco-animated">
			<h2 class="mb-3">{{ $new->title }}</h2>
			<span style="color:#aba6a6"><span class="icon-calendar"></span> @dateFormat($new->release_at)</span>
          	{!! $new->content !!}

          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate fadeInUp ftco-animated">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon ion-ios-search"></span>
                  <input type="text" class="form-control" placeholder="@trans('title.search_enter')">
                </div>
              </form>
            </div>
            <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
            	<h3 class="heading">@trans('title.danhmuc')</h3>
              <ul class="categories">
              	@foreach($newCates as $item)
                	<li><a href="{{ route('new_category_list', $item->id) }}">{{ $item->title }} <span>({{ $item->new_count }})</span></a></li>
                @endforeach
              </ul>
            </div>

            <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
              	<h3 class="heading">@trans('title.recent_blog')</h3>
              	@foreach($recentCates as $item)
				<div class="block-21 mb-4 d-flex">
					<a href="{{ route('new_detail', $item->id) }}" class="blog-img mr-4" style="background-image: url(@asset('/'.$item->image_url));"></a>
					<div class="text">
						<h3 class="heading-1"><a href="{{ route('new_detail', $item->id) }}">{{ $item->title }}</a></h3>
						<div class="meta">
							<div><span class="icon-calendar"></span> @dateFormat($item->release_at)</div>
						</div>
					</div>
				</div>
				@endforeach
            </div>
      	</div>

        </div>
      </div>
    </section>
@endsection