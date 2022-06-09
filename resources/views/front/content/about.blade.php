@extends('layouts.app')

@section('page', 'FAQ')

@section('content')
<style type="text/css">
    .account-card {
        height: auto;
    }
</style>

<section class="cart-header mb-3 mb-sm-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4>About us</h4>
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
                            <li><a href="{{route('front.content.about')}}">About</a></li>
                            <li><a href="{{route('front.content.corporate')}}">Corporate</a></li>
                            <li><a href="{{route('front.content.news')}}">News</a></li>
                            <li><a href="{{route('front.content.blog')}}">Blogs</a></li>
                            <li><a href="{{route('front.content.global')}}">Global</a></li>
                            <li><a href="{{route('front.content.contact')}}">Contact</a></li>
                            <li><a href="{{route('front.content.career')}}">Career</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-sm-7 col-lg-7">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <a href="{{route('front.content.corporate')}}" class="account-card">
                            <figure>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>
                                </span>
                            </figure>
                            <figcaption>
                                <h4>Corporate</h4>
                            </figcaption>
                        </a>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <a href="{{route('front.content.news')}}" class="account-card">
                            <figure>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </span>
                            </figure>
                            <figcaption>
                                <h4>News</h4>
                            </figcaption>
                        </a>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <a href="{{route('front.content.career')}}" class="account-card">
                            <figure>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                </span>
                            </figure>
                            <figcaption>
                                <h4>Career</h4>
                            </figcaption>
                        </a>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <a href="{{route('front.content.global')}}" class="account-card">
                            <figure>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                </span>
                            </figure>
                            <figcaption>
                                <h4>Global</h4>
                            </figcaption>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
