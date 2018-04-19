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
System.register("hexagon", [], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var $, HexagonLayout;
    return {
        setters: [],
        execute: function () {
            $ = jQuery;
            HexagonLayout = /** @class */ (function () {
                function HexagonLayout(parentContainerId, hexClass, maxHexWidth, minHexWidth) {
                    this.parentContainerId = parentContainerId;
                    this.hexClass = hexClass;
                    this.maxHexWidth = maxHexWidth;
                    this.minHexWidth = minHexWidth;
                    this.hexData = [];
                    this.hexCount = 0;
                    this.hexWidth = 0;
                    this.hexHeight = 0;
                    this.rowCount = 0;
                    this.rowHeight = 0;
                    this.oddRowColCount = 0;
                    this.evenRowColCount = 0;
                    this.reqContainerHeight = 0;
                    var hexes = $(parentContainerId).children(hexClass);
                    this.hexData = hexes.toArray().map(function (t) { return '#' + t.id; });
                    this.hexCount = this.hexData.length;
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
                HexagonLayout.prototype.layoutHexagons = function () {
                    var parent = $(this.parentContainerId);
                    if (parent.length == 0)
                        return;
                    parent.css('visibility', "hidden");
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
                            var hex = $(this.hexData[i]);
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
                    parent.css('visibility', "visible");
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
System.register("rollover", [], function (exports_2, context_2) {
    "use strict";
    var __moduleName = context_2 && context_2.id;
    var $, RolloverManager, StrElementTween, RolloverTweenBase, CssPropertyTween, MovePercentageOfParent;
    return {
        setters: [],
        execute: function () {
            $ = jQuery;
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
                        this.jTriggerEl = $(this.triggerElement);
                        if (this.jTriggerEl.length) {
                            this.jTriggerEl.hover(function (e) { return _this.over(e.currentTarget); }, function (e) { return _this.out(e.currentTarget); });
                        }
                    }
                };
                RolloverManager.prototype.clear = function () {
                    if (this.triggerElement) {
                        this.jTriggerEl = $(this.triggerElement);
                        if (this.jTriggerEl.length) {
                            this.jTriggerEl.off('hover');
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
                    strTween.jElement = $(currentTarget).find(this.selector);
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
                            tweenContainer.jElement.css('visibility', 'hidden');
                        }
                        else {
                            tweenContainer.jElement.css('visibility', 'visible');
                        }
                    }
                    tweenContainer.tween = TweenLite.to(tweenContainer.jElement[0], duration, {
                        css: cssTransformObj, ease: ease,
                        onReverseComplete: function () {
                            if (_this.propertyName.toLowerCase() === 'opacity' && tweenContainer.jElement) {
                                if (_this.toValue == 0) {
                                    tweenContainer.jElement.css('visibility', 'visible');
                                }
                                else {
                                    tweenContainer.jElement.css('visibility', 'hidden');
                                }
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
System.register("overlay", [], function (exports_3, context_3) {
    "use strict";
    var __moduleName = context_3 && context_3.id;
    var $, OverlayManager, Overlay;
    return {
        setters: [],
        execute: function () {
            $ = jQuery;
            OverlayManager = /** @class */ (function () {
                function OverlayManager() {
                    //this.tweens = [];
                }
                OverlayManager.init = function (overlayBgSelector, overlayClassName, overlayTriggersSelector) {
                    this._screenStack = [];
                    this._jBody = $('body');
                    this._jBackGround = $(overlayBgSelector);
                    var triggers = this.initTriggers(overlayTriggersSelector);
                    this.initEscapeKey();
                    this._initialized = (this._jBody && this.isValidJElement(this._jBackGround) && triggers);
                    //  Store bg element
                    //  SetUp
                };
                Object.defineProperty(OverlayManager, "BgVisible", {
                    get: function () {
                        return this._bgVisible;
                    },
                    enumerable: true,
                    configurable: true
                });
                OverlayManager.initEscapeKey = function () {
                    var _this = this;
                    if (!this._jBody)
                        return;
                    this._jBody.keyup(function (e) {
                        if (e.keyCode === 27)
                            _this.hide();
                    });
                };
                OverlayManager.initTriggers = function (overlayTriggersSelector) {
                    var _this = this;
                    var jTriggers = $(overlayTriggersSelector);
                    if (!this.isValidJElement(jTriggers))
                        return false;
                    jTriggers.click(function (e) {
                        e.preventDefault();
                        var jTrigger = $(e.currentTarget);
                        var link = _this.getOverlayLinkFromTrigger(jTrigger);
                        var overlayId = _this.getOverlayIdFromTrigger(jTrigger);
                        var overlayIsSticky = _this.getOverlayIdIsStickyFromTrigger(jTrigger);
                        var overlayClasses = _this.getOverlayAddedClasses(jTrigger);
                        if (link)
                            window.location.hash = link;
                        if (overlayId)
                            _this.showOverlay(overlayId, overlayIsSticky, overlayClasses);
                    });
                    return true;
                };
                OverlayManager.showOverlay = function (overlayId, overlayIsSticky, overlayClasses) {
                    if (!this._initialized)
                        return;
                    var nextOverlayElement = $('#' + overlayId);
                    if (!this.isValidJElement(nextOverlayElement))
                        return;
                    this.initTimeline();
                    if (!this.BgVisible) {
                        this.setNoScroll(true);
                        this.setBackgroundVisibility(true);
                    }
                    var stackSize = this._screenStack.length + 1;
                    var newItem = new Overlay(nextOverlayElement, stackSize, this.duration, overlayIsSticky, overlayClasses);
                    this._screenStack.push(newItem);
                    newItem.show();
                    this._timeline.play();
                };
                OverlayManager.overlayRemoved = function (overlay) {
                    var partingOverlay = this._screenStack.pop();
                    partingOverlay.kill();
                    if (this._screenStack.length === 0) {
                        this.hide();
                    }
                };
                OverlayManager.overlayDone = function (overlay) {
                    this.arrangeLayers();
                };
                OverlayManager.keepExisting = function () {
                    //TODO: Make more generic
                    if (this._currentOverlay && this._currentOverlay.attr("id").indexOf("overlay-about") > -1) {
                        if (this._nextOverlay && this._nextOverlay.attr("id").indexOf("overlay-expertise") > -1) {
                            return true;
                        }
                    }
                    return false;
                };
                OverlayManager.registerCloseButton = function (closeButton) {
                    var _this = this;
                    closeButton.click(function (e) {
                        e.preventDefault();
                        _this.hide();
                    });
                };
                OverlayManager.arrangeLayers = function () {
                    if (!this._screenStack)
                        return;
                    var stackSize = this._screenStack.length;
                    if (stackSize <= 1)
                        return;
                    var last = this._screenStack[stackSize - 1];
                    if (last.isSticky)
                        return;
                    var first = this._screenStack.shift();
                    first.hide(true);
                };
                OverlayManager.initTimeline = function (useSecond) {
                    var _this = this;
                    if (useSecond === void 0) { useSecond = false; }
                    if (useSecond) {
                        if (this._timeline2) {
                            this._timeline2.kill();
                        }
                        this._timeline2 = new TimelineLite({
                            //onComplete: () =>{ this.arrangeLayers() } ,
                            onReverseComplete: function () { _this.cleanUpHide(); }
                        });
                    }
                    if (this._timeline) {
                        this._timeline.kill();
                    }
                    this._timeline = new TimelineLite({
                        // onComplete: () =>{ this.arrangeLayers() } ,
                        onReverseComplete: function () { _this.cleanUpHide(); }
                    });
                };
                OverlayManager.isValidJElement = function (jElement) {
                    return jElement && jElement.length > 0;
                };
                OverlayManager.hide = function () {
                    if (!this._initialized)
                        return;
                    this.setBackgroundVisibility(false, true);
                    this.setNoScroll(false);
                    return;
                };
                OverlayManager.cleanUpHide = function () {
                    /*        if(this._previousOverlay) {
                                this._previousOverlay.removeClass("second-level");
                                this._previousOverlay.hide();
                                this._previousOverlay.css('z-index', null);
                                this._previousOverlay = null;
                            }
                            if(this._currentOverlay) {
                                this._currentOverlay.removeClass("second-level");
                                this._currentOverlay.hide();
                                this._currentOverlay = null;
                            }
                            if(this._nextOverlay) {
                                this._nextOverlay.removeClass("second-level");
                                this._nextOverlay.hide();
                                this._nextOverlay = null;
                            }*/
                    this.setBackgroundVisibility(false, true);
                    this.setNoScroll(false);
                };
                OverlayManager.setBackgroundVisibility = function (on, immediate) {
                    if (immediate === void 0) { immediate = false; }
                    var zProp = on ? '10' : '-1';
                    var oProp = on ? 1 : 0;
                    var aHiddenProp = on ? 'false' : 'true';
                    this._jBackGround.css('z-index', zProp);
                    /*this._timeline .fromTo(this._jBackGround[0], this.duration,
                        {backgroundColor : 'rgba(40, 40, 40, 0.01)'},
                        {backgroundColor : 'rgba(40, 40, 40, 0.75)'}, 0);*/
                    if (immediate) {
                        this._jBackGround.css('opacity', oProp);
                    }
                    else {
                        this._timeline.to(this._jBackGround[0], this.duration, { autoAlpha: oProp }, 0);
                    }
                    this._bgVisible = on;
                    this._jBackGround.attr('aria-hidden', aHiddenProp);
                };
                OverlayManager.setNoScroll = function (on) {
                    if (on) {
                        if (!this._jBody.hasClass(this.NO_SCROLL_CLASS)) {
                            this._jBody.addClass(this.NO_SCROLL_CLASS);
                        }
                    }
                    else {
                        this._jBody.removeClass(this.NO_SCROLL_CLASS);
                    }
                };
                OverlayManager.getOverlayIdFromTrigger = function (jTrigger) {
                    if (!(jTrigger && jTrigger.length > 0))
                        return null;
                    var overlayId = jTrigger.data('overlay');
                    return overlayId;
                };
                OverlayManager.getOverlayIdIsStickyFromTrigger = function (jTrigger) {
                    if (!(jTrigger && jTrigger.length > 0))
                        return false;
                    var overlaySticky = jTrigger.data('overlay-sticky');
                    return this.testForBoolean(overlaySticky);
                };
                OverlayManager.getOverlayAddedClasses = function (jTrigger) {
                    if (!(jTrigger && jTrigger.length > 0))
                        return "";
                    var overlayClasses = jTrigger.data('overlay-classes');
                    return overlayClasses;
                };
                OverlayManager.testForBoolean = function (testValue) {
                    if (testValue === undefined || testValue == null)
                        return false;
                    if (testValue === true)
                        return true;
                    if (testValue === false)
                        return false;
                    var string = testValue.toString();
                    switch (string.toLowerCase().trim()) {
                        case "true":
                        case "yes":
                        case "1": return true;
                        case "false":
                        case "no":
                        case "0":
                        case null: return false;
                        default: return Boolean(string);
                    }
                };
                OverlayManager.getOverlayLinkFromTrigger = function (jTrigger) {
                    if (!(jTrigger && jTrigger.length > 0))
                        return null;
                    if (jTrigger[0].localName === 'a') {
                        return jTrigger.attr('href');
                    }
                    else {
                        var jLink = jTrigger.find('a');
                        if (jLink.length > 0) {
                            return jLink.attr('href');
                        }
                        else {
                            return null;
                        }
                    }
                };
                OverlayManager.NO_SCROLL_CLASS = "noscroll";
                OverlayManager.Z_INDEX_0 = "-2";
                OverlayManager.Z_INDEX_1 = "1";
                OverlayManager.Z_INDEX_2 = "2";
                OverlayManager.duration = .5;
                return OverlayManager;
            }());
            exports_3("OverlayManager", OverlayManager);
            Overlay = /** @class */ (function () {
                function Overlay(screen, zIndex, duration, isSticky, overlayClasses) {
                    if (isSticky === void 0) { isSticky = false; }
                    if (overlayClasses === void 0) { overlayClasses = ""; }
                    this.screen = screen;
                    this.zIndex = zIndex;
                    this.duration = duration;
                    this.isSticky = isSticky;
                    this.overlayClasses = overlayClasses;
                    this._timeline = null;
                    this._closeButton = null;
                }
                Overlay.prototype.show = function () {
                    var _this = this;
                    this.registerCloseButton();
                    this.screen.css("zIndex", this.zIndex.toString());
                    this.screen.addClass(this.overlayClasses);
                    this.screen.show();
                    this._timeline = new TimelineLite({
                        onComplete: function () { _this.tweenDone(); },
                        onReverseComplete: function () { _this.cleanUpHide(); }
                    });
                    var oBody = this.screen.find('.overlay-content');
                    var oImg = this.screen.find('.overlay-image-container');
                    var width = oBody.width() + 10;
                    this._timeline.set(oBody[0], { x: width }, 0);
                    this._timeline.set(oImg[0], { autoAlpha: 0 }, 0);
                    this._timeline.addLabel("doors", 0);
                    this._timeline.to(oBody[0], this.duration, { x: 0 }, "doors");
                    this._timeline.to(oImg[0], this.duration, { autoAlpha: 1, ease: Linear.easeNone }, this.duration / 2);
                };
                Overlay.prototype.registerCloseButton = function () {
                    var _this = this;
                    var closeButton = this.screen.find('.close-button');
                    if (!OverlayManager.isValidJElement(closeButton))
                        return;
                    this._closeButton = closeButton;
                    this._closeButton.click(function (e) {
                        e.preventDefault();
                        _this.hide();
                    });
                };
                Overlay.prototype.hide = function (immediate) {
                    if (immediate === void 0) { immediate = false; }
                    if (immediate) {
                        this.screen.hide();
                        this.screen.removeClass(this.overlayClasses);
                        this._timeline.seek(0);
                        return;
                    }
                    if (!this._timeline)
                        return;
                    if (this._timeline.isActive()) {
                        this._timeline.kill();
                    }
                    this._timeline.reverse();
                };
                Overlay.prototype.tweenDone = function () {
                    OverlayManager.overlayDone(this);
                };
                Overlay.prototype.cleanUpHide = function () {
                    this.screen.hide();
                    this.screen.removeClass(this.overlayClasses);
                    OverlayManager.overlayRemoved(this);
                };
                Overlay.prototype.kill = function () {
                    this._timeline.kill();
                    if (this._closeButton) {
                        this._closeButton.off("click");
                    }
                    this.screen = null;
                };
                return Overlay;
            }());
        }
    };
});
System.register("app", ["hexagon", "rollover", "overlay"], function (exports_4, context_4) {
    "use strict";
    var __moduleName = context_4 && context_4.id;
    var hexagon_1, rollover_1, overlay_1;
    return {
        setters: [
            function (hexagon_1_1) {
                hexagon_1 = hexagon_1_1;
            },
            function (rollover_1_1) {
                rollover_1 = rollover_1_1;
            },
            function (overlay_1_1) {
                overlay_1 = overlay_1_1;
            }
        ],
        execute: function () {
            jQuery(function ($) {
                var layout = new hexagon_1.HexagonLayout("#hexLayout1", ".str-hex-tile", 220, 40);
                var _jBody = $('body');
                var _window = $(window);
                var NO_SCROLL_CLASS = "noscroll";
                var auRoManager = null;
                var auRoManager2 = null;
                layout.layoutHexagons();
                _window.resize(function () {
                    layout.layoutHexagons();
                    var width = _window.width();
                    if (width < 768) {
                        if (auRoManager2) {
                            auRoManager2.clear();
                        }
                    }
                    else {
                    }
                });
                $(window).on("load", function () {
                    var remSizeRegex = /-\d+[Xx]\d+\./;
                    $('.img-pre-load-class').each(function (i) {
                        var jImg = $(this);
                        var dStyle = window.getComputedStyle(this);
                        var bgImage = dStyle.backgroundImage;
                        if (bgImage) {
                            var rexMatches = bgImage.match(/url\((.*?)\)/);
                            if (!rexMatches || rexMatches.length < 2)
                                return;
                            var imageUrl = rexMatches[1].replace(/('|")/g, '');
                            var srcReplace = imageUrl.replace(remSizeRegex, ".");
                            var newBgStyle = null;
                            if (bgImage.indexOf('"' + imageUrl + '"') > -1)
                                newBgStyle = bgImage.replace('"' + imageUrl + '"', srcReplace);
                            else if (bgImage.indexOf('\'' + imageUrl + '\'') > -1)
                                newBgStyle = bgImage.replace('\'' + imageUrl + '\'', srcReplace);
                            else
                                newBgStyle = bgImage.replace(imageUrl, srcReplace);
                            if (newBgStyle) {
                                var imgLarge = new Image();
                                imgLarge.src = srcReplace;
                                imgLarge.onload = function () {
                                    //jImg.css('backgroundImage', newBgStyle);
                                    jImg.addClass('complete');
                                };
                            }
                        }
                    });
                    $('.img-pre-load').each(function (i) {
                        var jImg = $(this);
                        var src = jImg.attr('src');
                        if (!src)
                            return;
                        var srcReplace = src.replace(remSizeRegex, ".");
                        var imgLarge = new Image();
                        imgLarge.src = srcReplace;
                        imgLarge.onload = function () {
                            jImg.attr('src', srcReplace);
                            jImg.addClass('complete');
                        };
                    });
                });
                $('img').each(function (i) {
                    var src = $(this).attr('src');
                    if (src) {
                        $("<img />").attr("src", src);
                    }
                });
                function setNoScroll(on) {
                    if (on) {
                        if (!_jBody.hasClass(NO_SCROLL_CLASS)) {
                            _jBody.addClass(NO_SCROLL_CLASS);
                        }
                    }
                    else {
                        _jBody.removeClass(NO_SCROLL_CLASS);
                    }
                }
                $('#mobile-menu-button').click(function (e) {
                    $('#mobile-menu').fadeIn();
                    setTimeout(function () {
                        $('#mobile-menu-close-button').toggleClass("is-active");
                        setNoScroll(true);
                    }, 50);
                });
                $('#mobile-menu-close-button').click(function (e) {
                    $('#mobile-menu-close-button').toggleClass("is-active");
                    setNoScroll(false);
                    setTimeout(function () {
                        $('#mobile-menu').fadeOut();
                    }, 250);
                    //$(this).toggleClass("is-active");
                });
                function initRollovers() {
                    auRoManager = new rollover_1.RolloverManager(".about-us-image-tile", .5, Power3.easeOut);
                    var opacityTween = new rollover_1.CssPropertyTween("img.overlay", "opacity", 1);
                    var buttonsTween = new rollover_1.CssPropertyTween(".buttons", "opacity", .6);
                    var titleTween = new rollover_1.CssPropertyTween("h6.title", "opacity", 0);
                    var aboutTween = new rollover_1.CssPropertyTween(".lower .btn", "opacity", 1);
                    var captionTween = new rollover_1.MovePercentageOfParent('.name-caption-container', 'y', -.5);
                    auRoManager.init();
                    auRoManager.registerTweens([opacityTween, captionTween, titleTween, aboutTween,
                        buttonsTween]);
                    if (_window && _window.width() > 768) {
                        initSuccesRollover();
                    }
                }
                function initSuccesRollover() {
                    if (auRoManager2) {
                        auRoManager2.init();
                        return;
                    }
                    auRoManager2 = new rollover_1.RolloverManager(".success-image-tile", .7, Quint.easeInOut);
                    var photoCaptionTween = new rollover_1.CssPropertyTween('.photo-caption', 'bottom', '+=2rem');
                    var readMoreTween = new rollover_1.CssPropertyTween(".photo-caption h5", "opacity", 1);
                    auRoManager2.init();
                    auRoManager2.registerTweens([photoCaptionTween, readMoreTween]);
                }
                initRollovers();
                $('.box-link').click(function (e) {
                    e.preventDefault();
                    var a = $(this).find('a');
                    if (a.length) {
                        var href = a.attr('href');
                        if (href) {
                            window.location.href = href;
                        }
                    }
                });
                overlay_1.OverlayManager.init('#overlayBg', null, '.overlay-link');
                $('.carousel').bcSwipe({ threshold: 50 });
                //Sticky nav
                function setupStickyNav() {
                    var stickyNavBarId = "#sticky-nav";
                    // Hide Header on on scroll down
                    var didScroll;
                    var lastScrollTop = 0;
                    var delta = 5;
                    var navbarHeight = $(stickyNavBarId).outerHeight();
                    $(window).scroll(function (event) {
                        didScroll = true;
                    });
                    setInterval(function () {
                        if (didScroll) {
                            hasScrolled();
                            didScroll = false;
                        }
                    }, 250);
                    function hasScrolled() {
                        var st = $(window).scrollTop();
                        if (st < 160) {
                            st = 0;
                        }
                        if (st == 0) {
                            lastScrollTop = st;
                            $(stickyNavBarId).removeClass('nav-down').addClass('nav-up');
                            return;
                        }
                        // Make sure they scroll more than delta
                        if (Math.abs(lastScrollTop - st) <= delta)
                            return;
                        // If they scrolled down and are past the navbar, add class .nav-up.
                        // This is necessary so you never see what is "behind" the navbar.
                        if (st > lastScrollTop && st > navbarHeight) {
                            // Scroll Down
                            if (!$(stickyNavBarId).hasClass('nav-up'))
                                $(stickyNavBarId).removeClass('nav-down').addClass('nav-up');
                        }
                        else {
                            // Scroll Up
                            if (st + $(window).height() < $(document).height()) {
                                $(stickyNavBarId).removeClass('nav-up').addClass('nav-down');
                            }
                        }
                        lastScrollTop = st;
                    }
                }
                setupStickyNav();
            });
        }
    };
});
//# sourceMappingURL=app.js.map