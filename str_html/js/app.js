var __extends = (this && this.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
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
System.register("rollover", ["jquery"], function (exports_2, context_2) {
    "use strict";
    var __moduleName = context_2 && context_2.id;
    var jquery_2, RolloverManager, StrElementTween, RolloverTweenBase, CssPropertyTween, MovePercentageOfParent;
    return {
        setters: [
            function (jquery_2_1) {
                jquery_2 = jquery_2_1;
            }
        ],
        execute: function () {
            RolloverManager = /** @class */ (function () {
                function RolloverManager(triggerElement, duration, ease) {
                    this.triggerElement = triggerElement;
                    this.duration = duration;
                    this.ease = ease;
                    this.tweens = [];
                }
                RolloverManager.prototype.registerTweens = function (tweens) {
                    if (!this.jTriggerEl)
                        return;
                    this.tweens = this.tweens.concat(tweens);
                };
                RolloverManager.prototype.init = function () {
                    var _this = this;
                    if (this.triggerElement) {
                        this.jTriggerEl = jquery_2.default(this.triggerElement);
                        if (this.jTriggerEl.length) {
                            this.jTriggerEl.hover(function (e) { return _this.over(e.currentTarget); }, function (e) { return _this.out(e.currentTarget); });
                        }
                    }
                };
                RolloverManager.prototype.over = function (currentTarget) {
                    if (!this.tweens)
                        return;
                    for (var _i = 0, _a = this.tweens; _i < _a.length; _i++) {
                        var tween = _a[_i];
                        tween.over(currentTarget, this.duration, this.ease);
                    }
                };
                RolloverManager.prototype.out = function (currentTarget) {
                    if (!this.tweens)
                        return;
                    for (var _i = 0, _a = this.tweens; _i < _a.length; _i++) {
                        var tween = _a[_i];
                        tween.out(currentTarget);
                    }
                };
                return RolloverManager;
            }());
            exports_2("RolloverManager", RolloverManager);
            StrElementTween = /** @class */ (function () {
                function StrElementTween(element) {
                    this.element = element;
                    this.tween = null;
                    this.jElement = null;
                }
                return StrElementTween;
            }());
            RolloverTweenBase = /** @class */ (function () {
                function RolloverTweenBase(selector) {
                    this.selector = selector;
                    this.tweens = [];
                }
                RolloverTweenBase.prototype.out = function (currentTarget) {
                    if (!this.tweens)
                        return;
                    var matches = this.getTweensForElement(currentTarget);
                    matches.forEach(function (t) { return t.tween.reverse(); });
                    this.removeTweensForElement(currentTarget);
                };
                RolloverTweenBase.prototype.over = function (currentTarget, duration, ease) {
                    if (this.tweenForElementRunning(currentTarget))
                        return;
                    var strTween = new StrElementTween(currentTarget);
                    strTween.jElement = jquery_2.default(currentTarget).find(this.selector);
                    if (!(strTween.jElement && strTween.jElement.length > 0))
                        return;
                    this.overImpl(strTween, duration, ease);
                    this.tweens.push(strTween);
                };
                RolloverTweenBase.prototype.tweenForElementRunning = function (currentTarget) {
                    return this.tweens.some(function (t) {
                        return t.element === currentTarget;
                    });
                };
                RolloverTweenBase.prototype.getTweensForElement = function (currentTarget) {
                    return this.tweens.filter(function (t) {
                        return t.element === currentTarget;
                    });
                };
                RolloverTweenBase.prototype.removeTweensForElement = function (currentTarget) {
                    this.tweens = this.tweens.filter(function (t) { return t.element !== currentTarget; });
                };
                return RolloverTweenBase;
            }());
            CssPropertyTween = /** @class */ (function (_super) {
                __extends(CssPropertyTween, _super);
                function CssPropertyTween(selector, propertyName, toValue) {
                    var _this = _super.call(this, selector) || this;
                    _this.selector = selector;
                    _this.propertyName = propertyName;
                    _this.toValue = toValue;
                    return _this;
                }
                CssPropertyTween.prototype.overImpl = function (tweenContainer, duration, ease) {
                    var _this = this;
                    var cssTransformObj = {};
                    cssTransformObj[this.propertyName] = this.toValue;
                    if (this.propertyName.toLowerCase() === 'opacity' && tweenContainer.jElement) {
                        if (this.toValue == 0) {
                            tweenContainer.jElement.hide();
                        }
                        else {
                            tweenContainer.jElement.show();
                        }
                    }
                    tweenContainer.tween = TweenLite.to(tweenContainer.jElement[0], duration, {
                        css: cssTransformObj, ease: ease,
                        onReverseComplete: function () {
                            if (_this.propertyName.toLowerCase() === 'opacity' && tweenContainer.jElement)
                                if (_this.toValue == 0) {
                                    tweenContainer.jElement.show();
                                }
                                else {
                                    tweenContainer.jElement.hide();
                                }
                        }
                    });
                };
                return CssPropertyTween;
            }(RolloverTweenBase));
            exports_2("CssPropertyTween", CssPropertyTween);
            MovePercentageOfParent = /** @class */ (function (_super) {
                __extends(MovePercentageOfParent, _super);
                function MovePercentageOfParent(selector, direction, percentage) {
                    var _this = _super.call(this, selector) || this;
                    _this.selector = selector;
                    _this.direction = direction;
                    _this.percentage = percentage;
                    return _this;
                }
                MovePercentageOfParent.prototype.overImpl = function (tweenContainer, duration, ease) {
                    var parentDimension = this.direction.toLowerCase() === 'y' ? 'height' : 'width';
                    var to = tweenContainer.jElement.parent()[parentDimension]() * this.percentage;
                    to = to - (tweenContainer.jElement[parentDimension]() * this.percentage);
                    var vars = { ease: ease };
                    vars[this.direction] = to;
                    tweenContainer.tween = TweenLite.to(tweenContainer.jElement[0], duration, vars);
                };
                return MovePercentageOfParent;
            }(RolloverTweenBase));
            exports_2("MovePercentageOfParent", MovePercentageOfParent);
        }
    };
});
System.register("app", ["hexagon", "rollover"], function (exports_3, context_3) {
    "use strict";
    var __moduleName = context_3 && context_3.id;
    var hexagon_1, rollover_1, hexData, layout;
    return {
        setters: [
            function (hexagon_1_1) {
                hexagon_1 = hexagon_1_1;
            },
            function (rollover_1_1) {
                rollover_1 = rollover_1_1;
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
                function initRollovers() {
                    var auRoManager = new rollover_1.RolloverManager(".about-us-image-tile", .5, Power3.easeOut);
                    var opacityTween = new rollover_1.CssPropertyTween("img.overlay", "opacity", 1);
                    var buttonsTween = new rollover_1.CssPropertyTween(".buttons", "opacity", 1);
                    var titleTween = new rollover_1.CssPropertyTween("h6", "opacity", 0);
                    var captionTween = new rollover_1.MovePercentageOfParent('.name-caption-container', 'y', -.5);
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
            });
        }
    };
});
//# sourceMappingURL=app.js.map