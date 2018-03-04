import $ from 'jquery';


export class RolloverManager {

    public tweens:IRolloverTween[];
    public jTriggerEl:JQuery<HTMLElement>;

    public constructor(private triggerElement:string, private duration:number, private ease:Ease){
        this.tweens = [];
    }

    public registerTweens(tweens: IRolloverTween[]):void {
        if(!this.jTriggerEl) return;
        this.tweens = this.tweens.concat(tweens);
    }

    public init():void{
        if(this.triggerElement){
            this.jTriggerEl = $(this.triggerElement);
            if(this.jTriggerEl.length){
                this.jTriggerEl.hover((e) => this.over(e.currentTarget), (e) => this.out(e.currentTarget))
            }
        }
    }

    public over(currentTarget:HTMLElement):void {
        if(!this.tweens)return;
        for (let tween of this.tweens) {
            tween.over(currentTarget, this.duration, this.ease);
        }
    }

    public out(currentTarget:HTMLElement):void {
        if(!this.tweens)return;
        for (let tween of this.tweens) {
            tween.out(currentTarget);
        }
    }


}


export interface IRolloverTween  {

    over(currentTarget:HTMLElement, duration:number, ease:Ease):void;
    out(currentTarget:HTMLElement):void;

}

class StrElementTween {

    public tween:TweenLite = null;
    public jElement:JQuery<HTMLElement> = null;

    public  constructor(public element:HTMLElement){

    }

}

abstract class  RolloverTweenBase {

    protected tweens:StrElementTween[] = [];
    protected _manager:RolloverManager;

    public constructor(protected selector:string){

    }

    out(currentTarget:HTMLElement): void {
       if(!this.tweens) return;
        let matches = this.getTweensForElement(currentTarget);
        matches.forEach( t => t.tween.reverse());
        this.removeTweensForElement(currentTarget)
    }

    over(currentTarget:HTMLElement, duration: number, ease: Ease): void {
        if(this.tweenForElementRunning(currentTarget)) return;
        let strTween = new StrElementTween(currentTarget);
        strTween.jElement = $(currentTarget).find(this.selector);
        if(!(strTween.jElement && strTween.jElement.length > 0)) return;
        this.overImpl(strTween, duration, ease);
        this.tweens.push(strTween);
    }

    protected abstract overImpl(tweenContainer:StrElementTween, duration: number, ease: Ease);

    protected tweenForElementRunning(currentTarget:HTMLElement):boolean{
        return this.tweens.some(t => {
            return t.element === currentTarget;
        });
    }

    protected getTweensForElement(currentTarget:HTMLElement):StrElementTween[]{
        return this.tweens.filter(t => {
            return t.element === currentTarget;
        });

    }

    protected removeTweensForElement(currentTarget:HTMLElement):void{
        this.tweens = this.tweens.filter( t => t.element !== currentTarget);
    }
}

export class CssPropertyTween extends RolloverTweenBase implements IRolloverTween {

    public constructor(protected selector:string, private propertyName:string, private toValue:any){
        super(selector);
    }

    protected overImpl(tweenContainer:StrElementTween, duration: number, ease: Ease): void {
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

}