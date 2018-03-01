import {HexagonLayout} from "./hexagon";
import {CssPropertyTween, MovePercentageOfParent, RolloverManager} from "./rollover";


let hexData:string[] = [
    "#hexTile_1",
    "#hexTile_2",
    "#hexTile_3",
    "#hexTile_4",
    "#hexTile_5",
    "#hexTile_6",
    "#hexTile_7",
    "#hexTile_8",
    "#hexTile_9",
    "#hexTile_10",
    "#hexTile_11",
    "#hexTile_12",
    "#hexTile_13"
];

let layout = new HexagonLayout(hexData, 180, 140);

$(document).ready(function () {
        layout.layoutHexagons("#hexLayout1");

        $(window).resize(
            function () {
                layout.layoutHexagons("#hexLayout1");
            }
        );

        function initRollovers(){
            let auRoManager:RolloverManager = new RolloverManager(".about-us-image-tile", .5, Power3.easeOut);
            let opacityTween = new CssPropertyTween("img.overlay", "opacity", 1);
            let buttonsTween = new CssPropertyTween(".buttons", "opacity", 1);
            let titleTween = new CssPropertyTween("h6", "opacity", 0);
            let captionTween = new MovePercentageOfParent('.name-caption-container', 'y', -.5);
            auRoManager.init();
            auRoManager.registerTweens([opacityTween, captionTween, titleTween, buttonsTween]);
        }


/*           $('.about-us-image-tile').hover(e => {
            let t = e.currentTarget;
            let cn = t.className + ' over';


            //

            if(t){
                let overlay = $(t).find('img.overlay');
                if(overlay.length){
                    overlay.show();
                    //TweenLite.to("#testDiv", 5, {css: {className: 'blur'}}); //, ease: Power3
                    TweenLite.to(overlay[0], .5, {css: {opacity: 1}, ease: Power3.easeOut}); //, })
                }
                let nameCaption = $(t).find('.name-caption-container ')
                if(nameCaption.length) {
                    let yTo = nameCaption.parent().height() / 2 * -1;
                    TweenLite.to(nameCaption[0], .5, {y: yTo, ease: Power3.easeOut});
                }

            }
        }
                , e => {
            let t = e.currentTarget;
            let cn = t.className.replace(' over', '');
            if(t){
               // TweenLite.to(t, 2, {css: {className: '-=over'}});
/!*                var tw = TweenLite.to(t, 10, {x: 200}); //, ease: Power3.easeInOut})
                tw.play()*!/
            }
            });*/
    }
);


