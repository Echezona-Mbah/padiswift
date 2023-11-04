@extends('layout')
@section('title', 'About | Best Bills Payment, Data Purchase, Airtime Purchase, Followers and Subscribers Purchase Platform')
@section('description', 'Home')
@section('keyword', 'PadiSwift, Swift, Bills, Payment, Data, Purchase, Airtime, Followers, Subscribers, Easy, Top up, phone, airtime, internet data, Pay, electricity, bills, renew, TV, subscriptions, cable, sub')
@section('content')


<!-- Supervise Warp Start -->
        <div class="supervise-warp pb-100 pt-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="supervise-image">
                            <img src="assets/images/supervise/supervise1.png" class="supervise1" alt="supervise">
                            <div class="anm" data-cues="slideInLeft" data-interval="-200">
                                <img src="assets/images/small-images/supervise1.png" class="small-supervise1" alt="image">
                            </div>
                            <div class="anm" data-cues="slideInRight" data-interval="-200">
                                <img src="assets/images/small-images/supervise2.png" class="small-supervise2" alt="image">
                            </div>
                            <img src="assets/images/shapes/supervise-shape1.png" class="supervise-shape1" alt="image">
                            <img src="assets/images/shapes/supervise-shape2.png" class="supervise-shape2" alt="image">
                        </div>
                        <div class="responsive-image">
                            <img src="assets/images/PadiSwift-about-us.png" class="responsive-image" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single-section supervise-content">
                            <h2>Welcome to <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} - Where Convenience Meets Innovation!</h2>
                            <p>At <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}, we believe in transforming the way you experience transactions and services. Our platform is more than just a place to pay bills or recharge your phone; it's a lifestyle upgrade designed to simplify your daily life.</p>
                            <ul class="supervise-list">
                                <li>
                                    <div class="icon">
                                        <div class="rounded-icon style1">
                                            <i class="flaticon-software-as-service"></i>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h4>Our Mission</h4>
                                        <p>We are on a mission to redefine convenience. <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} strives to provide you with a one-stop solution for all your transactional needs, offering a seamless and secure experience that puts you in control.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <div class="rounded-icon style2">
                                            <i class="flaticon-experiments"></i>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h4>Join the <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} Community</h4>
                                        <p>Become part of a community that values simplicity, security, and speed. Download the app, set up your profile, and embark on a journey where every transaction feels like a breeze.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <div class="rounded-icon style3">
                                            <i class="flaticon-cloud-servers"></i>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h4>Discover Seamless Living</h4>
                                        <p><span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} is more than a platform; it's a lifestyle upgrade. We invite you to explore the future of transactions with us, where convenience meets innovation.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Supervise Warp End -->


         <!-- Management Warp Start -->
        <div class="management-warp">
            <div class="container">
                <div class="section-warp d-flex align-items-center justify-content-between">
                    <div class="single-section">
                        <h2>Why Choose <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}?</h2>
                        <p>Managing your bills has never been this easy! <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} simplifies the process of bill payments, ensuring a seamless experience that puts you in control. Here's why <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} is your go-to platform for hassle-free bills payment and more.</p>
                    </div>
                    <div class="section-btn">
                        <a href="{{env('GOOGLE_STORE_LINK')}}" class="default-btn">Get Started Now</a>
                    </div>
                </div>
                
                <div class="management-accordion horizontal">
                    <section id="my-element-1" class="active" data-cue="slideInUp">
                        <h2>
                            <span class="style1">01.</span>
                            <a href="#about">Effortless Transactions</a>
                        </h2>
                        <p>Navigate our user-friendly interface for quick and stress-free transactions.</p>
                        
                    </section>

                    <section id="my-element-2" data-cue="slideInUp">
                        <h2>
                            <span class="style2">02.</span>
                            <a href="#services">Security First</a>
                        </h2>
                        <p>Your trust and security are our top priorities. We employ advanced encryption to safeguard your data.</p>
                      
                    </section>

                    <section id="my-element-3"  data-cue="slideInUp">
                        <h2>
                            <span class="style3">03.</span>
                            <a href="#blog">Comprehensive Services</a>
                        </h2>
                        <p>From airtime top-ups to bill payments and beyond, <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} covers a diverse range of services, ensuring all your needs are met.</p>
                        
                    </section>

                    <section id="my-element-4" data-cue="slideInUp">
                        <h2>
                            <span class="style4">04.</span>
                            <a href="#portfolio">Innovation</a>
                        </h2>
                        <p>Stay ahead with PadiSwift's cutting-edge solutions, always evolving to meet your changing needs.</p>
                        
                    </section>

                    <section id="my-element-5" data-cue="slideInUp">
                        <h2>
                            <span class="style5">05.</span>
                            <a href="#contact">24/7 Support</a>
                        </h2>
                        <p>Our dedicated support team is here around the clock to assist you, ensuring a smooth and enjoyable experience.</p>
                        
                    </section>
                </div>
            </div>
        </div>
        <!-- Management Warp End -->

@endsection