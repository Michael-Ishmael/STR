System.register("hexagon", ["jquery"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var jquery_1, HexagonLayout;
    return {
        setters: [
            function (jquery_1_1) {
                jquery_1 = jquery_1_1;
            }
        ],
        execute: function () {
            HexagonLayout = /** @class */ (function () {
                function HexagonLayout(hexData, maxHexWidth, minHexWidth) {
                    this.hexData = hexData;
                    this.maxHexWidth = maxHexWidth;
                    this.minHexWidth = minHexWidth;
                    this.hexCount = 0;
                    this.hexWidth = 0;
                    this.hexHeight = 0;
                    this.rowCount = 0;
                    this.rowHeight = 0;
                    this.oddRowColCount = 0;
                    this.evenRowColCount = 0;
                    this.reqContainerHeight = 0;
                    this.hexCount = hexData.length;
                }
                HexagonLayout.prototype.recalc = function (width) {
                    if (width < 1)
                        return;
                    var minWidthColCount = width / this.minHexWidth;
                    var maxWidthColCount = width / this.maxHexWidth;
                    this.evenRowColCount = Math.ceil(maxWidthColCount) <= minWidthColCount ? Math.ceil(maxWidthColCount) : Math.floor(maxWidthColCount);
                    this.oddRowColCount = this.evenRowColCount - 1;
                    this.rowCount = Math.ceil(this.hexCount / (this.evenRowColCount - .5));
                    this.hexWidth = Math.floor(width / this.evenRowColCount);
                    this.hexHeight = HexagonLayout.getHexHeightFromWidth(this.hexWidth);
                    this.rowHeight = this.hexWidth * .75;
                    this.reqContainerHeight = this.rowHeight * (this.rowCount + 1);
                };
                HexagonLayout.prototype.layoutHexagons = function (parentContainerId) {
                    var parent = jquery_1.default(parentContainerId);
                    if (parent.length == 0)
                        return;
                    var targetWidth = parent.width();
                    if (targetWidth == 0)
                        return;
                    this.recalc(targetWidth);
                    parent.css({ position: 'relative' });
                    parent.height(this.reqContainerHeight);
                    var isOdd = true;
                    var i = 0;
                    for (var r = 0; r < this.rowCount; r++) {
                        var colCount = isOdd ? this.oddRowColCount : this.evenRowColCount;
                        for (var c = 0; c < colCount; c++) {
                            var hex = jquery_1.default(this.hexData[i]);
                            if (hex.length == 0)
                                continue;
                            var offset = isOdd ? this.hexWidth / 2 : 0;
                            var x = (c * this.hexWidth) + offset;
                            var y = (r * this.rowHeight) + (r * 20);
                            if (isOdd)
                                hex.addClass('odd');
                            //hex.find('p > span:first-child').html('Hex r:' + (r + 1).toString() + ', c:' + (c + 1).toString() );
                            //hex.width(this.hexWidth);
                            //console.log(i.toString() + ' ' + this.hexWidth);
                            //hex.height(this.hexHeight);
                            hex.css({
                                position: 'absolute',
                                top: y,
                                left: x,
                                width: this.hexWidth,
                                height: this.hexHeight
                            });
                            i++;
                            if (i >= this.hexData.length)
                                break;
                        }
                        if (i >= this.hexData.length)
                            break;
                        isOdd = !isOdd;
                    }
                };
                HexagonLayout.getHexHeightFromWidth = function (hexWidth) {
                    return Math.round((hexWidth * 2) / Math.sqrt(3));
                };
                return HexagonLayout;
            }());
            exports_1("HexagonLayout", HexagonLayout);
        }
    };
});
System.register("app", ["hexagon"], function (exports_2, context_2) {
    "use strict";
    var __moduleName = context_2 && context_2.id;
    var hexagon_1, hexData, layout;
    return {
        setters: [
            function (hexagon_1_1) {
                hexagon_1 = hexagon_1_1;
            }
        ],
        execute: function () {
            hexData = [
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
            layout = new hexagon_1.HexagonLayout(hexData, 180, 140);
            $(document).ready(function () {
                layout.layoutHexagons("#hexLayout1");
                $(window).resize(function () {
                    layout.layoutHexagons("#hexLayout1");
                });
                $('.about-us-image-tile').hover(function (e) {
                    var t = e.currentTarget;
                    var cn = t.className + ' over';
                    if (t) {
                        TweenLite.to(t, 2, { css: { opacity: .5 } }); //, ease: Power3.easeInOut})
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
            });
        }
    };
});
//# sourceMappingURL=app.js.map