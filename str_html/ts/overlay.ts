import $ from 'jquery';
import htmlString = JQuery.htmlString;


// multiple overlay sections at bottom of the page
// one or more triggers show a given overlay

// overlay


export class OverlayManager {

    //public tweens: IOverlayTween[];
    public jTriggerEl: JQuery<HTMLElement>;

    private static _jBody:JQuery<HTMLElement>;
    private static _jBackGround:JQuery<HTMLElement>;
    private static _currentOverlay:JQuery<HTMLElement>;
    private static _nextOverlay:JQuery<HTMLElement>;
    private static _initialized:boolean;
    private static _bgVisible:boolean;
    private static _timeline:TimelineLite;

    private static NO_SCROLL_CLASS:string = "noscroll";
    private static Z_INDEX_0:string = "-2";
    private static Z_INDEX_1:string = "1";
    private static Z_INDEX_2:string = "2";

    private static duration:number = .5;


    public constructor() {
        //this.tweens = [];

    }

    public static init(overlayBgSelector:string, overlayClassName:string, overlayTriggersSelector:string){

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
            let link = this.getOverlayLinkFromTrigger(jTrigger);
            let overlayId = this.getOverlayIdFromTrigger(jTrigger);
            if(link) window.location.hash = link;
            if(overlayId) this.showOverlay(overlayId);

        });

        return true;

    }

    public static showOverlay(overlayId:string){

       if(!this._initialized) return;
       this._nextOverlay = $('#' + overlayId);
       if(!this.isValidJElement(this._nextOverlay)) return;
       let closeButton= this._nextOverlay.find('.close-button');
       if(!this.isValidJElement(closeButton)) return;
       this.registerCloseButton(closeButton);
       this.initTimeline();
       if(!this.BgVisible){
           this.setNoScroll(true);
           this.setBackgroundVisibility(true);
       }
       this.showOverlayInternal();
       this._timeline.play();
    }

    private static registerCloseButton(closeButton:JQuery<HTMLElement>){
        closeButton.click((e) => {
            e.preventDefault();
            this.hide();
        })
    }

    private static showOverlayInternal(){

        if(this._currentOverlay){
            this._currentOverlay.css('z-index', this.Z_INDEX_1)
            //this._currentOverlay.hide();
        }

        this._nextOverlay.show();

        let oBody = this._nextOverlay.find('.overlay-content');
        let oImg = this._nextOverlay.find('.overlay-image-container');
        let width = oBody.width() + 10;
        this._timeline.set(oBody[0],  {x: width}, 0);
        this._timeline.set(oImg[0], {autoAlpha: 0}, 0);
        this._timeline.addLabel("doors", 0);

        this._timeline.to(oBody[0], this.duration, {x: 0}, "doors");
        this._timeline.to(oImg[0], this.duration ,{autoAlpha: 1, ease: Linear.easeNone}, this.duration / 2);


        this._nextOverlay.css('z-index', this.Z_INDEX_2);

    }

    private static arrangeLayers(){
        if(this._currentOverlay) {
            this._currentOverlay.hide();
            this._currentOverlay.css('z-index', null);
        }
        this._currentOverlay = this._nextOverlay;
        this._nextOverlay = null;
    }

    private static initTimeline(){
        if(this._timeline){
            this._timeline.kill()
        }
        this._timeline = new TimelineLite({
            onComplete: () =>{ this.arrangeLayers() } ,
            onReverseComplete: () =>{ this.cleanUpHide() }
        });
    }

    private static isValidJElement(jElement:JQuery<HTMLElement>):boolean{
        return jElement && jElement.length > 0;
    }


    public static hide(){
        if(!this._initialized) return;
        if(this._timeline){
            this._timeline.reverse();
        } else {
            if(this._currentOverlay) this._currentOverlay.hide();
            if(this._nextOverlay) this._nextOverlay.hide();
            this.setBackgroundVisibility(false, true);
            this.setNoScroll(false);
        }

    }

    private static cleanUpHide(){
        if(this._currentOverlay) {
            this._currentOverlay.hide();
            this._currentOverlay = null;
        }
        if(this._nextOverlay) {
            this._nextOverlay.hide();
            this._nextOverlay = null;
        }

        this.setBackgroundVisibility(false, true);
        this.setNoScroll(false);
    }

    private static setBackgroundVisibility(on:boolean, immediate:boolean = false){
        let zProp = on ? '10' : '-1';
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
