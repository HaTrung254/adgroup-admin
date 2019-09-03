@extends('frontend.layouts.master')
@section('content')
    {{-- <h1>This is about page</h1> --}}
    {{-- @include('frontend.layouts.sidebar') --}}
    <img src="{{asset('/img/about-banner.jpg')}}" alt="" class="top-banner">
    <div class="container">
        <h1 class="text-center">About Us</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod tempor lectus, vel sagittis enim auctor eget. Proin non turpis eu eros ultrices vestibulum imperdiet rutrum massa. Praesent varius vulputate erat nec condimentum. Nulla in accumsan neque, a auctor urna. Proin vehicula et magna at varius. Nam convallis interdum enim, vel semper ligula ultricies non. Sed pellentesque vestibulum urna non mattis. Fusce in justo molestie metus mattis luctus eu pulvinar tortor. Morbi posuere dignissim convallis. Etiam at est at ex ultricies vulputate vitae nec nibh. Morbi scelerisque pellentesque tortor at consectetur.</p>
        <p>Nulla eget pretium diam. In hac habitasse platea dictumst. Donec aliquam placerat faucibus. Vestibulum mi lorem, feugiat id suscipit in, rutrum ac magna. Donec bibendum sodales laoreet. Aliquam luctus nisl sed lectus varius, vel vehicula sem molestie. Nulla facilisi. Nulla pellentesque, nibh vel ultricies tempor, dui metus cursus lorem, sed viverra nisi ex vel enim. Donec in purus arcu. Praesent mattis orci felis, a condimentum dolor lobortis id. Mauris lacinia enim et quam rhoncus, venenatis mattis massa porttitor. Phasellus molestie urna at leo dictum, eu auctor odio hendrerit. Sed ullamcorper tortor sit amet augue vehicula imperdiet. Aliquam semper nisi a metus efficitur, vel imperdiet ante blandit. Nam felis erat, ornare eu varius id, aliquam ac est.</p>
    </div>
@endsection