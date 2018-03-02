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

$(function () {
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
            let titleTween = new CssPropertyTween("h6.title", "opacity", 0);
            let aboutTween = new CssPropertyTween(".lower .btn", "opacity", 1);
            let captionTween = new MovePercentageOfParent('.name-caption-container', 'y', -.5);

            auRoManager.init();
            auRoManager.registerTweens([opacityTween, captionTween, titleTween, aboutTween,
                buttonsTween]);


            let auRoManager2:RolloverManager = new RolloverManager(".success-image-tile", .7, Back.easeInOut);
            let photoCaptionTween = new CssPropertyTween('.photo-caption', 'bottom', '+=2rem');
            let readMoreTween = new CssPropertyTween(".photo-caption h6", "opacity", 1);
            auRoManager2.init();
            auRoManager2.registerTweens([photoCaptionTween, readMoreTween]);

        }
        initRollovers();

    }
);


