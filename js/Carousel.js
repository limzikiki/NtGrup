"use strict";
class Limzousel{
    /**
     * Carousel By Leonard Tesnov tesnov22@outlook.com
     * TODO: Make them stable while there are rendered
     * @param {*} object 
     */

    // animation speed
    speed = 500;

    constructor({...context}) {
        const defaultParams = {
            speed: 10000,
            type: "fade",
            isClickable: false,
            width: "100%",
        }
        if(typeof context.el === "undefined") throw new Error("Elment was not assigned please provide contructor with element {el: '.someclass'}");
        this.params = {...defaultParams, ...context}
        this.current = 0

        if (document.readyState === 'complete') {
            this.init()
        }else{
            document.addEventListener("load", this.init())
        }
    }

    init(){
        const elements = document.querySelectorAll(this.params.el+" > * ")
        if(elements.length == 0) throw new Error("Element "+params.el+"was not found");
        elements.forEach((v)=>{
            v.style.width = this.params.width;
        })
        elements[0].style.display = "";
        this.elements = elements;
        this.startAnimation()
    }

    async startAnimation(){
        switch (this.params.type){
            case "fade":
                let last = new Date();
                let tick = async ()=>{
                    if((new Date() - last)/this.params.speed > 1 ){
                        const prevCurrent = this.current
                        this.current = this.current % this.elements.length? 0 : this.current + 1
                        this.fadeExchange(this.elements[prevCurrent], this.elements[this.current] )
                        last = new Date();
                    }
                    requestAnimationFrame(tick);
                }
                tick();

                break;

            default:
                throw new Error("Unsoprted type of carousel")
        }
    }

    async fadeExchange(element1, element2){
        const speed = this.speed;
        element1.style.opacity = 1;
        element2.style.opacity = 0;
        let last = new Date();
        let tick = async function(){
            element1.style.opacity = +element1.style.opacity - (new Date() - last)/speed;
            element2.style.opacity = +element2.style.opacity + (new Date() - last)/speed;
            last = new Date();
            if (element1.style.opacity > 0 && element2.style.opacity < 1) {
                requestAnimationFrame(tick)
            }
        }
        tick();
    }
}