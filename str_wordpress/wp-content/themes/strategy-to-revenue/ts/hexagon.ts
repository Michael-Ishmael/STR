
var $ = jQuery;

export class HexagonLayout {

    public hexData:string[] = [];
    public hexCount:number = 0;
    public hexWidth:number = 0;
    public hexHeight:number = 0;
    public rowCount:number = 0;
    public rowHeight:number = 0;
    public oddRowColCount:number = 0;
    public evenRowColCount:number = 0;
    public reqContainerHeight:number = 0;


    public constructor(public parentContainerId:string, public hexClass, public maxHexWidth:number, public minHexWidth:number){

        let hexes = $(parentContainerId).children(hexClass);
        this.hexData = hexes.toArray().map(t => '#' + t.id);
        this.hexCount = this.hexData.length;
    }

    public recalc(width:number):void{

        if(width < 1) return;

        let minWidthColCount = width / this.minHexWidth;
        let maxWidthColCount = width / this.maxHexWidth;

        this.evenRowColCount = Math.ceil(maxWidthColCount) <= minWidthColCount ? Math.ceil(maxWidthColCount) : Math.floor(maxWidthColCount);
        this.oddRowColCount = this.evenRowColCount -1;

        this.rowCount = Math.ceil(this.hexCount/(this.evenRowColCount - .5));

        this.hexWidth = Math.floor(width / this.evenRowColCount);
        this.hexHeight = HexagonLayout.getHexHeightFromWidth(this.hexWidth);

        this.rowHeight = this.hexWidth * .75;

        this.reqContainerHeight = this.rowHeight * (this.rowCount+1);

    }

    public layoutHexagons():void{

        let parent = $(this.parentContainerId);
        if(parent.length == 0) return;

        parent.css('visibility', "hidden");
        let targetWidth = parent.width();
        if(targetWidth == 0) return;

        this.recalc(targetWidth);
        parent.css({position: 'relative'});
        parent.height(this.reqContainerHeight);

        let isOdd:boolean = true;

        let i = 0;

        for (let r = 0; r < this.rowCount; r++) {

            let colCount = isOdd ? this.oddRowColCount : this.evenRowColCount;

            for (let c = 0; c < colCount; c++) {

                let hex = $(this.hexData[i]);
                if(hex.length == 0) continue;

                let offset = isOdd ? this.hexWidth / 2 : 0;

                let x = (c * this.hexWidth) + offset;
                let y = (r * this.rowHeight) + (r * 20);

                if(isOdd) hex.addClass('odd');
                //hex.find('p > span:first-child').html('Hex r:' + (r + 1).toString() + ', c:' + (c + 1).toString() );
                //hex.width(this.hexWidth);
                //console.log(i.toString() + ' ' + this.hexWidth);
                //hex.height(this.hexHeight);
                hex.css({
                    position: 'absolute',
                    top: y,
                    left: x,
                    width: this.hexWidth,
                    height:this.hexHeight});


                i++;
                if(i >= this.hexData.length) break;
            }
            if(i >= this.hexData.length) break;
            isOdd = !isOdd;
        }

        parent.css('visibility', "visible");

    }

    private static getHexHeightFromWidth(hexWidth: number): number {

        return Math.round( (hexWidth * 2) / Math.sqrt(3) );

    }

}


