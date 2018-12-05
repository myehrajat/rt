'use strict';

// Cache
var swiper2;
var body = jQuery('body');
var mainSlider = jQuery('#main-slider');
var imageCarousel = jQuery('.img-carousel');
var partnersCarousel = jQuery('#partners');
var testimonialsCarousel = jQuery('#testimonials');
var testimonialsCarouselAlt = jQuery('#testimonials-alt');
var carCarousel = jQuery('.car-carousel');
var topProductsCarousel = jQuery('#top-products-carousel');
var featuredProductsCarousel = jQuery('#featured-products-carousel');
var sidebarProductsCarousel = jQuery('#sidebar-products-carousel');
var hotDealsCarousel = jQuery('#hot-deals-carousel');
var owlCarouselSelector = jQuery('.owl-carousel');
var isotopeContainer = jQuery('.isotope');
var isotopeFiltrable = jQuery('#filtrable a');
var toTop = jQuery('#to-top');
var hover = jQuery('.thumbnail');
var navigation = jQuery('.navigation');
var superfishMenu = jQuery('ul.sf-menu');
var priceSliderRange = jQuery('#slider-range');

var swiperOffersBest = jQuery('.swiper--offers-best .swiper-container');
var swiperOffersPopular = jQuery('.swiper--offers-popular .swiper-container');
var swiperOffersEconomic = jQuery('.swiper--offers-economic .swiper-container');


// Slide in/out with fade animation function
jQuery.fn.slideFadeToggle = function (speed, easing, callback) {
    return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
};
//
jQuery.fn.slideFadeIn = function (speed, easing, callback) {
    return this.animate({opacity: 'show', height: 'show'}, speed, easing, callback);
};
jQuery.fn.slideFadeOut = function (speed, easing, callback) {
    return this.animate({opacity: 'hide', height: 'hide'}, speed, easing, callback);
};

jQuery(document).ready(function ($) {
    $('.sf-menu a').click(function () {
        $('nav').removeClass("opened");
        $(".navigation").addClass("closed");
    });
});

jQuery(document).ready(function ($) {

    $('.nav li a').click(function () {
        $(window).trigger('resize');


        setTimeout(function () {

            jQuery(window).trigger('resize');
        }, 50);


    });


    // Prevent empty links
    // ---------------------------------------------------------------------------------------
    /* jQuery('a[href=#]').on('click', function (event) {
     event.preventDefault();
     });*/

    // Sticky header/menu
    // ---------------------------------------------------------------------------------------
    if (jQuery().sticky) {
        jQuery('.header.fixed').sticky({topSpacing: 0});
        //jQuery('.header.fixed').on('sticky-start', function() { console.log("Started"); });
        //jQuery('.header.fixed').on('sticky-end', function() { console.log("Ended"); });
    }
    // SuperFish menu
    // ---------------------------------------------------------------------------------------
    if (jQuery().superfish) {
        superfishMenu.superfish();
    }
    //Wrong using of scrollspy
    /*
     jQuery('ul.sf-menu a').on('click', function () {
     body.scrollspy({
     offset: 100
     });
     });
     */

    // Fixed menu toggle
    jQuery('.menu-toggle').on('click', function () {
        if (navigation.hasClass('opened')) {
            navigation.removeClass('opened').addClass('closed');
        } else {
            navigation.removeClass('closed').addClass('opened');
        }
    });
    jQuery('.menu-toggle-close').on('click', function (e) {
        e.preventDefault();
        if (navigation.hasClass('opened')) {
            navigation.removeClass('opened').addClass('closed');
        } else {
            navigation.removeClass('closed').addClass('opened');
        }
    });
    //
    if (jQuery('.content-area.scroll').length) {
        jQuery('.open-close-area').on('click', function () {
            if (jQuery('.wrapper').hasClass('opened')) {
                jQuery('.wrapper').removeClass('opened').addClass('closed');
            } else {
                jQuery('.wrapper').removeClass('closed').addClass('opened');
            }
        });
    }
    // Smooth scrolling
    // ----------------------------------------------------------------------------------------
    jQuery('.sf-menu a, .scroll-to').on('click', function () {

        jQuery('.sf-menu a').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('html, body').animate({
            scrollTop: jQuery(jQuery(this).attr('href')).offset().top
        }, {
            duration: 1200,
            easing: 'easeInOutExpo'
        });
        return false;
    });
    // BootstrapSelect
    // ---------------------------------------------------------------------------------------
    if (jQuery().selectpicker) {
        jQuery('.selectpicker').selectpicker();
    }
    // prettyPhoto
    // ---------------------------------------------------------------------------------------
    if (jQuery().prettyPhoto) {
        jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
            theme: 'dark_square'
        });
    }
    // Scroll totop button
    // ---------------------------------------------------------------------------------------
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 1) {
            toTop.css({bottom: '15px'});
        } else {
            toTop.css({bottom: '-100px'});
        }
    });
    toTop.on('click', function () {
        jQuery('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });
    // Add hover class for correct view on mobile devices
    // ---------------------------------------------------------------------------------------
    /*hover.on('hover',
     function () {
     jQuery(this).addClass('hover');
     },
     function () {
     jQuery(this).removeClass('hover');
     }
     );*/
    // Ajax / load external content in tabs
    // ---------------------------------------------------------------------------------------
    jQuery('[data-toggle="tabajax"]').on('click', function (e) {
        e.preventDefault();
        var loadurl = jQuery(this).attr('href');
        var targ = jQuery(this).attr('data-target');
        jQuery.get(loadurl, function (data) {
            jQuery(targ).html(data);
        });
        jQuery(this).tab('show');
    });


    jQuery('#tabs1 a').on('click', function (e) {
        e.preventDefault();
        var loadurl = jQuery(this).attr('href');
        $('.mutabsss').removeClass('active ');
        jQuery('.mutabsss').removeClass('in');
        $('' + loadurl).addClass('in active');



    });


    // Sliders
    // ---------------------------------------------------------------------------------------
    if (jQuery().owlCarousel) {
        var owl = jQuery('.owl-carousel');
        owl.on('changed.owl.carousel', function (e) {
            // update prettyPhoto
            if (jQuery().prettyPhoto) {
                jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
                    theme: 'dark_square'
                });
            }
        });
        // Main slider
        if (mainSlider.length) {
            var items = jQuery('#main-slider .item');
            if (items.length > 2) {
                mainSlider.owlCarousel({
                    //items: 1,
                    rtl: rentit_obj.rtl,
                    autoplay: true,
                    autoplayHoverPause: true,
                    loop: true,
                    margin: 0,
                    dots: true,
                    nav: true,
                    navText: [
                        "<i class='fa fa-angle-left'></i>",
                        "<i class='fa fa-angle-right'></i>"
                    ],
                    responsiveRefreshRate: 100,
                    responsive: {
                        0: {items: 1},
                        479: {items: 1},
                        768: {items: 1},
                        991: {items: 1},
                        1024: {items: 1}
                    }
                });

            } else {
                mainSlider.owlCarousel({
                    //items: 1,
                    rtl: rentit_obj.rtl,
                    autoplay: true,
                    autoplayHoverPause: true,
                    loop: false,
                    margin: 0,
                    dots: true,
                    nav: true,
                    navText: [
                        "<i class='fa fa-angle-left'></i>",
                        "<i class='fa fa-angle-right'></i>"
                    ],
                    responsiveRefreshRate: 100,
                    responsive: {
                        0: {items: 1},
                        479: {items: 1},
                        768: {items: 1},
                        991: {items: 1},
                        1024: {items: 1}
                    }
                });
            }
        }
        // Top products carousel
        if (topProductsCarousel.length) {
            topProductsCarousel.owlCarousel({
                rtl: rentit_obj.rtl,
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 2},
                    768: {items: 3},
                    991: {items: 4},
                    1024: {items: 5},
                    1280: {items: 6}
                }
            });
        }
        // Featured products carousel
        if (featuredProductsCarousel.length) {
            featuredProductsCarousel.owlCarousel({
                rtl: rentit_obj.rtl,
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 2},
                    991: {items: 3},
                    1024: {items: 4}
                }
            });
        }
        // Sidebar products carousel
        if (sidebarProductsCarousel.length) {
            sidebarProductsCarousel.owlCarousel({
                rtl: rentit_obj.rtl,
                autoplay: false,
                loop: true,
                margin: 30,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
        // Partners carousel
        if (partnersCarousel.length) {
            partnersCarousel.owlCarousel({
                rtl: rentit_obj.rtl,
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 2},
                    768: {items: 3},
                    991: {items: 4},
                    1024: {items: 5},
                    1280: {items: 6}
                }
            });
        }
        // Testimonials carousel
        if (testimonialsCarousel.length) {
            testimonialsCarousel.owlCarousel({
                rtl: rentit_obj.rtl,
                autoplay: false,
                loop: false,
                margin: 0,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1},
                    1280: {items: 1}
                }
            });
        }
        // Testimonials carousel alt version
        if (testimonialsCarouselAlt.length) {
            testimonialsCarouselAlt.owlCarousel({
                rtl: rentit_obj.rtl,
                autoplay: false,
                loop: false,
                margin: 0,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 2},
                    1024: {items: 2},
                    1280: {items: 2}
                }
            });
        }

        // Images carousel
        if (imageCarousel.length) {

            imageCarousel.each(function (e) {

                var items = $(this).find('.item');
                if (items.length > 1) {
                    $(this).owlCarousel({
                        rtl: rentit_obj.rtl,
                        autoplay: false,
                        loop: true,
                        margin: 0,
                        dots: true,
                        nav: true,
                        navText: [
                            "<i class='fa fa-angle-left'></i>",
                            "<i class='fa fa-angle-right'></i>"
                        ],
                        responsiveRefreshRate: 100,
                        responsive: {
                            0: {items: 1},
                            479: {items: 1},
                            768: {items: 1},
                            991: {items: 1},
                            1024: {items: 1}
                        }
                    });
                } else {
                    $(this).owlCarousel({
                        rtl: rentit_obj.rtl,
                        autoplay: false,
                        loop: false,
                        margin: 0,
                        dots: false,
                        nav: false,
                        navText: [
                            "<i class='fa fa-angle-left'></i>",
                            "<i class='fa fa-angle-right'></i>"
                        ],
                        responsiveRefreshRate: 100,
                        responsive: {
                            0: {items: 1},
                            479: {items: 1},
                            768: {items: 1},
                            991: {items: 1},
                            1024: {items: 1}
                        }
                    });
                }

            });

        }
        // Car carousel
        if (carCarousel.length) {
            carCarousel.owlCarousel({
                rtl: rentit_obj.rtl,
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsiveRefreshRate: 100,
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 2},
                    991: {items: 3},
                    1024: {items: 3}
                }
            });
        }
        // on tab click
        jQuery('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            updater();
        });
        jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            updater();
        });
    }
    // Sliders
    // ---------------------------------------------------------------------------------------
    if (jQuery().swiper) {

        var swiperOffersBest4 = new Swiper(jQuery('.swiper--new'), {
            direction: 'horizontal',
            slidesPerView: 3,
            spaceBetween: 30,
            //autoplay: 2000,
            loop: true,
            paginationClickable: true,
            pagination: '.swiper-pagination',
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev'
        });

        if (swiperOffersBest.length) {
            swiperOffersBest = new Swiper(swiperOffersBest, {
                direction: 'horizontal',
                slidesPerView: 3,
                spaceBetween: 30,
                //autoplay: 2000,
                loop: true,
                paginationClickable: true,
                pagination: '.swiper-pagination',
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev'
            });
        }
        if (swiperOffersPopular.length) {
            swiperOffersPopular = new Swiper(swiperOffersPopular, {
                direction: 'horizontal',
                slidesPerView: 3,
                spaceBetween: 30,
                //autoplay: 2000,
                loop: true,
                paginationClickable: true,
                pagination: '.swiper-pagination',
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev'
            });
        }
        if (swiperOffersEconomic.length) {
            swiperOffersEconomic = new Swiper(swiperOffersEconomic, {
                direction: 'horizontal',
                slidesPerView: 3,
                spaceBetween: 30,
                //autoplay: 2000,
                loop: true,
                paginationClickable: true,
                pagination: '.swiper-pagination',
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev'
            });
        }
        var swiper = new Swiper('.navigation', {
            scrollbar: '.swiper-scrollbar',
            direction: 'vertical',
            slidesPerView: 'auto',
            mousewheelControl: true,
            freeMode: true
        });
        if (jQuery('.content-area.scroll').length) {
            var i = 0;
            swiper2 = new Swiper('.content-area.scroll', {
                scrollbar: '.swiper-scrollbar',
                direction: 'vertical',
                slidesPerView: 'auto',
                mousewheelControl: true,
                scrollbarDraggable: true,
                mousewheelForceToAxis: true,
                keyboardControl: true,
                freeMode: true,
                onTouchStart: function () {
                    //Do something when you touch the slide
                    //alert('OMG you touch the slide!')
                },
                onProgress: function (e) {
                    if (i > 1) {
                        loadajaxonmap(i);

                    }
                    // swiper2.updateContainerSize(); swiper2.update();
                    i++;
                }

            });


        }


        // /swiper in tabs
    }
    // countdown
    // ---------------------------------------------------------------------------------------
    /*if (jQuery().countdown) {
     var austDay = new Date();
     austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
     jQuery('#dealCountdown1').countdown({until: austDay});
     jQuery('#dealCountdown2').countdown({until: austDay});
     jQuery('#dealCountdown3').countdown({until: austDay});
     }*/
    // Google map
    // ---------------------------------------------------------------------------------------

    // Price range / need jquery ui
    // ---------------------------------------------------------------------------------------
    if (jQuery.ui) {
        if (jQuery(priceSliderRange).length) {
            var amount = jQuery("#amount");
            var amount_price = jQuery("#amout_rating");
            var space = '';
            if (rentit_obj.currency_pos == 'right_space' || rentit_obj.currency_pos == 'left_space') {
                space = ' ';

            }
            jQuery(priceSliderRange).slider({
                range: true,
                min: parseInt(amount.data('min')),
                max: parseInt(amount.data('max')),
                values: [amount.data('value_min'), amount.data('value_max')],
                slide: function (event, ui) {
                    if (rentit_obj.currency_pos == 'right' || rentit_obj.currency_pos == 'right_space') {
                        amount.val(ui.values[0] + space + rentit_obj.currency + " - " + ui.values[1] + space + rentit_obj.currency);
                        amount_price.val(ui.values[0] + ',' + ui.values[1]);
                    } else {
                        amount.val(rentit_obj.currency + space + ui.values[0] + " - " + rentit_obj.currency + space + ui.values[1]);
                        amount_price.val(ui.values[0] + ',' + ui.values[1]);
                    }
                }
            });

            if (rentit_obj.currency_pos == 'right' || rentit_obj.currency_pos == 'right_space') {
                amount.val(
                    jQuery("#slider-range").slider("values", 0) + space + rentit_obj.currency +
                    " - " + jQuery("#slider-range").slider("values", 1) + space + rentit_obj.currency
                );
            } else {
                amount.val(
                    rentit_obj.currency + space + jQuery("#slider-range").slider("values", 0) +
                    " - " + rentit_obj.currency + space + jQuery("#slider-range").slider("values", 1)
                );
            }
            amount_price.val(
                jQuery("#slider-range").slider("values", 0) + "," + jQuery("#slider-range").slider("values", 1)
            );

        }
    }
    // Shop categories widget slide in/out
    // ---------------------------------------------------------------------------------------
    jQuery('.car-categories .arrow').on('click', function (event) {

            jQuery(this).parent().parent().find('ul.children').removeClass('active');
            jQuery(this).parent().parent().find('.fa-angle-up').addClass('fa-angle-down').removeClass('fa-angle-up');
            if (jQuery(this).parent().find('ul.children').is(":visible")) {
                //jQuery(this).find('.fa-angle-up').addClass('fa-angle-down').removeClass('fa-angle-up');
                //jQuery(this).parent().find('ul.children').removeClass('active');
            }
            else {
                jQuery(this).find('.fa-angle-down').addClass('fa-angle-up').removeClass('fa-angle-down');
                jQuery(this).parent().find('ul.children').addClass('active');
            }
            jQuery(this).parent().parent().find('ul.children').each(function () {
                if (!jQuery(this).hasClass('active')) {
                    jQuery(this).slideFadeOut();
                }
                else {
                    jQuery(this).slideFadeIn();
                }
            });
        }
    );
    jQuery('.car-categories ul.children').each(function () {
        if (!jQuery(this).hasClass('active')) {
            jQuery(this).hide();
        }
    });
    // Ripple effect on click for buttons
    // ---------------------------------------------------------------------------------------
    jQuery(".ripple-effect").on('click', function (e) {
        var rippler = jQuery(this);

        // create .ink element if it doesn't exist
        if (rippler.find(".ink").length == 0) {
            rippler.append("<span class='ink'></span>");
        }

        var ink = rippler.find(".ink");

        // prevent quick double clicks
        ink.removeClass("animate");

        // set .ink diametr
        if (!ink.height() && !ink.width()) {
            var d = Math.max(rippler.outerWidth(), rippler.outerHeight());
            ink.css({height: d, width: d});
        }

        // get click coordinates
        var x = e.pageX - rippler.offset().left - ink.width() / 2;
        var y = e.pageY - rippler.offset().top - ink.height() / 2;

        // set .ink position and add class .animate
        ink.css({
            top: y + 'px',
            left: x + 'px'
        }).addClass("animate");
    })
    updater();
});

jQuery(window).load(function () {
    // Preloader
    jQuery('#status').fadeOut();
    jQuery('#preloader').delay(200).fadeOut(200);

    // Isotope
    if (jQuery().isotope) {

        isotopeContainer.isotope({ // initialize isotope
            itemSelector: '.isotope-item' // options...
            //,transitionDuration: 0 // disable transition
        });
        isotopeFiltrable.on('click', function () { // filter items when filter link is clicked
            var selector = jQuery(this).attr('data-filter');
            isotopeFiltrable.parent().removeClass('current');
            jQuery(this).parent().addClass('current');
            isotopeContainer.isotope({filter: selector});
            return false;
        });
        isotopeContainer.isotope('reLayout'); // layout/reLayout
    }
    // Scroll to hash
    if (location.hash != '') {
        var hash = '#' + window.location.hash.substr(1);
        if (hash.length) {
            body.delay(0).animate({
                scrollTop: jQuery(hash).offset().top
            }, {
                duration: 1200,
                easing: "easeInOutExpo"
            });
        }
    }
    // OwlSliders
    if (jQuery().owlCarousel) {
        // Hot deal carousel
        // must initialized after counters
        if (hotDealsCarousel.length) {
            hotDealsCarousel.owlCarousel({
                rtl: rentit_obj.rtl,
                autoplay: false,
                loop: true,
                margin: 30,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
    }
    updater();
});

function updater() {
    if (jQuery().sticky) {
        jQuery('.header.fixed').sticky('update');
    }

    /*   if (typeof(swiperSlider5x1.length) == 'undefined') {
     swiperSlider5x1.update();
     swiperSlider5x1.onResize();
     }*/

    // refresh swiper slider
    if (jQuery().swiper) {

///GREAT RENTAL OFFERS FOR YOU
        jQuery('.swiper-container-GREAT-RENTAL').each(function (index, element) {
            jQuery(this).addClass('s' + index);
            var slidesPerView = 3;
            if (jQuery(window).width() > 991) {
                slidesPerView = 3;
            }
            else {
                if (jQuery(window).width() < 768) {
                    slidesPerView = 1;
                }
                else {
                    slidesPerView = 2;
                }
            }
            var swiper = jQuery('.swiper-container.s' + index);
            swiper.swiper({
                direction: 'horizontal',
                slidesPerView: slidesPerView,
                spaceBetween: 30,
                //autoplay: 2000,
                loop: true,
                paginationClickable: true,
                pagination: '.swiper-pagination',
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev'
            });


            if (typeof(swiper.length) == 'undefined') {
                swiper.update();
                swiper.onResize();

            }

        });


        //via $('.s1').data('swiper')
        if (typeof(swiperOffersBest.length) == 'undefined') {
            swiperOffersBest.update();
            swiperOffersBest.onResize();
            if (jQuery(window).width() > 991) {
                swiperOffersBest.params.slidesPerView = 3;
                //swiperOffersBest.stopAutoplay();
                //swiperOffersBest.startAutoplay();
            }
            else {
                if (jQuery(window).width() < 768) {
                    swiperOffersBest.params.slidesPerView = 1;
                    //swiperOffersBest.stopAutoplay();
                    //swiperOffersBest.startAutoplay();
                }
                else {
                    swiperOffersBest.params.slidesPerView = 2;
                    //swiperOffersBest.stopAutoplay();
                    //swiperOffersBest.startAutoplay();
                }
            }
        }
        //
        if (typeof(swiperOffersPopular.length) == 'undefined') {
            swiperOffersPopular.update();
            swiperOffersPopular.onResize();
            if (jQuery(window).width() > 991) {
                swiperOffersPopular.params.slidesPerView = 3;
                //swiperOffersPopular.stopAutoplay();
                //swiperOffersPopular.startAutoplay();
            }
            else {
                if (jQuery(window).width() < 768) {
                    swiperOffersPopular.params.slidesPerView = 1;
                    //swiperOffersPopular.stopAutoplay();
                    //swiperOffersPopular.startAutoplay();
                }
                else {
                    swiperOffersPopular.params.slidesPerView = 2;
                    //swiperOffersPopular.stopAutoplay();
                    //swiperOffersPopular.startAutoplay();
                }
            }
        }
        //
        if (typeof(swiperOffersEconomic.length) == 'undefined') {
            swiperOffersEconomic.update();
            swiperOffersEconomic.onResize();
            if (jQuery(window).width() > 991) {
                swiperOffersEconomic.params.slidesPerView = 3;
                swiperOffersEconomic.stopAutoplay();
                swiperOffersEconomic.startAutoplay();
            }
            else {
                if (jQuery(window).width() < 768) {
                    swiperOffersEconomic.params.slidesPerView = 1;
                    swiperOffersEconomic.stopAutoplay();
                    swiperOffersEconomic.startAutoplay();
                }
                else {
                    swiperOffersEconomic.params.slidesPerView = 2;
                    swiperOffersEconomic.stopAutoplay();
                    swiperOffersEconomic.startAutoplay();
                }
            }
        }
        // swiper in tabs
        /* if (typeof(swiperSlider1x1.length) == 'undefined') {
         swiperSlider1x1.update();
         swiperSlider1x1.onResize();
         }
         if (typeof(swiperSlider1x2.length) == 'undefined') {
         swiperSlider1x2.update();
         swiperSlider1x2.onResize();
         }
         if (typeof(swiperSlider1x3.length) == 'undefined') {
         swiperSlider1x3.update();
         swiperSlider1x3.onResize();
         }
         if (typeof(swiperSlider1x4.length) == 'undefined') {
         swiperSlider1x4.update();
         swiperSlider1x4.onResize();
         }
         if (typeof(swiperSlider1x5.length) == 'undefined') {
         swiperSlider1x5.update();
         swiperSlider1x5.onResize();
         }

         if (typeof(swiperSlider2x1.length) == 'undefined') {
         swiperSlider2x1.update();
         swiperSlider2x1.onResize();
         }
         if (typeof(swiperSlider2x2.length) == 'undefined') {
         swiperSlider2x2.update();
         swiperSlider2x2.onResize();
         }
         if (typeof(swiperSlider2x3.length) == 'undefined') {
         swiperSlider2x3.update();
         swiperSlider2x3.onResize();
         }
         if (typeof(swiperSlider2x4.length) == 'undefined') {
         swiperSlider2x4.update();
         swiperSlider2x4.onResize();
         }
         if (typeof(swiperSlider2x5.length) == 'undefined') {
         swiperSlider2x5.update();
         swiperSlider2x5.onResize();
         }

         if (typeof(swiperSlider3x1.length) == 'undefined') {
         swiperSlider3x1.update();
         swiperSlider3x1.onResize();
         }
         if (typeof(swiperSlider3x2.length) == 'undefined') {
         swiperSlider3x2.update();
         swiperSlider3x2.onResize();
         }
         if (typeof(swiperSlider3x3.length) == 'undefined') {
         swiperSlider3x3.update();
         swiperSlider3x3.onResize();
         }
         if (typeof(swiperSlider3x4.length) == 'undefined') {
         swiperSlider3x4.update();
         swiperSlider3x4.onResize();
         }
         if (typeof(swiperSlider3x5.length) == 'undefined') {
         swiperSlider3x5.update();
         swiperSlider3x5.onResize();
         }

         if (typeof(swiperSlider4x1.length) == 'undefined') {
         swiperSlider4x1.update();
         swiperSlider4x1.onResize();
         }
         if (typeof(swiperSlider4x2.length) == 'undefined') {
         swiperSlider4x2.update();
         swiperSlider4x2.onResize();
         }
         if (typeof(swiperSlider4x3.length) == 'undefined') {
         swiperSlider4x3.update();
         swiperSlider4x3.onResize();
         }
         if (typeof(swiperSlider4x4.length) == 'undefined') {
         swiperSlider4x4.update();
         swiperSlider4x4.onResize();
         }
         if (typeof(swiperSlider4x5.length) == 'undefined') {
         swiperSlider4x5.update();
         swiperSlider4x5.onResize();
         }*/


    }

    // refresh waypoints
    //jQuery.waypoints('refresh');
    // refresh owl carousels/sliders
    //owlCarouselSelector.trigger('refresh');
    //owlCarouselSelector.trigger('refresh.owl.carousel');


    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);


    jQuery(document).ready(function () {
		/*MYEDIT>*/
        moment.updateLocale('en', {
        //moment.lang('en', {
		/*<MYEDIT*/
            week: {dow: 1}
        });

        jQuery("#formSearchUpDate50").datetimepicker({
            minDate: today,
            format: rentit_obj.date_format,
            locale: rentit_obj.lang,

        });
        jQuery("#formSearchOffDate50").datetimepicker({
            minDate: today,
            format: rentit_obj.date_format,
            locale: rentit_obj.lang,

        });

        jQuery("#formSearchUpDate50").on("dp.change", function (e) {
            jQuery("#formSearchOffDate50").data("DateTimePicker").minDate(e.date);
        });
        jQuery("#formSearchOffDate50").on("dp.change", function (e) {
            jQuery("#formSearchUpDate50").data("DateTimePicker").minDate(e.date);
        });


        jQuery('#formSearchUpDate').datetimepicker({
            minDate: today,
            format: rentit_obj.date_format,
            locale: rentit_obj.lang,
        });

        jQuery('#formSearchOffDate').datetimepicker({
            minDate: today,
            format: rentit_obj.date_format,
            locale: rentit_obj.lang

        });

        jQuery('#formSearchUpDate2').datetimepicker({
            minDate: today,
            format: rentit_obj.date_format,
            locale: rentit_obj.lang

        });


        jQuery('#formSearchOffDate2').datetimepicker({
            minDate: today,
            format: rentit_obj.date_format,
            locale: rentit_obj.lang

        });


        //moment().format('MMMM Do YYYY, h:mm:ss a'); // December 31st 2015, 2:26:52 pm

        jQuery('#formSearchUpDate3').datetimepicker({
            minDate: today,
            sideBySide: true,
            format: rentit_obj.date_format,
            disabledDates: rentit_obj.reserved_date,
            //  disabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 21, 22, 23, 24],
            locale: rentit_obj.lang//exclude those dates are already reserved

        });
        jQuery('#formSearchUpDate30').datetimepicker({
            minDate: today,
            format: rentit_obj.date_format,

            //  disabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 21, 22, 23, 24],
            locale: rentit_obj.lang//exclude those dates are already reserved

        });

        jQuery('#formSearchOffDate3').datetimepicker({
            minDate: today,
            sideBySide: true,
            format: rentit_obj.date_format,
            disabledDates: rentit_obj.reserved_date,
            locale: rentit_obj.lang//exclude those dates are already reserved

        });
        jQuery('#formSearchOffDate300').datetimepicker({
            minDate: today,
            format: rentit_obj.date_format,
            disabledDates: rentit_obj.reserved_date,
            locale: rentit_obj.lang//exclude those dates are already reserved

        });

        jQuery("#formSearchUpDate2").on("dp.change", function (e) {
            jQuery("#formSearchOffDate2").data("DateTimePicker").minDate(e.date);
        });
        jQuery("#formSearchOffDate2").on("dp.change", function (e) {
            jQuery("#formSearchUpDate2").data("DateTimePicker").minDate(e.date);
        });


        //min date on chage datepiker
        jQuery("#formSearchUpDate3").on("dp.change", function (e) {
            jQuery("#formSearchOffDate3").data("DateTimePicker").minDate(e.date);
        });
        jQuery("#formSearchOffDate3").on("dp.change", function (e) {
            jQuery("#formSearchUpDate3").data("DateTimePicker").minDate(e.date);
        });


        jQuery("#formSearchUpDate").on("dp.change", function (e) {
            jQuery("#formSearchOffDate").data("DateTimePicker").minDate(e.date);
        });
        //��� ��������� ���� � 9 datetimepicker, ��� ��������������� ��� ������������ ��� 8 datetimepicker
        jQuery("#formSearchOffDate").on("dp.change", function (e) {
            jQuery("#formSearchUpDate").data("DateTimePicker").minDate(e.date);
        });


        jQuery('#formFindCarDate').datetimepicker({
            //  minDate: today,
            format: rentit_obj.date_format,
            locale: rentit_obj.lang

        });


        jQuery('#formSearchOffDate5').datetimepicker({
            //  minDate: today,
            format: rentit_obj.date_format,
            locale: rentit_obj.lang

        });
        jQuery('#formSearchUpDate5').datetimepicker({
            //  minDate: today,
            format: rentit_obj.date_format,
            locale: rentit_obj.lang

        });


    });
}

jQuery(window).resize(function () {
    // Refresh isotope
    if (jQuery().isotope) {
        isotopeContainer.isotope('reLayout'); // layout/relayout on window resize
    }
    updater();
});

jQuery(window).scroll(function () {
    if (jQuery().sticky) {
        jQuery('.header.fixed').sticky('update');
    }
});


jQuery(document).ready(function ($) {



    //coments flag
    $(document).on("click", '.flag_grey', function (e) {
        if ($('div').is('#wpadminbar')) {
            $(this).removeClass('flag_grey');
            document.cookie = "comentid" + $(this).data('id') + "=1";
        }

    });
    //post like
    $(document).on("click", '.heart_post_like', function (e) {
        e.preventDefault();
        var this_a = $(this);
        var minus = 0;

        if (document.cookie.match(new RegExp("post_like" + this_a.data('id')))) {
            minus = 1;
            deleteCookie("post_like" + this_a.data('id'));
        } else {
            document.cookie = "post_like" + this_a.data('id') + "=1";
        }
        jQuery.ajax({
            url: rentit_obj.ajaxurl,
            type: 'POST',
            data: {
                action: 'rentit_ajax_post_like',
                id: this_a.data('id'),
                minus: minus
            },
            success: function (html) {
                this_a.html('<i class="fa fa-heart"> </i>' + html);
            }

        });


    });

    //I accept all information and Payments etc
    $('#checkboxa1').click(function () {
        var $this = $(this);
        // $this will contain a reference to the checkbox

        if ($this.is(':checked')) {
            // the checkbox was checked
            $('#reservation_car_btn').prop('disabled', false);
        } else {
            // the checkbox was unchecked
            $('#reservation_car_btn').prop('disabled', true);
        }
    });
    // error message if not plugin activate
    $('#reservation_car_btn').click(function () {
        if (rentit_obj.plugin_activate == false) {
            alert(rentit_obj.plugin_error_message);
            return false;
        }

    });

    var navbarAffixHeight = 70;
    $('.rentit_topmenu a[href^="#"]').on('click', function () {
        var target = $(this.hash);
        if (target.length) {
            $('html,body').animate({
                scrollTop: (target.offset().top - navbarAffixHeight + 1)
            }, 1000);
            return false;
        }
    });


});

function loadajaxonmap(i) {

    jQuery.ajax({
        url: rentit_obj.ajaxurl,
        type: 'POST',
        data: {
            action: 'rentit_ajax_get_car_list',
            GET: rentit_obj.GET,
            page_no: i,
        },
        success: function (html) {
            /*$(".woocommerce-cat-item").append(html); // This will be the div where our content will be loaded
             ajax = true;*/

            jQuery(".ajax-car-list").append(html);
            setTimeout(function () {
                swiper2.update();
            }, 500);


        }

    });
}


function deleteCookie(name) {
    setCookie(name, "", {
        expires: -1
    })
}

function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }
}



