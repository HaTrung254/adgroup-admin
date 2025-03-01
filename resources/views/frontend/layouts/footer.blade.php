<footer class="ftco-footer bg-light ftco-section">
    <div class="container">
        <div class="row">
            <div class="mouse">
                <a href="#" class="mouse-icon">
                    <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">AD Group</h2>
                    <p>@trans('title.company_des')</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Menu</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ routeLang('product_list') }}" class="py-2 d-block">@trans('title.sanpham')</a></li>
                        <li><a href="#" class="py-2 d-block">@trans('title.gioithieu')</a></li>
                        <li><a href="{{ routeLang('new_list') }}" class="py-2 d-block">@trans('title.tintuc')</a></li>
                        <li><a href="{{ routeLang('contact') }}" class="py-2 d-block">@trans('title.lienhe')</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Help</h2>
                    <div class="d-flex">
                        <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                            <li><a href="#" class="py-2 d-block">@trans('title.shipping_information')</a></li>
                            <li><a href="#" class="py-2 d-block">@trans('title.returns_exchange')</a></li>
                            <li><a href="#" class="py-2 d-block">@trans('title.terms_conditions')</a></li>
                            <li><a href="#" class="py-2 d-block">@trans('title.privacy_policy')</a></li>
                        </ul>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">@trans('title.faqs')</a></li>
                            <li><a href="#" class="py-2 d-block">@trans('title.lienhe')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">@trans('title.question')</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span>
                                <span class="text">@trans('title.company_diachi')</span>
                            </li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929
											210</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span
                                            class="text">info@yourdomain.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script>
                    All rights reserved | This website is made with <i class="icon-heart color-danger"
                                                                       aria-hidden="true"></i> by <a
                            href="http://manhlinhnguyen.com" target="_blank">Manh Linh
                        Nguyen</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00"/>
    </svg>
</div>