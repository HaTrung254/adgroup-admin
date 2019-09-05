<div class="py-2 bg-black">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-phone2"></span>
                        </div>
                        <span class="text">+84 2438612612</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">@trans('title.tencongty')</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-paper-plane"></span></div>
                        <span class="text">info@adgroup.vn</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center text-lg-right">
                        <ul class="lang-flag">
                            <li><a href="{{ route('change_language', \App\Helpers\BaseHelper::LANG_VN) }}">
                                    <img src="{{ asset('/img/vn.jpg') }}" width="27" height="19"
                                         alt=""></a></li>
                            <li><a href="{{ route('change_language', \App\Helpers\BaseHelper::LANG_EN) }}">
                                    <img src="{{ asset('/img/eng.jpg') }}" width="27" height="19"
                                         alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--search--}}
<div class="container">
    <div class="row justify-content-end">
        <div class="col-12 col-md-10 col-lg-8 search-bar">
            <form method="post" action="{{ routeLang('product_list') }}" class="card card-sm">
                {{ csrf_field() }}
                <div class="card-body row no-gutters align-items-center">
                    <div class="col-auto">
                        <!-- <i class="fas fa-search h4 text-body"></i> -->
                        <i class="fas fa-search"></i>
                    </div>
                    <!--end of col-->
                    <div class="col">
                        <input name="key" class="form-control form-control-lg form-control-borderless" type="search"
                               placeholder="@trans('title.timkiem')">
                    </div>
                    <!--end of col-->
                    <div class="col-auto">
                        <button class="btn btn-lg btn-primary" type="submit">Search</button>
                    </div>
                    <!--end of col-->
                </div>
            </form>
        </div>
        <!--end of col-->
    </div>

</div>
</div>
{{--end-search--}}

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a href="{{ route('homepage') }}"><img src="{{ asset('/front-end/images/logo.png') }}" class="navbar-brand" href="index.html"></img></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('homepage') }}" class="nav-link">@trans('title.trangchu')</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">@trans('title.sanpham')</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                         <a class="dropdown-item" href="{{ routeLang('product_list') }}">@trans('title.all')</a>
                        @if(!empty($productCates))
                            @foreach($productCates as $item)
                                <a class="dropdown-item" href="{{ routeLangWithParams('product_cate_list', $item->url) }}">{{ $item->title }}</a>
                            @endforeach
                        @endif
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="shop.html" id="dropdown04" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">@trans('title.gioithieu')</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">@trans('title.congty')</a>
                        <a class="dropdown-item" href="#">@trans('title.nsx')</a>
                        <a class="dropdown-item" href="#">@trans('title.khach')</a>
                    </div>
                </li>
                <li class="nav-item"><a href="{{ routeLang('new_list') }}" class="nav-link">@trans('title.tintuc')</a></li>
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">@trans('title.lienhe')</a></li>
            </ul>
        </div>
    </div>
</nav>