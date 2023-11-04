 <!-- Footer Warp Start -->
        <div class="footer-warp pt-100 pb-75 bg-f9f2f3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget style5">
                            <h4>Newsletter</h4>
                            <p>Try it today and experience the convenience of real-time support!</p>
                            <form>
                                <div class="input-box">
                                    <input type="text" class="form-control" placeholder="Email address">
                                    <button class="input-btn" type="submit">
                                        <img src="assets/images/svgs/paper-plane.svg" alt="paper-plane">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget style5">
                            <h4>Useful Links</h4>
                            <ul class="footer-link">
                                <li>
                                    <a href="/.">Home</a>
                                </li>
                                <li>
                                    <a href="services">Service </a>
                                </li>
                                <li>
                                    <a href="about">About Us</a>
                                </li>
                                <li>
                                    <a href="blog">Blog</a>
                                </li>
                                <li>
                                    <a href="contact">Contact Us</a>
                                </li>
                                <li>
                                    <a href="terms">Terms Of Use</a>
                                </li>
                                <li>
                                    <a href="policy">Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget style5 ">
                            <h4>Get In Touch</h4>
                            <ul class="footer-contact">
                                <li>
                                    <span>Call Customer Care</span>
                                    <a href="tel:18882345-6789">+1(888)2345-6789</a>
                                </li>
                                <li>
                                    <span>Need Support?</span>
                                    <a href="mailtto:info@padiSwift.com"><span class="__cf_email__">info@padiSwift.com</span></a>
                                </li>
                                <li>
                                    <span>Location</span>
                                    <p>No. 3 kenyatta Street, Uwani Enugu Nigeria </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget style5">
                            <h4>About Us</h4>
                            <p>At <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}, we believe in transforming the way you experience transactions and services. Our platform is more than just a place to pay bills or recharge your phone; it's a lifestyle upgrade designed to simplify your daily life.</p>
                            <a href="./" class="footer-logo">
                                <img width="160" src="assets/images/logo-main.png" alt="logo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Warp End -->

        <!-- Copyright Warp Start -->
        <div class="copyright-style2-warp  bg-f9f2f3">
            <div class="container">
                <div class="inner-copyright-warp style5 d-flex align-items-center justify-content-between">
                    <p>©<?php $d=date('Y'); print $d;?> <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}} is Proudly Owned by <a href="https://centadesk.com" target="_blank" rel="noopener">{{env('COMPANY_NAME')}}</a></p>
                    <ul class="social-list">
                        <li>
                            <a href="https://www.facebook.com/" target="_blank"><i class="ri-facebook-circle-line"></i></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/" target="_blank"><i class="ri-twitter-line"></i></a>
                        </li>
                        <li>
                            <a href="https://instagram.com/" target="_blank"><i class="ri-instagram-line"></i></a>
                        </li>
                        
                        <li>
                            <a href="https://youtube.com/" target="_blank"><i class="ri-youtube-line"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Copyright Warp End -->

        <!-- Video Popup Warp Start -->
        <div class="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <div class="modal-body">
                    <iframe class="video-bg-btn" src="https://www.youtube.com/embed/u9prcUCHlqM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
        <!-- Video Popup Warp End -->


        <!-- Scroll Top Btn -->
        <div class="top-button-icon">
            <button id="scrollTopBtn">
                <i class="ri-arrow-up-circle-fill"></i>
            </button>
        </div>
        <!-- Scroll Top Btn -->


        <!-- Links of JS File -->
        <script data-cfasync="false" src="{{ asset('assets/js/email-decode.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/scrollCue.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
    </body>
</html>   
