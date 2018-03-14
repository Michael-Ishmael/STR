import {HexagonLayout} from "./hexagon";
import {CssPropertyTween, MovePercentageOfParent, RolloverManager} from "./rollover";
import {OverlayManager} from "./overlay";


$(function () {
        let layout = new HexagonLayout("#hexLayout1", ".str-hex-tile", 220, 40);

        layout.layoutHexagons();

        $(window).resize(
            function () {
                layout.layoutHexagons();
            }
        );

        $('#mobile-menu-button').click( function(e){

            $('#mobile-menu').fadeIn();
            setTimeout(function(){
                $('#mobile-menu-close-button').toggleClass("is-active");
            }, 50);

        });

        $('#mobile-menu-close-button').click( function(e){


            $('#mobile-menu-close-button').toggleClass("is-active");
            setTimeout(function(){
                $('#mobile-menu').fadeOut();
            }, 250);

        //$(this).toggleClass("is-active");
        });

        function initRollovers() {
            let auRoManager: RolloverManager = new RolloverManager(".about-us-image-tile", .5, Power3.easeOut);
            let opacityTween = new CssPropertyTween("img.overlay", "opacity", 1);
            let buttonsTween = new CssPropertyTween(".buttons", "opacity", .6);
            let titleTween = new CssPropertyTween("h6.title", "opacity", 0);
            let aboutTween = new CssPropertyTween(".lower .btn", "opacity", 1);
            let captionTween = new MovePercentageOfParent('.name-caption-container', 'y', -.5);

            auRoManager.init();
            auRoManager.registerTweens([opacityTween, captionTween, titleTween, aboutTween,
                buttonsTween]);


            let auRoManager2: RolloverManager = new RolloverManager(".success-image-tile", .7, Quint.easeInOut);
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

        OverlayManager.init('#overlayBg', null, '.overlay-link');
/*
    $('.carousel').each(function () {
        let $carousel = $(this);
        let hammertime = new Hammer(this, {
            recognizers: [
                [Hammer.Swipe, { direction: Hammer.DIRECTION_HORIZONTAL }]
            ]
        });
        hammertime.on('swipeleft', function () {
            $carousel.carousel('next');
        });
        hammertime.on('swiperight', function () {
            $carousel.carousel('prev');
        });
    });*/

        $('.carousel').bcSwipe({ threshold: 50});

    }
);


