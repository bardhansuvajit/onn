@extends('layouts.app')

@section('page', 'FAQ')

@section('content')
<section class="cart-header mb-3 mb-sm-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4>Corporate</h4>
            </div>
        </div>
    </div>
</section>

<section class="cart-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <ul class="account-list mt-0">
                    <li>
                        <span><strong>Quick Links</strong></span>
                        <ul>
                            <!-- <li><a href="{{route('front.content.about')}}">About</a></li> -->
                            <li><a href="{{route('front.content.corporate')}}">Corporate</a></li>
                            <li><a href="{{route('front.content.news')}}">News</a></li>
                            <li><a href="{{route('front.content.blog')}}">Blogs</a></li>
                            <li><a href="{{route('front.content.global')}}">Global</a></li>
                            <li><a href="{{route('front.content.contact')}}">Contact</a></li>
                            <!-- <li><a href="{{route('front.content.career')}}">Career</a></li> -->
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-sm-9">
                <div class="cms_context">
                    <h5>Our Company</h5>
                    <p>ONN is the new Premium Inners/Men’s Underwear Brand from the house of Lux Industries Limited. Crafted with the latest technology, the ONN range of Onn Premiumwear effectively touches the style nerve of the fashionable Indian male. A vast range of designs, top notch quality and sensible styling has been presented to meet the standards and aspirations of today’s youth. In addition, the very fact that it is actively endorsed by the great fashion icon – Shahrukh Khan – adds yet another feather to its cap.</p>

                    <h5>Vision & Mission</h5>
                    <p>We believe in providing our customers with the products to satisfy their needs of ultimate comfort and style at the same time. As the fashion is changing at rapid pace, we aim to make the products meet the desires and aspirations of the youth. We believe in consistently meeting and even surpassing the customer’s values and the expectations that they associate with our brand.</p>
                    <p>We are focussing on maintaining and strengthening the brand image in accordance with the brand identity and brand values. We desire to become the best youthful Onn Premiumwear-sportswear and leisure wear brand with top of the mind recall.</p>

                    <h5>Management Profile</h5>
                    <p><strong>Mr. Ashok Kumar Todi – Chairman, Lux Industries Limited (LIL)</strong></p>

                    <p>“Our collaborative efforts will enable us to continue pushing the limits of technology and incite us to develop new products and get closer to our consumer.”</p>
                    <p>The daily affairs of LIL are run and managed by Mr Ashok Todi. He is the mastermind behind the company’s exponential growth and is responsible for formulating policies of growth and expansion of all the brands under LIL. Mr Ashok Todi also looks after the marketing, advertising and sales functions, including network and distribution of LIL. He is also associated with various philanthropic organizations of the country. Mr Ashok Todi hails from an illustrious family that has been engaged in the hosiery business for over 5 decades and with his vast experience and knowledge he has pulled the entire organisation towards success. Mr. Ashok Todi along with his skilled team of directors has managed to establish the organisation as one of the leaders in the hosiery industry.</p>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
