@extends('frontend.layouts.master')
@section('content')
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate fadeInUp ftco-animated">
                    <div class="row">
                        @if(!empty($key))
                            <span style="color: #423f3b">@trans('title.find_1') {{ count($news) }} @trans('title.find_2_new')</span>
                        @endif
                        @foreach($news as $item)
                            <div class="col-md-12 d-flex ftco-animate fadeInUp ftco-animated">
                                <div class="blog-entry align-self-stretch d-md-flex">
                                    <a href="{{ routeLangWithParams('new_detail', [$item->cate_url, $item->url]) }}" class="block-20"
                                       style="background-image: url(@asset('/'.$item->image_url));">
                                    </a>
                                    <div class="text d-block pl-md-4">
                                        <div class="meta mb-3">
                                            <div><span class="icon-calendar"></span> @dateFormat($item->release_at)
                                            </div>
                                        </div>
                                        <h3 class="heading">
                                            <a href="{{ routeLangWithParams('new_detail', [$item->cate_url, $item->url]) }}">{{ $item->title }}</a>
                                        </h3>
                                        <p>{{ substr(strip_tags($item->content), 0, 100) }}...</p>
                                        <p><a href="{{ routeLangWithParams('new_detail', [$item->cate_url, $item->url]) }}"
                                              class="btn btn-primary py-2 px-3">Read more</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row front-pagination">
                        {{ $news->links() }}
                    </div>
                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate fadeInUp ftco-animated">
                    <div class="sidebar-box">
                        <form action="{{ routeLang('new_list') }}" class="search-form" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <span class="icon ion-ios-search"></span>
                                <input type="text" name="key" class="form-control" value="{{ !empty($key) ? $key : "" }}"
                                       placeholder="@trans('title.search_enter')">
                            </div>
                        </form>
                    </div>
                    @if(!empty($newCates))
                    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
                        <h3 class="heading">@trans('title.danhmuc')</h3>
                        <ul class="categories">
                            <li><a href="{{ routeLang('new_list') }}">@trans('title.all')</a>
                                </li>
                            @foreach($newCates as $item)
                                <li><a href="{{ routeLangWithParams('new_category_list', $item->url) }}">{{ $item->title }} <span>({{ $item->new_count }})</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">@trans('title.recent_blog')</h3>
                        @foreach($recentCates as $item)
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4"
                                   style="background-image: url(@asset('/'.$item['image_url']));"></a>
                                <div class="text">
                                    <h3 class="heading-1"><a href="{{ routeLangWithParams('new_detail', [$item['cate_url'], $item['url']]) }}">{{ $item['title'] }}</a></h3>
                                    <div class="meta">
                                        <div><a href="#"><span class="icon-calendar"></span>
                                                @dateFormat($item['release_at'])</a></div>
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