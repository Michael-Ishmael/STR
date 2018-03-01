import {HexagonLayout} from "./hexagon";


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

var layout = new HexagonLayout(hexData, 180, 140);


$(document).ready(function () {
        layout.layoutHexagons("#hexLayout1");

        $(window).resize(
            function () {
                layout.layoutHexagons("#hexLayout1");
            }
        );

        $('.about-us-image-tile').hover(e => {
            let t = e.currentTarget;
            let cn = t.className + ' over';
            if(t){
                TweenLite.to(t, 2, {css: {opacity: .5}}); //, ease: Power3.easeInOut})

            }
        }
/*        , e => {
            let t = e.currentTarget;
            let cn = t.className.replace(' over', '');
            if(t){
                var tw = TweenLite.to(t, 10, {x: 200}); //, ease: Power3.easeInOut})
                tw.play()
            }


        }*/
        );
    }


);


