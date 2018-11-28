import {HexagonLayout} from "./hexagon";
import {CssPropertyTween, MovePercentageOfParent, RolloverManager} from "./rollover";
import {OverlayManager} from "./overlay";
import Navigo from "navigo";

let navFunction:Function = null;
let router:Navigo;

/*
* Roll out
*
* Add navigo
* Update system js
*
*
* PHP
*
* Add new functions to plug-in
*
*
* */


(function(){

    //router = new Navigo("https://strategytorevenue.com");
    router = new Navigo("http://localhost:8888");
    router.on('/:area', (params, query) => {

        if(navFunction){
            navFunction(params, query);
        } else {
            let intP = null;
            intP = setInterval(function(){
                if(navFunction){
                    if(intP) clearInterval(intP);
                    navFunction(params, query);
                }
            }, 100);
        }


    }).on('/:area/:storyId', (params, query) => {

        if(navFunction){
            navFunction(params, query);
        } else {
            let intP = null;
            intP = setInterval(function(){
                if(navFunction){
                    if(intP) clearInterval(intP);
                    navFunction(params, query);
                }
            }, 100);
        }


    }).resolve();

})();


jQuery(function ($) {




        let layout = new HexagonLayout("#hexLayout1", ".str-hex-tile", 220, 40);
        let _jBody = $('body');
        let _window = $(window);
        let NO_SCROLL_CLASS = "noscroll";
        let auRoManager: RolloverManager = null;
        let auRoManager2: RolloverManager = null;
        layout.layoutHexagons();

        _window.resize(
            function () {
                layout.layoutHexagons();
                let width = _window.width();
                if(width < 768){
                    if(auRoManager2){
                        auRoManager2.clear();
                    }
                } else {
                }
            }
        );

    $(window).on("load", function() {

        const remSizeRegex = /-\d+[Xx]\d+\./;

        $('.img-pre-load-class').each(function (i) {

            let jImg = $(this);
            let dStyle = window.getComputedStyle(this);
            let bgImage = dStyle.backgroundImage;
            if(bgImage){
                let rexMatches  = bgImage.match(/url\((.*?)\)/);
                if(!rexMatches || rexMatches.length < 2) return;
                let imageUrl  =rexMatches[1].replace(/('|")/g,'');
                let srcReplace =  imageUrl.replace(remSizeRegex, ".");
                let newBgStyle = null;
                if(bgImage.indexOf('"' + imageUrl + '"') > -1)
                    newBgStyle = bgImage.replace('"' + imageUrl + '"',  srcReplace );
                else if(bgImage.indexOf('\'' + imageUrl + '\'') > -1)
                    newBgStyle = bgImage.replace('\'' + imageUrl + '\'', srcReplace );
                else
                    newBgStyle = bgImage.replace( imageUrl ,  srcReplace);

                if(newBgStyle){
                    let imgLarge = new Image();
                    imgLarge.src = srcReplace;
                    imgLarge.onload = function () {
                        //jImg.css('backgroundImage', newBgStyle);
                        jImg.addClass('complete')
                    };
                }

            }

        });


        $('.img-pre-load').each(function(i){

            let jImg = $(this);
            let src =jImg.attr('src');
            if(!src) return;
            let srcReplace =  src.replace(remSizeRegex, ".");

            let imgLarge = new Image();
            imgLarge.src = srcReplace;
            imgLarge.onload = function () {
                jImg.attr('src', srcReplace);
                jImg.addClass('complete')
            };



        });

        function setupNewsletterFlip() {


            let frontCard = $(".flipee.front"),
                backCard = $(".flipee.back"),
                tl = new TimelineMax({paused:true});

            TweenLite.set(backCard, {rotationY:-180});
            backCard.removeClass('d-none');

            tl
                .to(frontCard, .7, {rotationY:180})
                .to(backCard, .7, {rotationY:0},0)
            //.to(element, .5, {z:50},0)
            //.to(element, .5, {z:0},.5);

            $("#newsletter-trigger").click(function(){

                tl.play();

            });

/*            $('#nl-rev-trigger').click(function () {
                tl.reverse();
            })*/

        }

        //setupNewsletterFlip();

    });




        $('img').each(function(i){

            let src = $(this).attr('src');
            if(src){
                $("<img />").attr("src", src);
            }

        });

        function setNoScroll(on:boolean){

            if(on){
                if(!_jBody.hasClass(NO_SCROLL_CLASS)){
                    _jBody.addClass(NO_SCROLL_CLASS)
                }
            } else {
                _jBody.removeClass(NO_SCROLL_CLASS);
            }
        }

        $('#mobile-menu-button').click( function(e){

            $('#mobile-menu').fadeIn();
            setTimeout(function(){
                $('#mobile-menu-close-button').toggleClass("is-active");
                setNoScroll(true);
            }, 50);

        });

        $('#mobile-menu-close-button').click( function(e){


            $('#mobile-menu-close-button').toggleClass("is-active");
            setNoScroll(false);
            setTimeout(function(){
                $('#mobile-menu').fadeOut();
            }, 250);

        //$(this).toggleClass("is-active");
        });

        function initRollovers() {
            auRoManager = new RolloverManager(".about-us-image-tile", .5, Power3.easeOut);
            let opacityTween = new CssPropertyTween("img.overlay", "opacity", 1);
            let buttonsTween = new CssPropertyTween(".buttons", "opacity", .6);
            let titleTween = new CssPropertyTween("h6.title", "opacity", 0);
            let aboutTween = new CssPropertyTween(".lower .btn", "opacity", 1);
            let captionTween = new MovePercentageOfParent('.name-caption-container', 'y', -.5);

            auRoManager.init();
            auRoManager.registerTweens([opacityTween, captionTween, titleTween, aboutTween,
                buttonsTween]);

            if(_window && _window.width() > 768){
                initSuccesRollover()
            }
        }



        function initSuccesRollover(){

            if(auRoManager2){
                auRoManager2.init();
                return;
            }
            auRoManager2 = new RolloverManager(".success-image-tile", .7, Quint.easeInOut);
            let photoCaptionTween = new CssPropertyTween('.photo-caption', 'bottom', '+=2rem');
            let readMoreTween = new CssPropertyTween(".photo-caption h5", "opacity", 1);
            auRoManager2.init();
            auRoManager2.registerTweens([photoCaptionTween, readMoreTween]);
        }

        initRollovers();

        $('.box-link').click(function (e) {
           e.preventDefault();
           let a = $(this).find('a');
           if(a.length){
               let href=a.attr('href');
               if(href){
                   window.location.href = href;
               }
           }
        });

        OverlayManager.init('#overlayBg', null, '.overlay-link', router);

        navFunction = function(params, query){

                        if(params && OverlayManager){
                            if(params.area && params.storyId ){
                                OverlayManager.setLoadedOverlay(params.area, params.storyId, false, null);
                            } else if(params.area){
                                OverlayManager.setCurrentArea(params.area);
                            }
                        }

                        navFunction = function(params, query){
                            if(params && OverlayManager){
                                if(params.area && params.storyId ){
                                    let sticky = false, overlayClasses = null;
                                    if(query){
                                        const parsedQuery = JSON.parse('{"' + decodeURI(query).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}')
                                        sticky =  parsedQuery.s === "1";
                                        overlayClasses =  parsedQuery.hf === "1" ? "hide-footers"  : null;
                                    }
                                    OverlayManager.showOverlay( params.storyId, sticky, overlayClasses);
                                } else if(params.area){
                                    OverlayManager.setCurrentArea(params.area);
                                    OverlayManager.removeLastScreen();
                                }
                            }

                        };

                    };



        $('.carousel').bcSwipe({ threshold: 50});


        //Sticky nav

        function setupStickyNav(){

            const stickyNavBarId = "#sticky-nav";

            // Hide Header on on scroll down
            let didScroll;
            let lastScrollTop = 0;
            let delta = 5;
            let navbarHeight = $(stickyNavBarId).outerHeight();


            $(window).scroll(function(event){
                didScroll = true;
            });

            setInterval(function() {
                if (didScroll) {
                    hasScrolled();
                    didScroll = false;
                }
            }, 250);

            function hasScrolled() {
                let st = $(window).scrollTop();

                if(st < 160){
                    st=0;
                }



                if(st == 0){
                    lastScrollTop = st;
                    $(stickyNavBarId).removeClass('nav-down').addClass('nav-up');
                    return;
                }

                // Make sure they scroll more than delta
                if(Math.abs(lastScrollTop - st) <= delta)
                    return;

                // If they scrolled down and are past the navbar, add class .nav-up.
                // This is necessary so you never see what is "behind" the navbar.
                if (st > lastScrollTop && st > navbarHeight){

                    // Scroll Down
                    if(!$(stickyNavBarId).hasClass('nav-up'))
                        $(stickyNavBarId).removeClass('nav-down').addClass('nav-up');
                } else {
                    // Scroll Up
                    if(st + $(window).height() < $(document).height()) {
                        $(stickyNavBarId).removeClass('nav-up').addClass('nav-down');
                    }
                }

                lastScrollTop = st;
            }

        }


        setupStickyNav();

    }
);


