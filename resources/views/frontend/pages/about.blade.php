@extends('frontend.layouts.master')
@section('content')
    {{-- <h1>This is about page</h1> --}}
    {{-- @include('frontend.layouts.sidebar') --}}
    @if($isAbout)
        <img src="{{asset('/img/about-banner.jpg')}}" alt="" class="top-banner">
    @endif
    <div class="container">
        <h1 class="text-center">@if($isAbout) About Us @else Liên hệ @endif</h1>
        @if($isAbout)
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod tempor lectus, vel sagittis enim
                auctor eget. Proin non turpis eu eros ultrices vestibulum imperdiet rutrum massa. Praesent varius
                vulputate erat nec condimentum. Nulla in accumsan neque, a auctor urna. Proin vehicula et magna at
                varius. Nam convallis interdum enim, vel semper ligula ultricies non. Sed pellentesque vestibulum urna
                non mattis. Fusce in justo molestie metus mattis luctus eu pulvinar tortor. Morbi posuere dignissim
                convallis. Etiam at est at ex ultricies vulputate vitae nec nibh. Morbi scelerisque pellentesque tortor
                at consectetur.</p>
            <p>Nulla eget pretium diam. In hac habitasse platea dictumst. Donec aliquam placerat faucibus. Vestibulum mi
                lorem, feugiat id suscipit in, rutrum ac magna. Donec bibendum sodales laoreet. Aliquam luctus nisl sed
                lectus varius, vel vehicula sem molestie. Nulla facilisi. Nulla pellentesque, nibh vel ultricies tempor,
                dui metus cursus lorem, sed viverra nisi ex vel enim. Donec in purus arcu. Praesent mattis orci felis, a
                condimentum dolor lobortis id. Mauris lacinia enim et quam rhoncus, venenatis mattis massa porttitor.
                Phasellus molestie urna at leo dictum, eu auctor odio hendrerit. Sed ullamcorper tortor sit amet augue
                vehicula imperdiet. Aliquam semper nisi a metus efficitur, vel imperdiet ante blandit. Nam felis erat,
                ornare eu varius id, aliquam ac est.</p>
        @endif
        <div class="row justify-content-center">
            <div class="col-xl-8 ftco-animate fadeInUp ftco-animated">
                <form action="{{ route($isAbout ? 'mail_contact' : 'checkout_post') }}" method="POST" class="billing-form">
                    {{ csrf_field() }}
                    @if($isAbout) <h3 class="mb-4 billing-heading text-center">@trans('title.mail_title')</h3> @endif
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            @if($errors->has('mail_send'))
                                <label style="color: #00008b">{{ $errors->first('mail_send') }}</label>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="hoten">Họ tên <span style="color: #ff0000">(*)</span></label>
                                <input type="text" name="hoten" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="donvi">Đơn vị công tác</label>
                                <input type="text" name="donvi" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sdt">Số điện thoại <span style="color: #ff0000">(*)</span></label>
                                <input type="text" name="sdt" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Địa chỉ Email <span style="color: #ff0000">(*)</span></label>
                                <input type="text" name="email" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        @if(!$isAbout)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sanpham">Sản phẩm <span style="color: #ff0000">(*)</span></label>
                                    <input type="text" name="sanpham" class="form-control" placeholder=""
                                           value="{{ !empty($product->title) ? $product->title : "" }}">
                                    <input type="hidden" name="product_id" class="form-control" placeholder=""
                                           value="{{ !empty($product->id) ? $product->id : "" }}">
                                </div>
                            </div>
                        @endif

                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group more-information">
                                <label for="noidung">Nội dung</label>
                                <textarea name="noidung" id="" cols="30" rows="10" class="form-control"
                                          placeholder=""></textarea>
                            </div>
                        </div>

                        <div class="w-100"></div>

                    </div>
                    <input type="submit" value="@trans('title.send')" class="btn btn-primary btn-block px-4">
                </form>
            </div>
        </div>
    </div>
@endsection
<style>
    .ftco-footer {
        margin-top: 50px;
    }
</style>