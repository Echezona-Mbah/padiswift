(function() {
	"use strict";

    // Navbar JS
    try {
        const nav = document.querySelector('.navbar');
        let navTop = nav.offsetTop;
        
        function fixedNav() {
            if (window.scrollY >= navTop) {
                nav.classList.add('sticky');
            } else {
                nav.classList.remove('sticky');
            }
        }
        window.addEventListener('scroll', fixedNav);
    } catch (err) {}

    // Header Sticky Js
    window.addEventListener('scroll', event => {
        const height = 150;
        const { scrollTop } = event.target.scrollingElement;
        document.querySelector('#navbar').classList.toggle('sticky', scrollTop >= height);
    });

    // Animation Js
    scrollCue.init();

    // Select the button element Js
    var scrollTopBtn = document.getElementById("scrollTopBtn");


    // Logo Sticky Js
    var swiper = new Swiper(".logo-slider", {
        slidesPerView: 2,
        spaceBetween: 0,
        loop: true,
        spaceBetween: 30,
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            576: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            992: {
                slidesPerView: 4
            },
            1200: {
                slidesPerView: 6
            }
        }
    });

    // Partner Slider Js
    var swiper = new Swiper(".partner-slider", {
        slidesPerView: 2,
        spaceBetween: 0,
        loop: true,
        spaceBetween: 30,
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            576: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            992: {
                slidesPerView: 4
            },
            1200: {
                slidesPerView: 6
            }
        }
    });

    // Select the button element Js
    var scrollTopBtn = document.getElementById("scrollTopBtn");

    // Show the button when the user scrolls down Js
    window.onscroll = function() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollTopBtn.style.display = "block";
    } else {
        scrollTopBtn.style.display = "none";
    }
    };
    
    // Add a click event listener to the button Js
    scrollTopBtn.addEventListener("click", function() {
        // Scroll to the top of the document
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: "smooth"
        });
    });

    // Preloader Js
    window.onload = function(){
        // Preloader
        const getPreloaderId = document.getElementById('preloader');
        if (getPreloaderId) {
            getPreloaderId.style.display = 'none';
        }
    };

    // Slider Js
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });

    // Customer Slider Js
    var swiper2 = new Swiper(".customer-slider", {
    spaceBetween: 10,
    thumbs: {
        swiper: swiper,
    },
    });

    // Overview Slider Js
    var swiper = new Swiper(".overview-slider", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
    });

    // Add a click event listener to the button Js
    try {
        about.addEventListener("click", function() {
            // Scroll to the top of the document
            window.scrollTo({
                top: auto,
                left: 0,
                behavior: "smooth"
            });
        });
    } catch (err) {}


    // Application Sticky Js
    var swiper = new Swiper(".application-slider", {
        slidesPerView: 5,
        centeredSlides: true,
        // autoplay: {
        //     delay: 5000,
        // },
        loop: true,
        spaceBetween: 20,
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            576: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            992: {
                slidesPerView: 4
            },
            1200: {
                slidesPerView: 5
            }
        }
    });

    // Career Slider Js
    var swiper = new Swiper(".career-slider", {
        slidesPerView: 5,
        spaceBetween: 30,
        centeredSlides: true,
        loop: true,
        roundLengths: true,
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            576: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            992: {
                slidesPerView: 4
            },
            1200: {
                slidesPerView: 5
            }
        }
    });


    try {
    
        // Add the "active" class to the first element when the page loads
        // window.addEventListener("load", function() {
        //     var element = document.getElementById("my-element-1");
        //     element.classList.add("active");
        // });
        
        // Remove the "active" class from the current element and add it to the new element when hovered over
        var elements = document.querySelectorAll("[id^='my-element']");
            elements.forEach(function(element) {
            element.addEventListener("mouseover", function() {
                elements.forEach(function(el) {
                el.classList.remove("active");
                });
                element.classList.add("active");
            });
        });
    
    } catch (err) {}


})()

// Video Popup
function openPopup() {
    document.querySelector('.popup').classList.add('popup-show');
}
function closePopup() {
    document.querySelector('.popup').classList.remove('popup-show');
}

