@extends('layouts.app')

@section('page', 'FAQ')

@section('content')

<style>
    .news_list {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    .news_list li {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
        padding: 0 15px;
        margin-bottom: 30px;
    }
    .news_list li:nth-child(2n -1) {
        border-right: 1px solid #eee;
    }
    .news_list li h4 {
        margin-bottom: 10px;
    }
    .news_list li h4 a:hover {
        color: #141b4b;
        box-shadow: inset 0 -1px 0 0 #c10909;
    }
    .news_meta {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .news_date {
        display: block;
        background: #c10909;
        color: #fff;
        padding: 0 5px;
        height: 20px;
        line-height: 20px;
        font-weight: 500;
        margin-right: 10px;
    }
    .news_magazine {
        font-weight: 500;
    }
    @media(max-width: 575px) {
        .news_list li {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<section class="cart-header mb-3 mb-sm-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4>All News</h4>
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

            <div class="col-sm-9 col-lg-9">
                <div class="row">
                    <ul class="news_list">
                        @php
                            $news = \DB::table('news')->latest('id')->get();
                        @endphp

                        @foreach ($news as $singleNews)
                        <li>
                            <figcaption>
                                <div class="news_meta">
                                    <div class="news_date">{{date('d F Y', strtotime($singleNews->created_at))}}</div><div class="news_magazine">{{$singleNews->link_text}}</div>
                                </div>
                                <h4><a href="{{ route('front.content.news.detail', $singleNews->slug) }}">{{$singleNews->title}}</a></h4>
                                {{-- <h4><a href="{{ route('front.content.news.detail', $singleNews->slug) }}">{{$singleNews->title}}</a></h4> --}}
                                <div class="news_comments">0 Comments</div>
                            </figcaption>
                        </li>
                        @endforeach
                        {{-- <li>
                            <figcaption>
                                <div class="news_meta">
                                    <div class="news_date">30 March 2017</div><div class="news_magazine">Fashion Network</div>
                                </div>
                                <h4><a href="https://onninternational.com/news/detail">LUX TO FORAY INTO CASUAL, ACTIVE WEAR, EYES RS 2000 CRORE SALES BY 2020</a></h4>
                                <div class="news_comments">0 Comments</div>
                            </figcaption>
                        </li>
                        <li>
                            <figcaption>
                                <div class="news_meta">
                                    <div class="news_date">17 October 2017</div><div class="news_magazine">Economic Times Date</div>
                                </div>
                                <h4><a href="https://onninternational.com/news/detail">HOW THREE KOLKATA INNERWEAR MAKERS ARE TRYING TO MOVE UP THE VALUE CHAIN</a></h4>
                                <div class="news_comments">0 Comments</div>
                            </figcaption>
                        </li>
                        <li>
                            <figcaption>
                                <div class="news_meta">
                                    <div class="news_date">13 January 2018</div><div class="news_magazine">Economic Times Date</div>
                                </div>
                                <h4><a href="https://onninternational.com/news/detail">HOW THREE KOLKATA INNERWEAR MAKERS ARE TRYING TO MOVE UP THE VALUE CHAIN</a></h4>
                                <div class="news_comments">0 Comments</div>
                            </figcaption>
                        </li> --}}
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
