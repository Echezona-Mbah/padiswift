<?php $active6='active';?>
@extends('layout')
@section('title', 'Contact Us | Best Bills Payment, Data Purchase, Airtime Purchase, Followers and Subscribers Purchase Platform')
@section('description', 'Home')
@section('keyword', 'PadiSwift, Swift, Bills, Payment, Data, Purchase, Airtime, Followers, Subscribers, Easy, Top up, phone, airtime, internet data, Pay, electricity, bills, renew, TV, subscriptions, cable, sub')
@section('content')

 <!-- About Hero Warp Start -->
        <div class="inner-hero-warp">
            <div class="container">
                <div class="inner-hero-content">
                    <h1>Connect With Us</h1>
                    <p>Thank you for reaching out to <span class="home-one-colory">{{env('APP_FN')}}</span>{{env('APP_LN')}}. Your inquiries are important to us, and we are here to assist you in any way we can.</p>
                </div>
            </div>
        </div>
        <!-- About Hero Warp End -->

        <!-- Contact Warp Start -->
        <div class="contact-warp ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-content single-section">
                            <span class="features-title">Contact Us</span>
                            <h2>Get In Touch With Us</h2>
                            <p></p>
                            <div class="contact-widget d-flex align-items-center ">
                                <div class="icon-style">
                                    <div class="icon">
                                        <img src="assets/images/svgs/contact1.svg" class="contact1" alt="contact1">
                                    </div>
                                </div>
                                <div class="content">
                                    <h5>Connect With Email</h5>
                                    <a href="mailto:info@padiswift.com"><span class="__cf_email__">info@padiswift.com</span></a>
                                </div>
                            </div>
                            <div class="contact-widget d-flex align-items-center ">
                                <div class="icon-style">
                                    <div class="icon">
                                        <img src="assets/images/svgs/contact2.svg" class="contact1" alt="contact1">
                                    </div>
                                </div>
                                <div class="content">
                                    <h5>Connect With Call</h5>
                                    <a href="tel:55036266727">+550 362 66727</a>
                                </div>
                            </div>
                            <div class="contact-widget d-flex align-items-center ">
                                <div class="icon-style">
                                    <div class="icon">
                                        <img src="assets/images/svgs/contact3.svg" class="contact1" alt="contact1">
                                    </div>
                                </div>
                                <div class="content">
                                    <h5>Connect With Locations</h5>
                                    <span>No. 3 kenyatta Street, Uwani Enugu Nigeria </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="massage-warp">
                            <!-- <h3>Send A Message</h3> -->
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label for="exampleFormControlInput1" class="form-label">First Name</label>
                                            <input type="text" name="fname" id="fname" class="form-control"  placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                                            <input type="text" name="lname" id="lname" class="form-control"  placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label for="exampleFormControlInput1" class="form-label">Your Message</label>
                                            <textarea type="text" class="form-control" name="message" id="message" placeholder="Type Your Text Here......."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <button class="default-btn heading-color" name="submit" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Warp End -->


@endsection