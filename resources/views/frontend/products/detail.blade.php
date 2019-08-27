@extends('frontend.layouts.master')
@section('content')
<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate fadeInUp ftco-animated">
					<a href="images/img1.png" class="image-popup"><img src="@asset('/'.$product->image_url)" class="img-fluid" alt="Colorlib Template"></a>
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate fadeInUp ftco-animated">
					<h3>{{ $product->title }}</h3>
					<h4>Hãng sản xuất: {{ $product->brand }}</h4>
					<p>Giá bán: <b style="color: #0088cc;"> 
						@if(!empty($product->price))
							{{ number_format($product->price) }} @trans('title.money')
						@else
							@trans('title.dangcapnhat')
						@endif</b></p>
					{!! $product->description !!}
				</div>
			</div>
			<hr>
			<div class="row product-details">
				<div class="col">
					{!! $product->content !!}
				</div>
			</div>
		</div>
	</section>
	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate fadeInUp ftco-animated">
					<h2 class="mb-4">@trans('title.sanphamlienquan')</h2>
					<p>@trans('title.sanphamlienquan_des')</p>
				</div>
			</div>
		</div>
		<div class="container">
			
			<div class="row">
				@foreach($lienquanProducts as $item)
				<div class="col-md-3 col-sm-12">
					<div class="card prd-card">
						<a href="{{ route('product_detail', $item->id) }}">
							<img src="@asset('/'.$item->image_url)" alt="" class="card-img-top">
							<div class="card-body">
								<hr>
								<h5 class="card-title" style="font-size: 1rem; text-align: center">
									{{ $item->title }}
								</h5>
							</div>
						</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
@endsection