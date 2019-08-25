$(document).ready(function () {
    $('.logo-slider').owlCarousel({
        items: 4,
        margin: 20,
        loop: true,
        dots: false,
        dotsEach: true,
        dotsData: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplaySpeed: 1000,
        autoplayHoverPause: true,


    });

    $('.js-fullheight').css('height', '400px');
    // $('.js-logo-slider-height').css('height', '200px');
    // $('.js-section2-height').css('height', '620px')
    // $('.js-section-dev-height').css('height', '300px')

    // $('.prd-slider').owlCarousel({
    //     items: 4,
    //     margin: 20,
    //     loop: true,
    //     dots: false,
    //     dotsEach: true,
    //     dotsData: true,
    //     autoplay: true,
    //     autoplayTimeout: 3000,
    //     autoplaySpeed: 1000,
    //     autoplayHoverPause: true,


    // });

    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:20,
    responsiveClass:true,
    dots: false,
        dotsEach: true,
        dotsData: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplaySpeed: 1000,
        autoplayHoverPause: true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:4,
            nav:true,
            loop:false
        }
    }
})

    //    $('.js-fullheight').css('height', '400px');

});

// console.log('hello world');