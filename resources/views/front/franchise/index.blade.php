@extends('layouts.app')

@section('page', 'Franchise')

@section('content')

<style type="text/css">
	.franchise_banner {
		padding-bottom: 40px;
	}
	.franchise_banner h1 {
		font-size: 70px;
		font-weight: 500;
		text-align: center;
		position: relative;
		z-index: 9;
	}
	.franchise_banner figure {
		margin-top: -80px;
		margin-bottom: 30px;
	}
	.franchise_banner img {
		max-width: 100%;
	}
	.franchise_banner h1 strong {
		color: #c10909;
		font-weight: 900;
	}
	.franchise_banner p {
		font-size: 14px;
		font-weight: 500;
		line-height: 1.6;
	}
	.franchise_content {
		padding: 0 0 60px;
	}
	.franchise_content p {
		font-size: 13px;
		font-weight: 500;
		line-height: 1.6;
	}
	.franchise_content h3 {
		margin-bottom: 15px;
		color: #c10909;
		font-size: 35px;
		text-align: center;
	}
	.franchise_shop {
		width: 100%;
		display: block;
		padding-bottom: 80%;
		position: relative;
		margin: 15px 0 30px;
	}
	.franchise_shop img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		position: absolute;
		top: 0;
		left: 0;
	}
	.franchise_requisite {
		padding: 60px 0;
		background: #f7f7f7;
	}
	.franchise_requisite h2 {
		font-size: 30px;
		font-weight: 500;
		margin-bottom: 60px;
	}
	.franchise_requisite h5 {
		font-size: 16px;
		font-weight: 500;
		margin-bottom: 10px;
		text-align: center;
	}
	.franchise_requisite p {
		font-size: 13px;
		font-weight: 500;
		line-height: 1.6;
		text-align: center;
		color: #888;
	}
	.franchise_requisite figure {
		width: 100px;
		height: 100px;
		border-radius: 50%;
		padding: 25px;
		background: rgba(20, 27, 75, 0.1);
		margin: 0 auto 30px;
		display: block;
	}
	.franchise_requisite figure img {
		max-width: 100%;
	}
	.franchise_breakup_box {
		padding: 60px 0;
	}
	.franchise_breakup_box h2 {
		font-size: 30px;
		font-weight: 500;
		margin-bottom: 60px;
	}
	.breakup_box {
		display: block;
		border-radius: 10px;
		padding: 25px;
		margin-bottom: 25px;
		background: rgba(20, 27, 75, 0.1);
	}
	.breakup_box figure {
		width: 100px;
		height: 100px;
		border-radius: 50%;
		padding: 25px;
		background: rgba(20, 27, 75, 0.1);
		margin: 0 auto 30px;
		display: block;
	}
	.breakup_box figure img {
		max-width: 100%;
	}
	.breakup_box h5 {
		min-height: 48px;
		font-size: 16px;
		font-weight: 500;
		margin-bottom: 10px;
		text-align: center;
	}
	.breakup_box p {
		min-height: 40px;
		font-size: 13px;
		font-weight: 500;
		line-height: 1.6;
		text-align: center;
		color: #000;
		margin: 0;
	}
	.franchise_segments {
		padding: 60px 0;
	}
	.franchise_segments img {
		max-width: 100%;
	}
	.franchise_segments h2 {
		font-size: 30px;
		font-weight: 500;
		margin-bottom: 60px;
	}
	.franchise_segments p {
		font-size: 16px;
		font-weight: 500;
		line-height: 1.4;
	}
	.franchise_segments a:hover {
		text-decoration: underline;
		color: #c10909;
	}
	.franchise_block {
		display: block;
		background: #fff4de;
		padding: 0;
	}
	.franchise_block h2 {
		margin-bottom: 25px;
	}
	.franchise_block p {
		font-size: 16px;
		font-weight: 500;
		line-height: 1.4;
	}
	.drop_form {
		display: flex;
		border-radius: 8px;
		border: 2px solid #c10909;
		margin-top: 25px;
	}
	.drop_email {
		padding: 0 10px;
		height: 40px;
		line-height: 40px;
		background: transparent;
		border: none;
		flex: 1 0 0%;
		border-radius: 6px 0 0 6px;
	}
	.drop_button {
		border: none;
		border-radius: 0 6px 6px 0;
		background: #c10909;
		color: #fff;
		font-size: 14px;
		font-weight: 500;
		height: 40px;
		line-height: 40px;
		padding: 0 20px;
	}
</style>

<!-- <section class="listing-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h1>Franchise</h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Franchise</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
 -->


<section class="franchise_banner">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-12">
				<h1>Become <strong>franchise</strong> of onn exclusive store</h1>

				<figure>
					<img src="{{asset('/img/onn_fbanner.png')}}">
				</figure>

				<p>ONN is the new Premium Men Inners/ Athleisure Brand from the house of Lux Industries Limited. Crafted with the latest technology, the ONN range of Onn Premium wear effectively touches the style nerve of the fashionable Indian male. A vast range of designs, top notch quality and sensible styling has been presented to meet the standards and aspirations of today’s.</p>
				
				<p>Within a short stretch of time, ONN has strongly built its brand and emerged as a fierce competition for its contemporaries. It has consistently shown remarkable product development, and innovation in the markets over the years. We further aim to consistently improve and cater to complete customer satisfaction by creating top-notch products.</p>
			</div>
		</div>
	</div>
</section>

<section class="franchise_content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>OUR MISSION & VISION</h3>
			</div>
			<!-- <div class="col-md-6">
				
			</div>
			<div class="col-md-5 offset-md-1">
				<p>We are focusing on maintaining and strengthening the brand image in accordance with the brand identity and brand values. We desire to become the best youthful Onn Premium wear-sportswear and leisure wear brand with top of the mind recall.</p>
			</div>

			<div class="col-md-4">
				<div class="franchise_shop">
					<img src="{{asset('/img/onn_fbanner.png')}}">
				</div>
			</div>
			<div class="col-md-4">
				<div class="franchise_shop">
					<img src="{{asset('/img/onn_fbanner.png')}}">
				</div>
			</div>
			<div class="col-md-4">
				<div class="franchise_shop">
					<img src="{{asset('/img/onn_fbanner.png')}}">
				</div>
			</div> -->
			<div class="col-md-12">
				<p>We believe in providing our customers with the products to satisfy their needs of ultimate comfort and style at the same time. As the fashion is changing at rapid pace, we aim to make the products meet the desires and aspirations of the youth. We believe in consistently meeting and even surpassing the customer’s values and the expectations that they associate with our brand.</p>

				<p>We believe in providing our customers with the products to satisfy their needs of ultimate comfort and style at the same time. As the fashion is changing at rapid pace, we aim to make the products meet the desires and aspirations of the youth. We believe in consistently meeting and even surpassing the customer’s values and the expectations that they associate with our brand.</p>

				<p>ONN is the new Men’s Premium Inners/ Athleisure brand that comes from the house of Lux Industries limited. The House of Lux has been making a difference in the Hosiery Industry since the company was founded in 1957.</p>
				
				<p>Each and every product has been conceptualized and designed after an extensive market research and in accordance to the consumers’ perceptions and desires. The products quality can easily be compared with any of the existent globally popular brands in its range owing to the scientific methods of conceptualizing, designing, and manufacturing.</p>

				<p>The very essence of ONN premium Inners / Athleisure lies in the way it is designed and manufactured. An ISO 9001:2008 certified company; quality of a product forms the main crux of the company’s motto. Right from the basic designing to the final packaging, everything is done in-house in order to keep a check on the quality of the product. The best machinery is used to manufacture ONN brand of products.</p>
			</div>
		</div>
	</div>
</section>


<section class="franchise_block">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-5">
				<h2>Interesting About Franchise ?</h2>
				<p>Drop your email here and get some feed back about ONN franchise policy, contact, location available and other contract.</p>

				<form class="drop_form">
					<input type="email" name="" class="drop_email">
					<input type="submit" name="" value="Submit" class="drop_button">
				</form>
			</div>
			<div class="col-sm-6 offset-md-1">
				<img src="{{asset('/img/onn_store.png')}}">
			</div>
		</div>
	</div>
</section>


<section class="franchise_requisite">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Requisite</h2>
			</div>
			<div class="col-sm-2">
				<figure>
					<img src="{{asset('/img/light-bulb.png')}}">
				</figure>
				<h5>Area Required</h5>
				<p>350-400 sq. ft. carpet & above</p>
			</div>
			<div class="col-sm-2">
				<figure>
					<img src="{{asset('/img/salary.png')}}">
				</figure>
				<h5>Investment</h5>
				<p>INR 20-22 lakhs & above</p>
			</div>
			<div class="col-sm-2">
				<figure>
					<img src="{{asset('/img/blueprint.png')}}">
				</figure>
				<h5>Floor</h5>
				<p>Ground on High Street & per zone in Malls</p>
			</div>
			<div class="col-sm-2">
				<figure>
					<img src="{{asset('/img/bag.png')}}">
				</figure>
				<h5>Taxes & Transport</h5>
				<p>On Company</p>
			</div>
			<div class="col-sm-2">
				<figure>
					<img src="{{asset('/img/handshake.png')}}">
				</figure>
				<h5>Format</h5>
				<p>Outright Sales</p>
			</div>
			<div class="col-sm-2">
				<figure>
					<img src="{{asset('/img/packages.png')}}">
				</figure>
				<h5>Stock Correction</h5>
				<p>100% for first 2 quarters & 50% for rest all quarters</p>
			</div>
		</div>
	</div>
</section>

<section class="franchise_breakup_box">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Investment Breakup & Margin</h2>
			</div>
			<div class="col-sm">
				<div class="breakup_box">
					<figure>
						<img src="{{asset('/img/salary.png')}}">
					</figure>
					<h5>Investment on Stocks</h5>
					<p>INR 3,000 per sq. ft.</p>
				</div>
			</div>
			<div class="col-sm">
				<div class="breakup_box">
					<figure>
						<img src="{{asset('/img/clothes-rack.png')}}">
					</figure>
					<h5>Investment On Interiors</h5>
					<p>INR 2,000 – 2,200 per sq. ft. (approx.)</p>
				</div>
			</div>
			<div class="col-sm">
				<div class="breakup_box">
					<figure>
						<img src="{{asset('/img/money-bag.png')}}">
					</figure>
					<h5>Franchisee Fees</h5>
					<p>INR 101,000 (non-refundable)</p>
				</div>
			</div>
			<div class="col-sm">
				<div class="breakup_box">
					<figure>
						<img src="{{asset('/img/profit.png')}}">
					</figure>
					<h5>Margin</h5>
					<p>35% on Net Sales</p>
				</div>
			</div>
			<div class="col-sm">
				<div class="breakup_box">
					<figure>
						<img src="{{asset('/img/tag.png')}}">
					</figure>
					<h5>Scheme and Promotion</h5>
					<p>On Company</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="franchise_requisite">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Marketing & Sales Promotion</h2>
			</div>
			<div class="col-sm-4">
				<figure>
					<img src="{{asset('/img/money-bag.png')}}">
				</figure>
				<h5>Local / Online Marketing</h5>
				<p>On Company</p>
			</div>
			<div class="col-sm-4">
				<figure>
					<img src="{{asset('/img/profit.png')}}">
				</figure>
				<h5>Offers / Schemes</h5>
				<p>On Company</p>
			</div>
			<div class="col-sm-4">
				<figure>
					<img src="{{asset('/img/tag.png')}}">
				</figure>
				<h5>Launch Marketing Support</h5>
				<p>Total store launch budget will be shared between Company and Franchisee equally</p>
			</div>
		</div>
	</div>
</section>


<section class="franchise_segments">
	<div class="container mb-5">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Current Segments</h2>
			</div>
			<div class="col-sm-6">
				<figure>
					<img src="{{asset('/img/onn_platina.png')}}">
				</figure>
			</div>
			<div class="col-sm-6">
				<figure>
					<img src="{{asset('/img/onn_comfort.png')}}">
				</figure>
			</div>
		</div>
	</div>

	<div class="container text-center">
		<p>For further details, contact<br/>
SAGAR SHAH<br/>
<a href="tel:+91-90070 21060">+91-90070 21060</a><br/>
<a href="mailto:+91-90070 21060">sagar.shah@luxinnerwear.com</a></p>
	</div>
</section>


@endsection

@section('script')
<script>
    
</script>
@endsection
