jQuery(document).ready(function () {
    var fundraiser_nonprofit_swiper = new Swiper(".slider-main .swiper-container", {
        centeredSlides: true,
        loop: true,
        speed: 500,
        spaceBetween: 40,
        autoplay: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 1,
            },
            782: {
                slidesPerView: 1,
            },
            992: {
                slidesPerView: 3,
            }
        }
    });

    var fundraiser_nonprofit_swiper3 = new Swiper(".donation-section .mySwiper3", {
        centeredSlides: false,
        speed: 1200,
        autoplay: true,
        pagination: {
            el: ".donation-section .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
            slidesPerView: 1,
            },
            768: {
            slidesPerView: 3,
            },
            992: {
            slidesPerView: 3,
            }
        }
    });

});