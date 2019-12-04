@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản Phẩm{{$sanpham->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trang-chu')}}">Trang Chu</a> / <span>Thông Tin Chi Tiết Sản Phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="source/image/product/{{$sanpham->image}}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title"><h2>{{$sanpham->name}}</h2></p><br>
								<p class="single-item-price">
								@if($sanpham->promotion_price==0)
									<span class="flash-del">{{number_format($sanpham->unit_price)}} VND</span>
							    @else
									    <span class="flash-del">{{number_format($sanpham->unit_price)}} VND</span>
									    <span class="flash-sale">{{number_format($sanpham->promotion_price)}} VND</span>
								 @endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{$sanpham->description}}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
																
								<select class="wc-select" name="number">
									<option>Số Lượng</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<a class="add-to-cart" href="{{route('themgiohang',$sanpham->id)}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description"><h4>Mô Tả</h4></a></li>
							
						</ul><br>

						<div class="panel" id="tab-description">
							<p>{{$sanpham->description}} </p>
						</div>
						
					</div>
					<div class="space50">&nbsp;</div>
					
				</div>
				
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
	@endsection