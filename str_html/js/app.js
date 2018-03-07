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
                    var hexes = jquery_1.default(parentContainerId).children(hexClass);
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
                    var parent = jquery_1.default(this.parentContainerId);
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
System.register("overlay", ["jquery"], function (exports_3, context_3) {
    "use strict";
    var __moduleName = context_3 && context_3.id;
    var jquery_3, OverlayManager;
    return {
        setters: [
            function (jquery_3_1) {
                jquery_3 = jquery_3_1;
            }
        ],
        execute: function () {
            OverlayManager = /** @class */ (function () {
                function OverlayManager() {
                    //this.tweens = [];
                }
                OverlayManager.init = function (overlayBgSelector, overlayClassName, overlayTriggersSelector) {
                    this._jBody = jquery_3.default('body');
                    this._jBackGround = jquery_3.default(overlayBgSelector);
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
                    var jTriggers = jquery_3.default(overlayTriggersSelector);
                    if (!this.isValidJElement(jTriggers))
                        return false;
                    jTriggers.click(function (e) {
                        e.preventDefault();
                        var jTrigger = jquery_3.default(e.currentTarget);
                        var link = _this.getOverlayLinkFromTrigger(jTrigger);
                        var overlayId = _this.getOverlayIdFromTrigger(jTrigger);
                        if (link)
                            window.location.hash = link;
                        if (overlayId)
                            _this.showOverlay(overlayId);
                    });
                    return true;
                };
                OverlayManager.showOverlay = function (overlayId) {
                    if (!this._initialized)
                        return;
                    this._nextOverlay = jquery_3.default('#' + overlayId);
                    if (!this.isValidJElement(this._nextOverlay))
                        return;
                    var closeButton = this._nextOverlay.find('.close-button');
                    if (!this.isValidJElement(closeButton))
                        return;
                    this.registerCloseButton(closeButton);
                    this.initTimeline();
                    if (!this.BgVisible) {
                        this.setNoScroll(true);
                        this.setBackgroundVisibility(true);
                    }
                    this.showOverlayInternal();
                    this._timeline.play();
                };
                OverlayManager.registerCloseButton = function (closeButton) {
                    var _this = this;
                    closeButton.click(function (e) {
                        e.preventDefault();
                        _this.hide();
                    });
                };
                OverlayManager.showOverlayInternal = function () {
                    if (this._currentOverlay) {
                        this._currentOverlay.css('z-index', this.Z_INDEX_1);
                        //this._currentOverlay.hide();
                    }
                    this._nextOverlay.show();
                    var oBody = this._nextOverlay.find('.overlay-content');
                    var oImg = this._nextOverlay.find('.overlay-image-container');
                    var width = oBody.width() + 10;
                    this._timeline.set(oBody[0], { x: width }, 0);
                    this._timeline.set(oImg[0], { autoAlpha: 0 }, 0);
                    this._timeline.addLabel("doors", 0);
                    this._timeline.to(oBody[0], this.duration, { x: 0 }, "doors");
                    this._timeline.to(oImg[0], this.duration, { autoAlpha: 1, ease: Linear.easeNone }, this.duration / 2);
                    this._nextOverlay.css('z-index', this.Z_INDEX_2);
                };
                OverlayManager.arrangeLayers = function () {
                    if (this._currentOverlay) {
                        this._currentOverlay.hide();
                        this._currentOverlay.css('z-index', null);
                    }
                    this._currentOverlay = this._nextOverlay;
                    this._nextOverlay = null;
                };
                OverlayManager.initTimeline = function () {
                    var _this = this;
                    if (this._timeline) {
                        this._timeline.kill();
                    }
                    this._timeline = new TimelineLite({
                        onComplete: function () { _this.arrangeLayers(); },
                        onReverseComplete: function () { _this.cleanUpHide(); }
                    });
                };
                OverlayManager.isValidJElement = function (jElement) {
                    return jElement && jElement.length > 0;
                };
                OverlayManager.hide = function () {
                    if (!this._initialized)
                        return;
                    if (this._timeline) {
                        this._timeline.reverse();
                    }
                    else {
                        if (this._currentOverlay)
                            this._currentOverlay.hide();
                        if (this._nextOverlay)
                            this._nextOverlay.hide();
                        this.setBackgroundVisibility(false, true);
                        this.setNoScroll(false);
                    }
                };
                OverlayManager.cleanUpHide = function () {
                    if (this._currentOverlay) {
                        this._currentOverlay.hide();
                        this._currentOverlay = null;
                    }
                    if (this._nextOverlay) {
                        this._nextOverlay.hide();
                        this._nextOverlay = null;
                    }
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
            /*
            interface IOverlayBodyState {
                init(): void;
                setOverlayOn(): void;
                setOverlayOff(): void;
            }
            
            export class OverlayBodyState implements IOverlayBodyState {
            
                private _body:JQuery<HTMLElement>;
            
                init() {
                    this._body = $("body");
                }
            
                setOverlayOn() {
                    if (!this._body) return;
                    if (!this._body.hasClass('noscroll')) {
                        this._body.addClass('noscroll')
                    }
                }
            
                setOverlayOff() {
                    if (!this._body) return;
                    this._body.removeClass('noscroll');
                }
            
            }
            
            export class SplitSwipeOverlay{
            
            
                private _tweens:TweenLite[];
            
                public constructor(private duration:number, private bodyState:IOverlayBodyState ){
            
                }
            
            
                public registerTweens(){
                    //Fadebdody
                    //Swipe from left
                    //Swipe from right
                }
            
                public show(){
                    let first:boolean;
                    for (let tween of this._tweens) {
            
                    }
                    //
                }
            
                public hide(){
            
                }
            }
            
            export class OverlayManager {
            
                public tweens:IOverlayTween[];
                public jTriggerEl:JQuery<HTMLElement>;
            
                public constructor(private triggerElement:string, private duration:number, private ease:Ease){
                    this.tweens = [];
            
                }
            
                public registerTweens(tweens: IOverlayTween[]):void {
                    if(!this.jTriggerEl) return;
                    this.tweens = this.tweens.concat(tweens);
                }
            
                public init():void{
                    if(this.triggerElement){
                        this.jTriggerEl = $(this.triggerElement);
                        if(this.jTriggerEl.length){
                            //find close button
                            //this.jTriggerEl.hover((e) => this.show(e.currentTarget), (e) => this.out(e.currentTarget))
                        }
                    }
                }
            
                private getLink(triggerElement:JQuery<HTMLElement>){
            
                }
            
                public show(currentTarget:HTMLElement):void {
                    if(!this.tweens)return;
                    for (let tween of this.tweens) {
                        tween.show(currentTarget, this.duration, this.ease);
                    }
                }
            
                public hide(currentTarget:HTMLElement):void {
                    if(!this.tweens)return;
                    for (let tween of this.tweens) {
                        tween.hide(currentTarget);
                    }
                }
            
            
            }
            
            
            export interface IOverlayTween  {
            
                show(currentTarget:HTMLElement, duration:number, ease:Ease):void;
                hide(currentTarget:HTMLElement):void;
            
            }
            
            class StrOverlayTween {
            
                public tween:TweenLite = null;
                public jElement:JQuery<HTMLElement> = null;
            
                public  constructor(public element:HTMLElement){
            
                }
            
            }
            
            abstract class  OverlayTweenBase {
            
                protected tweens:StrOverlayTween[] = [];
            
            
                public constructor(protected selector:string){
            
                }
            
                hide(currentTarget:HTMLElement): void {
                    if(!this.tweens) return;
                    let matches = this.getTweensForElement(currentTarget);
                    matches.forEach( t => t.tween.reverse());
                    this.removeTweensForElement(currentTarget)
                }
            
                show(currentTarget:HTMLElement, duration: number, ease: Ease): void {
                    if(this.tweenForElementRunning(currentTarget)) return;
                    let strTween = new StrOverlayTween(currentTarget);
                    strTween.jElement = $(currentTarget).find(this.selector);
                    if(!(strTween.jElement && strTween.jElement.length > 0)) return;
                    this.overImpl(strTween, duration, ease);
                    this.tweens.push(strTween);
                }
            
                protected abstract overImpl(tweenContainer:StrOverlayTween, duration: number, ease: Ease);
            
                protected tweenForElementRunning(currentTarget:HTMLElement):boolean{
                    return this.tweens.some(t => {
                        return t.element === currentTarget;
                    });
                }
            
                protected getTweensForElement(currentTarget:HTMLElement):StrOverlayTween[]{
                    return this.tweens.filter(t => {
                        return t.element === currentTarget;
                    });
            
                }
            
                protected removeTweensForElement(currentTarget:HTMLElement):void{
                    this.tweens = this.tweens.filter( t => t.element !== currentTarget);
                }
            }
            
            export class SwipeFromOffScreenTween extends OverlayTweenBase implements IOverlayTween {
            
                public constructor(protected selector:string, private propertyName:string, private toValue:any){
                    super(selector);
                }
            
                protected overImpl(tweenContainer:StrOverlayTween, duration: number, ease: Ease): void {
            
                    //find close button
            
                    let cssTransformObj = {};
                    cssTransformObj[this.propertyName] = this.toValue;
                    if(this.propertyName.toLowerCase() === 'opacity' && tweenContainer.jElement) {
                        if(this.toValue == 0) {
                            tweenContainer.jElement.css('visibility', 'hidden');
                        } else {
                            tweenContainer.jElement.css('visibility', 'visible');
                        }
                    }
                    tweenContainer.tween = TweenLite.to(tweenContainer.jElement[0], duration, {
                        css: cssTransformObj, ease: ease,
                        onReverseComplete: () => {
                            if (this.propertyName.toLowerCase() === 'opacity' && tweenContainer.jElement) {
                                if(this.toValue == 0) {
                                    tweenContainer.jElement.css('visibility', 'visible');
                                } else {
                                    tweenContainer.jElement.css('visibility', 'hidden');
                                }
                            }}
            
                    });
                }
            
            }
            
            /!*
            export class MovePercentageOfParent extends RolloverTweenBase implements IRolloverTween{
            
                public constructor(protected selector:string, private direction:string, private percentage:number){
                    super(selector);
                }
            
                protected overImpl(tweenContainer:StrElementTween, duration: number, ease: Ease): void {
            
                    let parentDimension = this.direction.toLowerCase() === 'y' ? 'height' : 'width';
                    let to = tweenContainer.jElement.parent()[parentDimension]() * this.percentage;
                    to = to - (tweenContainer.jElement[parentDimension]() * this.percentage);
                    let vars = { ease: ease};
                    vars[this.direction] = to;
                    tweenContainer.tween = TweenLite.to(tweenContainer.jElement[0], duration, vars);
                }
            
            }*!/
            */
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
            /*
            let hexData: string[] = [
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
            */
            $(function () {
                var layout = new hexagon_1.HexagonLayout("#hexLayout1", ".str-hex-tile", 220, 140);
                layout.layoutHexagons();
                $(window).resize(function () {
                    layout.layoutHexagons();
                });
                function initRollovers() {
                    var auRoManager = new rollover_1.RolloverManager(".about-us-image-tile", .5, Power3.easeOut);
                    var opacityTween = new rollover_1.CssPropertyTween("img.overlay", "opacity", 1);
                    var buttonsTween = new rollover_1.CssPropertyTween(".buttons", "opacity", 1);
                    var titleTween = new rollover_1.CssPropertyTween("h6.title", "opacity", 0);
                    var aboutTween = new rollover_1.CssPropertyTween(".lower .btn", "opacity", 1);
                    var captionTween = new rollover_1.MovePercentageOfParent('.name-caption-container', 'y', -.5);
                    auRoManager.init();
                    auRoManager.registerTweens([opacityTween, captionTween, titleTween, aboutTween,
                        buttonsTween]);
                    var auRoManager2 = new rollover_1.RolloverManager(".success-image-tile", .7, Quint.easeInOut);
                    var photoCaptionTween = new rollover_1.CssPropertyTween('.photo-caption', 'bottom', '+=2rem');
                    var readMoreTween = new rollover_1.CssPropertyTween(".photo-caption h6", "opacity", 1);
                    auRoManager2.init();
                    auRoManager2.registerTweens([photoCaptionTween, readMoreTween]);
                }
                initRollovers();
                overlay_1.OverlayManager.init('#overlayBg', null, '.overlay-link');
            });
        }
    };
});
//# sourceMappingURL=app.js.map