@extends('layout')
@section('title', 'PadiSwift | Swift Bills Payment, Data Purchase, Airtime Purchase, Followers and Subscribers Purchase')
@section('description', 'Home')
@section('keyword', 'PadiSwift, Swift, Bills, Payment, Data, Purchase, Airtime, Followers, Subscribers, Easy, Top up, phone, airtime, internet data, Pay, electricity, bills, renew, TV, subscriptions, cable, sub')
@section('content')

 <!-- Hero Warp Start -->
        <div class="hero-style1-warp">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-style1-content">
                            <span class="title">Seamless. Smart. Swift.</span>
                            <h1>
                                <img src="assets/images/shapes/content-shape1.png" class="content-shape1" alt="content-shape">
                                  Experience the future of transactions with <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}
                            </h1>
                            <p>Discover a world of convenience at your fingertips with {{env('APP_NAME')}}, the ultimate destination for a wide range of services and transactions. Whether you're looking to stay connected, pay bills, or explore new opportunities, {{env('APP_NAME')}} has you covered.</p>
                            <div class="hero-style1-btn d-flex align-items-center">
                                <a href="{{env('GOOGLE_STORE_LINK')}}" class="default-btn">Get Started—It's Free</a>
                                <a href="" class="hero-service-btn">
                                    <i class="flaticon-trend"></i>
                                    Explore Service
                                </a>
                            </div>
                            <ul class="hero-style1-list">
                                <li>
                                    <i class="flaticon-pointing-to-right"></i>
                                    Payment of bills
                                </li>
                                <li>
                                    <i class="flaticon-pointing-to-right"></i>
                                    Virtual Top-up
                                </li>
                                <li>
                                    <i class="flaticon-pointing-to-right"></i>
                                    Services Provider
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-style1-image">
                            <img src="assets/images/heros/hero1.png" class="hero1" alt="hero">
                            <div class="image" data-cues="slideInLeft">
                                <img src="assets/images/small-images/hero1.png" class="small1" alt="hero">
                            </div>
                            <div class="image" data-cues="slideInDown" data-interval="-200">
                                <img src="assets/images/small-images/hero2.png" class="small2" alt="hero">
                            </div>
                            <div class="image" data-cues="slideInUp">
                                <img src="assets/images/small-images/hero3.png" class="small3" alt="hero">
                            </div>
                            <div class="image" data-cues="slideInLeft">
                                <img src="assets/images/small-images/hero4.png" class="small4" alt="hero">
                            </div>
                        </div>
                        <div class="responsive-image">
                            <img src="assets/images/PadiSwift-Mouckup.png" class="responsive-image" alt="image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="all-shapes">
                <img src="assets/images/shapes/hero-shape1.png" class="hero-shape1" alt="hero-shape">
                <img src="assets/images/shapes/hero-shape2.png" class="hero-shape2" alt="hero-shape">
                <img src="assets/images/shapes/hero-shape3.png" class="hero-shape3" alt="hero-shape">
                <img src="assets/images/shapes/hero-shape4.png" class="hero-shape4" alt="hero-shape">
                <img src="assets/images/shapes/hero-shape5.png" class="hero-shape5" alt="hero-shape">
            </div>
        </div>
        <!-- Hero Warp End -->



    <!-- Payment Warp Start -->
    <div class="payment-warp pt-100 pb-75">
      <div class="container">
        <div class="section-title">
          <h2>Simplify Your Financial Transactions With <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}!</h2>
        </div>
        <div class="row">
          <div class="col-lg-6" data-cue="slideInUp">
            <div class="payment-widget">
              <div class="content">
                <h3>Bills Payment</h3>
                <p>
                  Managing your bills has never been this easy! <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}! simplifies the process of bill payments, ensuring a seamless experience that puts you in control.
                </p>
              </div>
              <img
                src="assets/images/payments/payment1.png"
                class="payment"
                alt="payment"
              />
            </div>
          </div>
          <div class="col-lg-6" data-cue="slideInUp">
            <div class="payment-widget">
              <div class="content">
                <h3>Always Protected</h3>
                <p>
                  Your security is our top priority. <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}! employs cutting-edge encryption measures to safeguard your transactions and personal information.
                </p>
              </div>
              <img
                src="assets/images/payments/payment2.png"
                class="payment"
                alt="payment"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Payment Warp End -->

    <!-- Secure Warp Start -->
    <div class="secure-warp pb-100">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="secure-image">
              <img
                src="assets/images/payments/secure1.jpg"
                class="secure1"
                alt="secure"
              />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="secure-content single-section">
              <h2>Discover the Ease of Digital Transactions with <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}!</h2>
              <p>
                The landscape of financial transactions has undergone a revolution, and <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} is at the forefront. Experience the convenience of making secure and stress-free online payments with our platform. Enjoy a quick and effortless process that puts you in control.
              </p>
              <ul class="secure-list">
                <li>
                  <div class="icon bg1">
                    <i class="flaticon-mobile-payment"></i>
                  </div>
                  <div class="content">
                    <h5>Experience the Convenience of Digital Transactions</h5>
                    <p>
                      Seamless, secure, and at your fingertips – elevate your financial transactions with the convenience of digital payments through <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}!
                    </p>
                  </div>
                </li>
                <li>
                  <div class="icon bg2">
                    <i class="flaticon-mobile-banking-1"></i>
                  </div>
                  <div class="content">
                    <h5>Embark on the Next Era in Payments</h5>
                    <p>
                      Step into a payment revolution – where convenience meets innovation. Explore the future of transactions with <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} today!
                    </p>
                  </div>
                </li>
                <li>
                  <div class="icon bg3">
                    <i class="flaticon-secure-payment"></i>
                  </div>
                  <div class="content">
                    <h5>Streamline Payments with Ease and Security</h5>
                    <p>
                      Effortless transactions, fortified security. Elevate your payment experience with <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} – where simplicity meets unwavering protection.
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Secure Warp End -->

    <!-- Business Warp Start -->
    <div class="business-warp">
      <div class="container-fluid style4">
        <div class="inner-business-warp">
          <div class="section-title">
            <h2>Elevate your day with <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} - Because every transaction should feel like a breeze.</h2>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-6" data-cue="slideInUp">
              <div class="business-card">
                <div class="icon">
                  <i class="flaticon-customize"></i>
                </div>
                <div class="content">
                  <h3>
                    <a>Diverse Utility</a>
                  </h3>
                  <p>
                    {{env('APP_FN')}}</span>{{env('APP_LN')}} covers a wide spectrum of utility bills, including electricity bills for major providers like EEDC, EKEDC, etc. Stay in charge of your expenses with our comprehensive utility coverage.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6" data-cue="slideInUp">
              <div class="business-card">
                <div class="icon">
                  <i class="flaticon-fees"></i>
                </div>
                <div class="content">
                  <h3>
                    <a>No Hidden Fees</a>
                  </h3>
                  <p>
                   Experience transparency at its finest with {{env('APP_FN')}}</span>{{env('APP_LN')}}. Rest assured, there are no hidden fees lurking in your transactions. What you see is what you get – straightforward and honest.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6" data-cue="slideInUp">
              <div class="business-card">
                <div class="icon">
                  <i class="flaticon-promotion"></i>
                </div>
                <div class="content">
                  <h3>
                    <a>World Class Support</a>
                  </h3>
                  <p>
                    At {{env('APP_FN')}}</span>{{env('APP_LN')}}, we prioritize your satisfaction. Our world-class support team is dedicated to assisting you promptly, ensuring a smooth and enjoyable experience throughout your journey with us.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6" data-cue="slideInUp">
              <div class="business-card">
                <div class="icon">
                  <i class="flaticon-payment-gateway"></i>
                </div>
                <div class="content">
                  <h3>
                    <a>Secure Payments</a>
                  </h3>
                  <p>
                    Your security is paramount. {{env('APP_FN')}}</span>{{env('APP_LN')}} employs state-of-the-art encryption and security measures to guarantee that your payments are not only easy but also highly secure.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6" data-cue="slideInUp">
              <div class="business-card">
                <div class="icon">
                  <i class="flaticon-easy-installation"></i>
                </div>
                <div class="content">
                  <h3>
                    <a>Intuitive Bill Payment</a>
                  </h3>
                  <p>
                   Gone are the days of long queues and complicated payment processes. {{env('APP_FN')}}</span>{{env('APP_LN')}} offers an intuitive bill payment process that allows you to settle your bills with just a few clicks. Say goodbye to stress.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6" data-cue="slideInUp">
              <div class="business-card">
                <div class="icon">
                  <i class="flaticon-investment-1"></i>
                </div>
                <div class="content">
                  <h3>
                    <a>Cashback Rewards</a>
                  </h3>
                  <p>
                    As a token of appreciation, {{env('APP_FN')}}</span>{{env('APP_LN')}} offers cashback rewards on successful bill payments. Enjoy the benefits of seamless transactions while earning rewards with every payment.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6" data-cue="slideInUp">
              <div class="business-card">
                <div class="icon">
                  <i class="flaticon-24-hours-support"></i>
                </div>
                <div class="content">
                  <h3>
                    <a>24/7 Online Service</a>
                  </h3>
                  <p>
                    Access {{env('APP_FN')}}</span>{{env('APP_LN')}}'s services anytime, anywhere. Our 24/7 online platform ensures uninterrupted convenience, allowing you to manage transactions, payments, and more.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6" data-cue="slideInUp">
              <div class="business-card">
                <div class="icon">
                  <i class="flaticon-money"></i>
                </div>
                <div class="content">
                  <h3>
                    <a>Secure Transactions</a>
                  </h3>
                  <p>
                    Your financial security is our top priority. {{env('APP_FN')}}</span>{{env('APP_LN')}} employs robust security measures, including encryption and secure authentication, to safeguard your payment and personal information during every transaction.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Business Warp End -->

    <!-- Video Warp Start -->
    <div class="video-style5-warp">
      <div class="container">
        <div class="video-btn-content">
          <div class="video-btn" onclick="openPopup()">
            <div class="icon rounded-circle">
              <i class="ri-play-fill"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Video Warp End -->

    <!-- Profile Warp Start -->
    <div class="profile-warp">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="profile-content single-section">
              <h2>
                Embark on your journey swiftly: Install the app, craft your profile, and you're set to experience seamless transactions in just a few minutes!
              </h2>
              <p>
               Experience the future of convenience and efficiency with <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}. Join us on this journey as we redefine the way you handle transactions and services. Your one-stop destination for all your needs awaits!
              </p>
              <div class="profile-widget">
                <div class="row justify-content-center">
                  <div class="col-lg-4 col-sm-6 col-md-4" data-cue="slideInUp">
                    <div class="profile-box">
                      <div class="icon bg1">
                        <i class="flaticon-install"></i>
                      </div>
                      <h5>1. Download</h5>
                      <p>Unlock convenience with a quick download for seamless experiences.</p>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-md-4" data-cue="slideInUp">
                    <div class="profile-box">
                      <div class="icon bg2">
                        <i class="flaticon-portfolio"></i>
                      </div>
                      <h5>2. Set Profile</h5>
                      <p>Craft your profile effortlessly for personalized and tailored transactions.</p>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-md-4" data-cue="slideInUp">
                    <div class="profile-box">
                      <div class="icon bg3">
                        <i class="flaticon-rocket"></i>
                      </div>
                      <h5>3. Start</h5>
                      <p>Initiate your journey instantly for swift and hassle-free transactions.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="profile-image">
              <img src="assets/images/payments/profile1.png" alt="image" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Profile Warp End -->

    <!-- Revolution Warp Start -->
    <div class="revolution-warp bg-F3F7FA ptb-100">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="revolution-image">
              <img
                src="assets/images/payments/revolution1.png"
                class="revolution"
                alt="image"
              />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="revolution-content single-section">
              <h2>
                Join the digital revolution today! Download the app and commence seamless payments now.
              </h2>
              <p>
                Experience the evolution of financial transactions with Rible. Enjoy the ease of secure, hassle-free online payments through our platform—quick and effortless.
              </p>
              <div class="store-btn d-flex align-items-center">
                <a href="{{env('GOOGLE_STORE_LINK')}}" class="app-store">
                  <img
                    src="assets/images/small-images/app-store.png"
                    alt="image"
                  />
                </a>
                <a href="{{env('APPLE_STORE_LINK')}}" class="play-store">
                  <img
                    src="assets/images/small-images/playstore.png"
                    alt="image"
                  />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <img
        src="assets/images/shapes/revolation-shape1.png"
        class="revolution-shape1"
        alt="image"
      />
    </div>
    <!-- Revolution Warp End -->

    <!-- Benefit Warp Start -->
    <div class="benefit-warp pt-100 pb-75">
      <div class="container">
        <div class="section-title">
          <h2>People are raving about the benefits we provide! They're expressing how our services stand out and meet their needs.</h2>
        </div>
        <div class="row">
          <div class="col-lg-6" data-cue="slideInUp">
            <div class="benefit-card d-flex align-items-center">
              <div class="content">
                <p>
                  “<span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} transformed my digital transactions. The easy interface and secure payments make it my go-to platform. It's a game-changer in convenience!”
                </p>

                <div class="name-review d-flex align-items-center">
                  <div class="name">
                    <h6>Eze Amaka</h6>
                    <span>Tailor</span>
                  </div>
                  <div class="star">
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-line"></i>
                  </div>
                </div>
              </div>
              <div class="benefit-image">
                <div class="icon">
                  <img
                    src="assets/images/svgs/benefit1.svg"
                    class="benefit1"
                    alt="benefit"
                  />
                </div>
                <div class="image">
                  <img
                    src="assets/images/users/Eze-Amaka.png"
                    class="benefit1"
                    alt="benefit"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-cue="slideInUp">
            <div class="benefit-card d-flex align-items-center">
              <div class="content">
                <p>
                  “Effortlessly set up, the app is a breeze. <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}'s seamless transactions and cashback rewards add a delightful touch. Highly recommend for the modern user!”
                </p>

                <div class="name-review d-flex align-items-center">
                  <div class="name">
                    <h6>Peter Anderson</h6>
                    <span>Web Developer</span>
                  </div>
                  <div class="star">
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-line"></i>
                  </div>
                </div>
              </div>
              <div class="benefit-image">
                <div class="icon">
                  <img
                    src="assets/images/svgs/benefit1.svg"
                    class="benefit1"
                    alt="benefit"
                  />
                </div>
                <div class="image">
                  <img
                    src="assets/images/users/Peter-Anderson.png"
                    class="benefit1"
                    alt="benefit"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Benefit Warp End -->

    <!-- Digital Warp Start -->
    <div class="digital-warp">
      <div class="container">
        <div class="inner-digital-warp">
          <div class="row align-items-center">
            <div class="col-xl-6 col-lg-8 col-md-8">
              <div class="digital-content">
                <h2>
                  Click, Pay, Enjoy! <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} - Transforming transactions into experiences.
                </h2>
                <div class="digital-widget d-flex align-items-center">
                  <ul class="digital-list">
                    <li><span>1.</span> Pay bills and top-up</li>
                    <li><span>2.</span> Deposit your money to wallet</li>
                    <li><span>3.</span> Request services from anywhere</li>
                  </ul>
                  <ul class="digital-list">
                    <li><span>1.</span> Secure payment</li>
                    <li><span>2.</span> Easy and fast payment</li>
                    <li><span>3.</span> Transfer money to a wallet account</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-4 col-md-4">
              <div class="digital-image">
                <a href="{{env('GOOGLE_STORE_LINK')}}" class="default-btn home-five-main"
                  >Start For Free</a
                >
                <a href="{{env('GOOGLE_STORE_LINK')}}" class="default-btn heading-color">Get App Now</a>
                <img
                  src="assets/images/small-images/padiswift-hand-holding-phone.png"
                  class="digital1-image2"
                  alt="digital"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Digital Warp End -->


@endsection