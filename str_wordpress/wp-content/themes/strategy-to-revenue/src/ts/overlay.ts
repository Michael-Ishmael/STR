import Navigo from "navigo";
import {TimelineLite, Linear} from "gsap";
import * as $ from "jquery";

export class OverlayManager {


    //public tweens: IOverlayTween[];
    public jTriggerEl: JQuery<HTMLElement>;

    private static _jBody:JQuery<HTMLElement>;
    private static _jBackGround:JQuery<HTMLElement>;
    private static _previousOverlay:JQuery<HTMLElement>;
    private static _currentOverlay:JQuery<HTMLElement>;
    private static _nextOverlay:JQuery<HTMLElement>;
    private static _initialized:boolean;
    private static _bgVisible:boolean;
    private static _timeline:TimelineLite;
    private static _timeline2:TimelineLite;

    private static NO_SCROLL_CLASS:string = "noscroll";
    private static Z_INDEX_0:string = "-2";
    private static Z_INDEX_1:string = "1";
    private static Z_INDEX_2:string = "2";

    private static duration:number = .5;

    private static _screenStack:Array<Overlay>;
    private static _router: Navigo;
    private static _currentArea: string;

    public constructor() {
        //this.tweens = [];

    }

    public static init(overlayBgSelector:string, overlayClassName:string, overlayTriggersSelector:string, router:Navigo){
        OverlayManager._router = router;

        this._screenStack = [];
        this._jBody = $('body');
        this._jBackGround = $(overlayBgSelector);
        let triggers = this.initTriggers(overlayTriggersSelector);
        this.initEscapeKey();
        this._initialized = (this._jBody && this.isValidJElement(this._jBackGround) && triggers);



        //  Store bg element
        //  SetUp

    }

    private static get BgVisible():boolean{
        return this._bgVisible;
    }

    private static initEscapeKey(){
        if(!this._jBody) return;
        this._jBody.keyup((e) => {
            if (e.keyCode === 27) this.hide();
        });
    }


    private static initTriggers(overlayTriggersSelector:string):boolean{

        let jTriggers = $(overlayTriggersSelector);
        if(!this.isValidJElement(jTriggers)) return false;

        jTriggers.click((e) => {

            e.preventDefault();

            let jTrigger:JQuery<HTMLElement> = $(e.currentTarget);
            //let link = this.getOverlayLinkFromTrigger(jTrigger);
            let overlayId = this.getOverlayIdFromTrigger(jTrigger);
            let overlayIsSticky = this.getOverlayIdIsStickyFromTrigger(jTrigger);
            let overlayClasses = this.getOverlayAddedClasses(jTrigger);

            if(overlayId) {

                if(OverlayManager._router) {
                    let queryString = "";
                    if(overlayIsSticky) queryString += "s=1";
                    if(overlayClasses == "hide-footers") queryString += queryString ? "&hf=1" : "hf=1";
                    if(queryString.length>0) queryString = "?" + queryString;
                    OverlayManager._router.navigate(this._currentArea + '/' + overlayId + queryString);
                    //OverlayManager._router.resume();
                } else {
                    this.showOverlay(overlayId, overlayIsSticky, overlayClasses);
                }

            }
        });

        return true;

    }

    public static showOverlay(overlayId: string, overlayIsSticky: boolean, overlayClasses: string, showImmediately: boolean = false):boolean{

       if(!this._initialized) return false;
       let nextOverlayElement = $('#' + overlayId);
       if(!this.isValidOverlayItem(nextOverlayElement)) return false;

       if(this._screenStack){
           const screenCount = this._screenStack.length;
           if(screenCount === 1){
               if(this._screenStack[0].overlaySlug === overlayId) return;
           } else if(screenCount === 2){
               if(this._screenStack[screenCount - 2].overlaySlug === overlayId){
                   this.removeLastScreen();
                   return;
               }
           } else if(screenCount > 2) {
               //TODO:  Code for more layers if case arises - animate top away, hide others immediately
           }


       }

       this.initTimeline();
       if(!this.BgVisible){
           this.setNoScroll(true);
           this.setBackgroundVisibility(true, showImmediately);
       }
        let stackSize = this._screenStack.length + 1;
        let newItem = new Overlay(nextOverlayElement, stackSize, this.duration, overlayIsSticky, overlayId, overlayClasses);
        this._screenStack.push(newItem);

        newItem.show();
       this._timeline.play();

       return true;
    }



    public static setCurrentArea(siteArea: string){
        OverlayManager._currentArea = siteArea ? siteArea :"";
    }

    public static setLoadedOverlay(siteArea: string, overlayId: string, overlayIsSticky: boolean, overlayClasses: string){
        if(!this._initialized) return;
        OverlayManager.setCurrentArea(siteArea);
        let nextOverlayElement = $('#' + overlayId);
        if(!this.isValidOverlayItem(nextOverlayElement)){
            OverlayManager._router.pause();
            OverlayManager._router.navigate(this._currentArea );
            OverlayManager._router.resume();
            return;
        }


        if(!this.BgVisible){
            this.setNoScroll(true);
            this.setBackgroundVisibility(true, true);
        }
        let stackSize = this._screenStack.length + 1;
        let newItem = new Overlay(nextOverlayElement, stackSize, this.duration, overlayIsSticky, overlayId, overlayClasses);
        this._screenStack.push(newItem);
        newItem.setAlreadyShown();
    }

    public static overlayRemoved(overlay:Overlay) {
        let partingOverlay = this._screenStack.pop();
        partingOverlay.kill();
        if(this._screenStack.length === 0){
            this.hide();
        }
    }

    public static overlayDone(overlay:Overlay) {
        this.arrangeLayers();
    }


    private static keepExisting():boolean{
        //TODO: Make more generic
        if(this._currentOverlay && this._currentOverlay.attr("id").indexOf("overlay-about") > -1){
            if(this._nextOverlay && this._nextOverlay.attr("id").indexOf("overlay-expertise") > -1){
                return true;
            }
        }
        return false;
    }

    private static registerCloseButton(closeButton:JQuery<HTMLElement>){
        closeButton.click((e) => {
            e.preventDefault();
            this.hide();
        })
    }


    private static arrangeLayers(){
        if(!this._screenStack) return;
        let stackSize = this._screenStack.length;
        if(stackSize <= 1) return;
        let last = this._screenStack[stackSize-1];
        if(last.isSticky) return;

        let first= this._screenStack.shift();
        first.hide(true);

    }

    private static initTimeline(useSecond:boolean = false){
        if(useSecond){
            if(this._timeline2){
                this._timeline2.kill()
            }
            this._timeline2 = new TimelineLite({
                //onComplete: () =>{ this.arrangeLayers() } ,
                onReverseComplete: () =>{ this.cleanUpHide() }
            });
        }
        if(this._timeline){
            this._timeline.kill()
        }
        this._timeline = new TimelineLite({
           // onComplete: () =>{ this.arrangeLayers() } ,
            onReverseComplete: () =>{ this.cleanUpHide() }
        });
    }

    public static isValidJElement(jElement:JQuery<HTMLElement>):boolean{
        return jElement && jElement.length > 0;
    }

    public static isValidOverlayItem(jElement:JQuery<HTMLElement>):boolean{
        if(!this.isValidJElement(jElement)) return false;
        let oBody = jElement.find('.overlay-content');
        return this.isValidJElement(oBody);
    }

    public static hide(){
        if(!this._initialized) return;

        this.setBackgroundVisibility(false, true);
        this.setNoScroll(false);
        return;


    }

    public static navigateToLastScreen(){
        let newPath:string = OverlayManager._currentArea ? "/" + OverlayManager._currentArea : "";
        if(this._screenStack.length > 1){
            let lastScreen = this._screenStack[this._screenStack.length-2];
            if(lastScreen && lastScreen.overlaySlug) newPath += "/" + lastScreen.overlaySlug;

        }
        OverlayManager._router.navigate(newPath);
    }

    public static removeLastScreen(){
        if(this._screenStack.length === 0) return;
        let lastScreen = this._screenStack[this._screenStack.length - 1];
        lastScreen.hide();
    }

    private static cleanUpHide(){


        this.setBackgroundVisibility(false, true);
        this.setNoScroll(false);
    }

    private static setBackgroundVisibility(on:boolean, immediate:boolean = false){
        let zProp = on ? '100' : '-1';
        let oProp = on ? 1 : 0;
        let aHiddenProp = on ?'false' : 'true';
        this._jBackGround.css('z-index', zProp);
        /*this._timeline .fromTo(this._jBackGround[0], this.duration,
            {backgroundColor : 'rgba(40, 40, 40, 0.01)'},
            {backgroundColor : 'rgba(40, 40, 40, 0.75)'}, 0);*/
        if(immediate){
            this._jBackGround.css('opacity', oProp);
        } else {
            this._timeline.to(this._jBackGround[0], this.duration, {autoAlpha: oProp}, 0);
        }
        this._bgVisible = on;
        this._jBackGround.attr('aria-hidden', aHiddenProp);
    }

    private static setNoScroll(on:boolean){
        if(on){
            if(!this._jBody.hasClass(this.NO_SCROLL_CLASS)){
                this._jBody.addClass(this.NO_SCROLL_CLASS)
            }
        } else {
            this._jBody.removeClass(this.NO_SCROLL_CLASS);
        }
    }

    private static getOverlayIdFromTrigger(jTrigger:JQuery<HTMLElement>):string{
        if(!(jTrigger && jTrigger.length > 0)) return null;
        let overlayId = jTrigger.data('overlay');
        return overlayId;
    }

    private static getOverlayIdIsStickyFromTrigger(jTrigger:JQuery<HTMLElement>):boolean{
        if(!(jTrigger && jTrigger.length > 0)) return false;
        let overlaySticky = jTrigger.data('overlay-sticky');
        return this.testForBoolean(overlaySticky);
    }

    private static getOverlayAddedClasses(jTrigger:JQuery<HTMLElement>):string{
        if(!(jTrigger && jTrigger.length > 0)) return "";
        let overlayClasses= jTrigger.data('overlay-classes');
        return overlayClasses;
    }

    public static testForBoolean(testValue):boolean{
        if(testValue === undefined || testValue == null) return false;
        if(testValue === true) return true;
        if(testValue === false) return false;
        let string = testValue.toString();
        switch(string.toLowerCase().trim()){
            case "true": case "yes": case "1": return true;
            case "false": case "no": case "0": case null: return false;
            default: return Boolean(string);
        }
    }

    private static getOverlayLinkFromTrigger(jTrigger:JQuery<HTMLElement>):string{
        if(!(jTrigger && jTrigger.length > 0)) return null;
        if(jTrigger[0].localName === 'a'){
            return jTrigger.attr('href')
        } else {
            let jLink = jTrigger.find('a');
            if(jLink.length > 0){
                return jLink.attr('href')
            } else {
                return null;
            }
        }
    }

}


class Overlay {

    private _timeline:TimelineLite = null;
    private _closeButton:JQuery<HTMLElement> = null;

    public constructor(public screen:JQuery<HTMLElement>, public zIndex:number, public duration:number, public isSticky:boolean = false, public overlaySlug:string, public overlayClasses:string = ""){

    }

    public show():void{

        this.registerCloseButton();

        this.screen.css("zIndex", this.zIndex.toString());
        this.screen.addClass(this.overlayClasses);
        this.screen.show();

        this._timeline = new TimelineLite({
            onComplete: () =>{ this.tweenDone() } ,
            onReverseComplete: () =>{ this.cleanUpHide() }
        });

        let oBody = this.screen.find('.overlay-content');
        let oImg = this.screen.find('.overlay-image-container');
        let width = oBody.width() + 10;
        this._timeline.set(oBody[0],  {x: width}, 0);
        this._timeline.set(oImg[0], {autoAlpha: 0}, 0);
        this._timeline.addLabel("doors", 0);

        this._timeline.to(oBody[0], this.duration, {x: 0}, "doors");
        this._timeline.to(oImg[0], this.duration ,{autoAlpha: 1, ease: Linear.easeNone}, this.duration / 2);
    }

    public setAlreadyShown():void{
        this.registerCloseButton();
        this.screen.css("zIndex", this.zIndex.toString());
        this.screen.addClass(this.overlayClasses);
        this.screen.show();

        this._timeline = new TimelineLite({
            onComplete: () =>{ this.tweenDone() } ,
            onReverseComplete: () =>{ this.cleanUpHide() }
        });

        let oBody = this.screen.find('.overlay-content');
        let oImg = this.screen.find('.overlay-image-container');
        let width = oBody.width() + 10;
        this._timeline.set(oBody[0],  {x: width}, 0);
        this._timeline.set(oImg[0], {autoAlpha: 0}, 0);
        this._timeline.addLabel("doors", 0);

        this._timeline.to(oBody[0], this.duration, {x: 0}, "doors")
        this._timeline.to(oImg[0], this.duration ,{autoAlpha: 1, ease: Linear.easeNone}, this.duration / 2).progress(1);

        //this._timeline.progress(1, false);
    }

    private registerCloseButton(){
        let closeButton = this.screen.find('.close-button');
        if(!OverlayManager.isValidJElement(closeButton)) return;
        this._closeButton = closeButton;
        this._closeButton.click((e) => {
            e.preventDefault();
            //window.history.back();
            OverlayManager.navigateToLastScreen();
        })

    }

    public hide(immediate:boolean = false):void  {
        if(!this._timeline) immediate =true;
        if(immediate){
            this.screen.hide();
            this.screen.removeClass(this.overlayClasses);
            if(this._timeline){
                this._timeline.seek(0, true);
            } else {
                this.cleanUpHide();
            }
            return;
        }
        if(!this._timeline) return;
        if(this._timeline.isActive()){
            this._timeline.kill()
        }
        this._timeline.reverse();
    }

    public tweenDone():void{
        OverlayManager.overlayDone(this);
    }

    public cleanUpHide():void {
        this.screen.hide();
        this.screen.removeClass(this.overlayClasses);
        OverlayManager.overlayRemoved(this);
    }

    public kill():void  {
        if(this._timeline) this._timeline.kill();
        if(this._closeButton){
            this._closeButton.off("click");
        }
        this.screen = null;
    }

}
