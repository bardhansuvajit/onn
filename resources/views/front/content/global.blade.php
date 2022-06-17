@extends('layouts.app')

@section('page', 'FAQ')

@section('content')
<section class="cart-header mb-3 mb-sm-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4>Global</h4>
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
                    <h5>The Global Presence</h5>
                    <p>ONN is the new Men’s Premium Inners/ Men’s Underwear brand that comes from the house of Lux Industries limited. The House of Lux has been making a difference in the Hosiery Industry since the company was founded in 1957.</p>

                    <p>Now, Lux has offices in the Middle East, Europe and Africa, but regardless of where it is, LIL nurtures an invigorating, positive environment by hiring talented people. With over 1000 employees working together as a team, the organization comprises of CA, MBA & Engineers from the top notch institutes of our country. The Government of India has also honored LIL as “Star Export House” in 2010.</p>

                    <p>Keeping the dream of Late Shri Girdharilalji Todi, alive, LIL is diversifying its product base and that is how ONN is born with a key focus on today’s youth.</p>

                    <h5>The Global Standards</h5>
                    <p>The very essence of ONN premium Inners lies in the way it is designed and manufactured. An ISO 9001:2008 certified company; quality of a product forms the main crux of the company’s motto. Right from the basic designing to the final packaging, everything is done in-house in order to keep a check on the quality of the product. The best machinery is used to manufacture ONN brand of products.</p>

                    <p>The LIL has always been extensively particular about the uncompromising quality of the product and the very same is reflected in the new offering from the house – ONN Premium Inners.</p>

                    <h5>The Global Appeal</h5>
                    <p>ONN Premium Inners products are of world class quality with a global appeal owing to the designs and the color combinations. Each and every product has been conceptualised and designed after an extensive market research and in accordance to the consumers’ perceptions and desires. The products quality can easily be compared with any of the existent globally popular brands in its range owing to the scientific methods of conseptualising, designing, and manufacturing.</p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
