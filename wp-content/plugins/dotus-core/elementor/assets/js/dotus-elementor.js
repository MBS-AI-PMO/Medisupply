/*
Template Name: Dotus
Author: wpoceans
Version: 1.0
*/

(function($){
'use strict';

    /*------------------------------------------
        = Header search toggle
    -------------------------------------------*/
    if($(".global-header__search-wrapper").length) {
        var searchToggleBtn = $(".global-search__toggle-btn");
        var searchToggleBtnIcon = $(".global-search__toggle-btn i");
        var searchContent = $(".global_header__search-form");
        var body = $("body");

        searchToggleBtn.on("click", function(e) {
            searchContent.toggleClass("global_header__content-toggle");
            searchToggleBtnIcon.toggleClass("fi ti-close");
            e.stopPropagation();
        });

        body.on("click", function() {
            searchContent.removeClass("global_header__content-toggle");
        }).find(searchContent).on("click", function(e) {
            e.stopPropagation();
        });
    }

    // Toggle mobile navigation
    function toggleMobileNavigation() {
        var navbar = $(".navigation__collapse");
        var openBtn = $(".mobile__navigation .open__navbar");
        var xbutton = $(".mobile__navigation .navbar-toggler");

        openBtn.on("click", function(e) {
            e.stopImmediatePropagation();
            navbar.toggleClass("slideInn");
            xbutton.toggleClass("x-close");
            return false;
        })
    }

    toggleMobileNavigation();

     // Function for toggle class for small menu
    function toggleClassForSmallNav() {
        var windowWidth = window.innerWidth;
        var mainNav = $("#navbar > ul");

        if (windowWidth <= 991) {
            mainNav.addClass("small-nav");
        } else {
            mainNav.removeClass("small-nav");
        }
    }

    toggleClassForSmallNav();

     // Function for small menu
    function smallNavFunctionality() {
        var windowWidth = window.innerWidth;
        var mainNav = $(".navigation__collapse");
        var smallNav = $(".navigation__collapse > .small-nav");
        var subMenu = smallNav.find(".sub-menu");
        var megamenu = smallNav.find(".mega-menu");
        var menuItemWidthSubMenu = smallNav.find(".menu-item-has-children > a");

        if (windowWidth <= 991) {
            subMenu.hide();
            megamenu.hide();
            menuItemWidthSubMenu.on("click", function(e) {
                var $this = $(this);
                $this.siblings().slideToggle();
                e.preventDefault();
                e.stopImmediatePropagation();
                $this.toggleClass("rotate");
            })
        } else if (windowWidth > 991) {
            mainNav.find(".sub-menu").show();
            mainNav.find(".mega-menu").show();
        }
    }

    smallNavFunctionality();

    $("body").on("click", function() {
        $('.navigation__collapse').removeClass('slideInn');
    });
    $(".menu-close").on("click", function() {
        $('.navigation__collapse').removeClass('slideInn');
    });
    $(".menu-close").on("click", function() {
        $('.open-btn').removeClass('x-close');
    });


    /*------------------------------------------
        = STICKY HEADER
    -------------------------------------------*/

    // Function for clone an element for sticky menu
    function cloneNavForSticyMenu($ele, $newElmClass) {
        $ele.addClass('original').clone().insertAfter($ele).addClass($newElmClass).removeClass('original');
    }

    // clone home style 1 navigation for sticky menu
    if ($('.global-header__navigation .global__navigation').length) {
        cloneNavForSticyMenu($('.global-header__navigation .global__navigation'), "sticky-header");
    }

    var lastScrollTop = '';

    function stickyMenu($targetMenu, $toggleClass) {
        var st = $(window).scrollTop();
        var mainMenuTop = $('.global-header__navigation .global__navigation');

        if ($(window).scrollTop() > 500) {
            if (st > lastScrollTop) {
                // hide sticky menu on scroll down
                $targetMenu.addClass($toggleClass);

            } else {
                // active sticky menu on scroll up
                $targetMenu.addClass($toggleClass);
            }

        } else {
            $targetMenu.removeClass($toggleClass);
        }

        lastScrollTop = st;


    }

     /*==========================================================================
        WHEN WINDOW SCROLL
    ==========================================================================*/
    $(window).on("scroll", function() {

        if ($(".global-header__navigation").length) {
           stickyMenu( $('.global-header__navigation .global__navigation'), "sticky-on" );
        }


    });

    /*=========================================================================
        WHEN DOCUMENT LOADING
    ==========================================================================*/
    $(window).on('load', function() {

        toggleMobileNavigation();

    });


     /*==========================================================================
        WHEN WINDOW RESIZE
    ==========================================================================*/
    $(window).on("resize", function() {
        toggleClassForSmallNav();

        clearTimeout($.data(this, 'resizeTimer'));
        $.data(this, 'resizeTimer', setTimeout(function() {
            smallNavFunctionality();
        }, 200));
    });


/*----- ELEMENTOR LOAD FUNTION CALL ---*/

$( window ).on( 'elementor/frontend/init', function() {

	var swiper_slide = function(){
	 
      // HERO SLIDER
    var menu = [];
    jQuery('.swiper-slide').each(function (index) {
        menu.push(jQuery(this).find('.slide-inner').attr("data-text"));
    });
    var interleaveOffset = 0.5;
    var swiperOptions = {
        loop: true,
        speed: 1000,
        parallax: true,
        autoplay: {
            delay: 6500,
            disableOnInteraction: false,
        },
        watchSlidesProgress: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">' + (index + 1) + "</span>";
            },
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        on: {
            progress: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    var slideProgress = swiper.slides[i].progress;
                    var innerOffset = swiper.width * interleaveOffset;
                    var innerTranslate = slideProgress * innerOffset;
                    swiper.slides[i].querySelector(".slide-inner").style.transform =
                        "translate3d(" + innerTranslate + "px, 0, 0)";
                }
            },

            touchStart: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = "";
                }
            },

            setTransition: function (speed) {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(".slide-inner").style.transition =
                        speed + "ms";
                }
            }
        }
    };

    var swiper = new Swiper(".swiper-container", swiperOptions);


	}; // end



    // sliderBgSetting

    var sliderBgSetting = function(){
        // DATA BACKGROUND IMAGE
        var sliderBgSetting = $(".slide-bg-image");
        sliderBgSetting.each(function (indx) {
            if ($(this).attr("data-background")) {
                $(this).css("background-image", "url(" + $(this).data("background") + ")");
            }
        });

        

    }; // end



    var hero_client_slider = function(){

        /*------------------------------------------
        wpo-supporter-slide
        -------------------------------------------*/
        if ($(".wpo-supporter-slide").length) {
            $(".wpo-supporter-slide").owlCarousel({
                autoplay: true,
                smartSpeed: 300,
                margin: 0,
                loop: true,
                autoplayHoverPause: true,
                dots: false,
                nav: false,
                items: 4
            });
        }


    }; // end

    var feature_active = function(){

      //  hover-active
        let items = document.querySelectorAll('.wpo-features-area .features-wrap .feature-item-wrap, .wpo-team-section .wpo-team-wrap .wpo-team-item');
        items.forEach(item => item.addEventListener('mouseenter', function () { handleHover(this, items) }))
        function handleHover(el) {
            items.forEach(item => {
                item.classList.remove('active')
                item.classList.add('item')
            })

            el.classList.add('active')
        }


    }; // end


    var service_slider = function(){

      
    /*------------------------------------------
        = Service Slider
    -------------------------------------------*/
    if ($(".wpo-service-slider").length) {
        $(".wpo-service-slider").owlCarousel({
            autoplay: false,
            smartSpeed: 300,
            margin: 20,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            nav: false,
            navText: ['<i class="fi flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-2"></i>'],
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                    nav: false
                },

                500: {
                    items: 1,
                    dots: true,
                    nav: false
                },

                768: {
                    items: 2,
                },

                1200: {
                    items: 3
                },

                1400: {
                    items: 4
                },

            }
        });
    }


    }; // end



    var campaign_slider = function(){

        /*------------------------------------------
            = wpo-campaign-active
        -------------------------------------------*/
        if ($(".wpo-campaign-active".length)) {
            $(".wpo-campaign-active").owlCarousel({
                mouseDrag: false,
                smartSpeed: 500,
                margin: 30,
                loop: true,
                nav: true,
                navText: ['<i class="fi ti-arrow-left"></i>', '<i class="fi ti-arrow-right"></i>'],
                dots: false,
                items: 1
            });
        }


    }; // end

    var portfolio_slider2 = function(){

        /*------------------------------------------
        = project SLIDER
        -------------------------------------------*/
        if ($(".wpo-project-slider-s2").length) {
            $(".wpo-project-slider-s2").owlCarousel({
                autoplay: false,
                smartSpeed: 300,
                margin: 100,
                loop: true,
                autoplayHoverPause: true,
                dots: true,
                center: true,
                nav: true,
                navText: ['<i class="ti-arrow-left"></i>', '<i class="ti-arrow-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                        dots: true,
                        nav: false,
                        center: false,
                        margin: 30,
                    },

                    500: {
                        items: 1,
                        dots: true,
                        nav: false,
                        center: false,
                        margin: 30,
                    },

                    768: {
                        items: 2,
                        center: false,
                        margin: 30,
                    },

                    991: {
                        items: 2,
                        center: false,
                        margin: 30,
                    },
                    1200: {
                        items: 3,
                    },

                    1400: {
                        items: 3
                    },

                }
            });
        }
    }; // end



    var testimonials_slider = function(){
     
         // testimonial

        if ($(".testimonial-right").length) {
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: true,
                fade: true,
                arrows: false,
                centerMode: true,
                focusOnSelect: true,
                responsive: [

                    {
                        breakpoint: 480,
                        settings: {
                            dots: false,
                        }
                    }
                ]
            });
        }

    }; // end



    
    var odometer = function(){

       /*------------------------------------------
        = FUNFACT
        -------------------------------------------*/
        if ($(".odometer").length) {
            $('.odometer').appear();
            $(document.body).on('appear', '.odometer', function(e) {
                var odo = $(".odometer");
                odo.each(function() {
                    var countNumber = $(this).attr("data-count");
                    $(this).html(countNumber);
                });
            });
        }



    }; // end


    var team_slider = function(){

       /*------------------------------------------
        = TEAM SLIDER
        -------------------------------------------*/
        if ($(".team-slider").length) {
            $(".team-slider").owlCarousel({
                autoplay: false,
                smartSpeed: 300,
                margin: 0,
                loop:true,
                autoplayHoverPause:true,
                dots: false,
                nav: true,
                navText: ['<i class="fi flaticon-back"></i>','<i class="fi flaticon-next-1"></i>'],
                responsive: {
                    0 : {
                        items: 1
                    },

                    600 : {
                        items: 2
                    },

                    768 : {
                        items: 3
                    },

                    1200 : {
                        items: 4
                    }
                }
            });
        }



    }; // end


    var partners_slider = function(){

    /*------------------------------------------
            = PARTNERS SLIDER
    -------------------------------------------*/
    if ($(".partners-slider").length) {
        $(".partners-slider").owlCarousel({
            autoplay: true,
            smartSpeed: 300,
            margin: 30,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            arrows: false,
            responsive: {
                0: {
                    items: 1
                },

                550: {
                    items: 2
                },

                992: {
                    items: 3
                },

                1300: {
                    items: 5
                }
            }
        });
    }


    }; // end



    var instagram_slider = function(){

         /*------------------------------------------
            = instagram-slider
        -------------------------------------------*/
        if ($(".instagram-slider").length) {
            $(".instagram-slider").owlCarousel({
                autoplay: false,
                smartSpeed: 300,
                margin: 20,
                loop: true,
                autoplayHoverPause: true,
                dots: false,
                nav: true,
                center: true,
                navText: ['<i class="fi flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow-2"></i>'],
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                    },

                    500: {
                        items: 1,
                        nav: false,
                    },

                    600: {
                        items: 2,
                        nav: false,
                    },

                    768: {
                        items: 2,
                    },

                    991: {
                        items: 2,
                    },
                    1200: {
                        items: 3,
                    },

                    1400: {
                        items: 4
                    },

                }
            });
        }


    }; // end


    var gallery_slider = function(){

         /*------------------------------------------
            = FUNCTION FORM SORTING GALLERY
        -------------------------------------------*/
        function sortingGallery() {
            if ($(".sortable-gallery .gallery-filters").length) {
                var $container = $('.gallery-container');
                $container.isotope({
                    filter:'*',
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false,
                    }
                });

                $(".gallery-filters li a").on("click", function() {
                    $('.gallery-filters li .current').removeClass('current');
                    $(this).addClass('current');
                    var selector = $(this).attr('data-filter');
                    $container.isotope({
                        filter:selector,
                        animationOptions: {
                            duration: 750,
                            easing: 'linear',
                            queue: false,
                        }
                    });
                    return false;
                });
            }
        }

        sortingGallery();

    }; // end



  	//about_circlechart
  	elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_feature.default', function($scope, $){
  		feature_active();
  	} );

    //Hero Client Slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_hero.default', function($scope, $){
        hero_client_slider();
    } );

    //Slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_slider.default', function($scope, $){
      swiper_slide();
    } );

    //sliderBgSetting
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_slider.default', function($scope, $){
        sliderBgSetting();
    } );


    //service_slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_service.default', function($scope, $){
        service_slider();
    } );

    //campaign_slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_causes.default', function($scope, $){
        campaign_slider();
    } );

    //portfolio_slider2
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_project.default', function($scope, $){
        portfolio_slider2();
    } );


    //team_slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_team.default', function($scope, $){
        team_slider();
    } );


    //testimonial
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_testimonial.default', function($scope, $){
        testimonials_slider();
    } );

    //odometer
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_funfact.default', function($scope, $){
        odometer();
    } );

    //wpo-dotus_feature
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_feature.default', function($scope, $){
        odometer();
    } );

    //partners_slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_client.default', function($scope, $){
        partners_slider();
    } );

    //instagram_slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_gallery.default', function($scope, $){
        instagram_slider();
    } );

    //gallery_slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-dotus_gallery.default', function($scope, $){
        gallery_slider();
    } );

} );


})(jQuery);  