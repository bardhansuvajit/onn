@extends('layouts.app')

@section('page', 'FAQ')

@section('content')

<style type="text/css">
    .cms_context h1 {
        font-size: 30px;
        line-height: 1.5;
    }
    .cms_context figure img {
        max-width: 100%;
    }
    .news_meta {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .news_date {
        display: block;
        background: #f0f0f0;
        color: #898989;
        padding: 0 5px;
        height: 20px;
        line-height: 20px;
        font-weight: 500;
        margin-right: 10px;
    }
    .news_magazine {
        font-weight: 500;
        color: #898989;
    }
</style>

<section class="cart-header mb-3 mb-sm-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4>Single Blog</h4>
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
                            <li><a href="https://onninternational.com/about">About</a></li>
                            <li><a href="https://onninternational.com/corporate">Corporate</a></li>
                            <li><a href="https://onninternational.com/news">News</a></li>
                            <li><a href="https://onninternational.com/blog">Blogs</a></li>
                            <li><a href="https://onninternational.com/global">Global</a></li>
                            <li><a href="https://onninternational.com/contact">Contact</a></li>
                            <li><a href="https://onninternational.com/career">Career</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-sm-9">
                <div class="cms_context">
                    <h1>BE CASUAL, BE YOU – CASUALZ ONN PREMIUM WEAR IN INDIA</h1>
                    <div class="news_meta">
                        <div class="news_date">30 March 2017</div><div class="news_magazine">0 Comment</div>
                    </div>
                    <figure>
                        <img src="{{asset('/img/blog1-1-850x370.jpg')}}">
                    </figure>

                    <figcaption>
                        <p>With the launch of ONN inner wear, Lux Industries forayed into the premium men’s innerwear segment five years back. The brand ONN has established a respectable position and has garnered encouraging market share in the category. With the retail reach of 13,000 outlets across 3,500 cities and towns in India, ONN brand is emerging as one of the fastest growing brand in the segment.</p>

                        <p>In the endeavor to further consolidate its market position and to further develop the relationship with its loyal customer base, ONN extended the brand by offering Casualz range of Track Pants, Shorts, T-shirts and Three-Quarter Pants. The brand has gone on record stating that strong demand from the retail fraternity</p>

                        <p>The brand has gone on record stating that strong demand from the retail fraternity and the consumer has been the key factor in the launch of Casualz. Continuing the brand promise of comfort, style and durability the entire Casualz range promises to satisfy the consumers on these three parameters. With the wide range of fashion T-shirts, ONN Casualz shall surely be the first choice of the fashion conscious consumers. In the test market conducted by the brand, Casualz Track pants has been appreciated for the fit and styling. With the Indian consumers hunting for the trendy, fashionable and comfortable casual wear, ONN Casualz is all set to emerge as the most favored brand in the category.</p>

                        <p>The T-shirts prepared under the Casualz range are made up of 100 % premium combed cotton with super absorbent fabrics which ensures freshness all day long. Available in both round neck and Polo (Collar) style, the Casualz range offer various options to the consumers so that they can choose according to their style and preference. The best thing about these T-shirts is that it goes well with anything be it jeans, track pants or three-quarter pants. The attractive colors with which the T-shirts are being launched are sure to increases the glamour quotient and will make it the first choice for the fashion oriented people. The Three-Quarter Pants, Track pants and Shorts under the Casualz range are made from 100% premium combed cotton for extra durability. Available in many bold colors, these lower wears have ribbed waist band and French terry knit to give extreme comfort to the wearer. Prepared with utmost focus on style and comfort these lower wears dispense impressive designs and guarantees calmness. Today the youth yearns for such apparel which gives them a relaxed yet stylish look and the new Casualz range from ONN Premium Wear fulfills their desire and demands both.</p>

                        <p>With the launch of new ONN Casualz range, the brand is destined to delight the consumers ensuring stupendous brand success.</p>
                    </figcaption>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
