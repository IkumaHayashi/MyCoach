<template>
    <div class="row">
        <div
            class="col-2 col-sm-4 col-md-2 col-lg-2">
            <svg
                width="100%" height="100%"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                preserveAspectRatio="xMidYMid meet" viewBox="0 0 152 280"
                ref="svg"
                @mousemove="touchmove($event)"
                @touchmove="touchmove($event)"
                @mouseup="touchend($event)"
                @touchend="touchend($event)"
                @mouseleave="touchend($event)"
                @touchleave="touchend($event)"
                @mousedown="touchstart($event)"
                @touchstart="touchstart($event)">
                <g>
                    <path d="M0 0L152 0L152 280L0 280L0 0Z" opacity="1" fill="#d15306" fill-opacity="1"></path>
                    <path d="M20 20L132 20L132 260L20 260L20 20Z" opacity="1" fill="#83e44e" fill-opacity="1"></path>
                    <path d="M131 260C131 220 131 140 131 20" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1"></path>
                    <path d="M21 260C21 220 21 140 21 20" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1"></path>
                    <path d="M35 260C35 220 35 140 35 20" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1"></path>
                    <path d="M132 140C113.33 140 76 140 20 140" opacity="1" fill="#000000" fill-opacity="1"></path>
                    <path d="M132 140C113.33 140 76 140 20 140" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1"></path>
                    <path d="M118 260C118 220 118 140 118 20" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1"></path>
                    <path d="M132 21C113.33 21 76 21 20 21" opacity="1" fill="#000000" fill-opacity="1"></path>
                    <path d="M132 21C113.33 21 76 21 20 21" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1"></path>
                    <path d="M119 76C105 76 77 76 35 76" opacity="1" fill="#000000" fill-opacity="1"></path>
                    <path d="M119 76C105 76 77 76 35 76" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1" ></path>
                    <path d="M118.75 203.75C104.75 203.75 76.75 203.75 34.75 203.75" opacity="1" fill="#000000" fill-opacity="1"></path>
                    <path d="M118.75 203.75C104.75 203.75 76.75 203.75 34.75 203.75" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1"></path>
                    <path d="M132.01 259C113.34 259 76 259 20 259" opacity="1" fill="#000000" fill-opacity="1"></path>
                    <path d="M132.01 259C113.34 259 76 259 20 259" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1"></path>
                    <path d="M76 203C76 181.67 76 139 76 75" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1" ></path>
                    <path d="M76 25C76 24.33 76 23 76 21" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1"></path>
                    <path d="M76 258C76 257.33 76 256 76 254" opacity="1" fill-opacity="0" stroke="#ffffff" stroke-width="2" stroke-opacity="1"></path>
                </g>

                <marker id="arrow" viewBox="-5 -5 10 10" orient="auto">
                    <polygon points="-5,-5 5,0 -5,5" fill="black" stroke="none" />
                </marker>

                <line
                    v-for="line in elements.lines" v-bind:key="line.id"
                    :x1="line.x1" :y1="line.y1" :x2="line.x2" :y2="line.y2"
                    v-bind:id="line.id"
                    stroke="black" stroke-width="3" marker-end="url(#arrow)" />


                <circle v-for="ball in elements.balls" v-bind:key="ball.id"
                    r="6" stroke="black" stroke-width="1" fill="white"
                    v-bind:id="ball.id" :cx="ball.x" :cy="ball.y"
                />

                <use v-for="player in elements.players" v-bind:key="player.id"
                    :xlink:href="require('./graphics/human.svg') + '#human'"
                    v-bind:id="player.id" :x="player.x" :y="player.y"
                    width="24" height="24"/>

                <use v-for="racket in elements.rackets" v-bind:key="racket.id"
                    :xlink:href="require('./graphics/racket.svg') + '#racket'"
                    v-bind:id="racket.id" :x="racket.x" :y="racket.y"
                    width="24" height="24"/>

            </svg>
        </div>
        <div
            class="col-2 col-sm-4 col-md-2 col-lg-2"
            v-if="this.isDisplayButton===true">
            <button type="button" class="btn btn-outline-success"
                    v-on:click="addElement('ball')">
                ボールを追加
            </button><br>
            <button type="button" class="btn btn-outline-success"
                    v-on:click="switchAddLineMode">
                直線を追加
            </button><br>
            <button type="button" class="btn btn-outline-success"
                    v-on:click="addElement('racket')">
                    球出しを追加
            </button><br>
            <button type="button" class="btn btn-outline-success"
                    v-on:click="addElement('player')">
                    プレイヤーを追加
            </button><br>
            <button type="button" class="btn btn-outline-success"
                    v-on:click="switchDeleteMode">
                    要素を削除
            </button>
        </div>

        <div
            class="col-2 col-sm-4 col-md-2 col-lg-2">
                <textarea class="form-control" v-model="this.procedure.description"></textarea>
        </div>
    </div>
</template>

<style scoped>
</style>

<script>
    'use strict';

    const MODE_NEUTRAL = 'Neutral Mode';
    const MODE_MOVE = 'Element Move Mode';
    const MODE_ADDLINE_START = 'Add Line Mode Start';
    const MODE_ADDLINE_END = 'Add Line Mode End';
    const MODE_DELETE = 'Delete Mode';

    class Element {
        constructor(id,x,y){
            this.id = id;
            this.x = x;
            this.y = y;
        }
    }
    class Line {
        constructor(id,x1,y1,x2,y2){
            console.log(id);
            this.id = id;
            this.x1 = x1;
            this.y1 = y1;
            this.x2 = x2;
            this.y2 = y2;
        }
    }
    export default {
        props: {
            isDisplayButton: Boolean,
            procedure: Object,
        },
        data(){
            return {
                state: {
                    mode: MODE_NEUTRAL,
                    message: "",
                },
                temporaryCoordinate: {
                        x: -1.0,
                        y: -1.0,
                },
                previewCoordinate: {
                    x: 0,
                    y: 0,
                },
                control_id: "",
                elements: {

                    balls: [
                    ],
                    lines: [
                    ],
                    debug_points: [
                    ],
                    players: [
                    ],
                    rackets: [
                    ],
                    getId: function(elementName){
                        return elementName + '_' + (this[elementName + 's'].length + 1);
                    },
                    deleteElement: function(id){

                        console.log('Called deletedElement.');

                        if(id.indexOf('_') === -1) return;

                        let elementName = id.split('_')[0] + 's';

                        if(this[elementName]){

                            const element = this[elementName].find((e) => {
                                return (e.id === id);
                            });

                            let index = this[elementName].indexOf(element);

                            this[elementName].splice(index,1);

                            return;
                        }else{
                            return;
                        }
                    }
                }
            }
        }
        ,computed: {
            procedureSvgId: () => "svg_" + this.procedure.id,
            full_size: ()=>{
                return { width: 152, height: 280}
            },

        }
        ,watch: {
            'state.mode': {
                handler: function(val, oldVal){
                console.log('mode is changed.this.state.mode = ' + this.state.mode);
                },

                deep: true

            },
            elements: {
                handler: function(val){
                    console.log('elements changed');
                    this.$forceUpdate();
                    this.procedure.procedure_data = val;
                },
                deep: true
            },
        }
        , methods: {
            canEdit: function(id){
                console.log(id);
                console.log('Called canEdit. id = ' + id);
                if(id.indexOf('_') === -1) return false;

                let elementName = id.split('_')[0] + 's';
                console.log('now elements is here');
                console.log(this.elements);
                if(this.elements[elementName]){
                    console.log(id + ' is editable');
                    return true;
                }else{
                    console.log(id + ' is not editable');
                    return false;
                }

            },
            //Offsetからsvgの絶対座標を取得
            getPosition: function(e){

                if(e === null) return;
                let svg = this.$refs.svg;

                return { "x": e.offsetX / ( svg.clientWidth / this.full_size.width )
                        ,"y": e.offsetY / ( svg.clientHeight / this.full_size.height )};
            },
            switchAddLineMode: function(){
                this.state.mode = MODE_ADDLINE_START;
            },
            switchDeleteMode: function() {
                console.log('called switchDeleteMode');
                this.state.mode = MODE_DELETE;
            },

            //要素追加処理
            addElement: function(elementName){

                console.log('Called addElement. elementName: ' + elementName);

                let arrayName = elementName + 's';
                let array = this.elements[arrayName];
                array.push(new Element(this.elements.getId(elementName), 20,20));
                console.log(this.elements);

            },
            touchstart : function(e){

                if(!this.isDisplayButton)
                    return;

                console.log('touch start! this.state.mode = ' + this.state.mode);
                var id = e.target.id;
                console.log('id =' +  id);

                //要素削除処理
                switch(this.state.mode){

                    case MODE_DELETE:
                        if(this.canEdit(id)){
                            console.log('delete element mode');
                            this.state.mode = MODE_NEUTRAL;
                            this.elements.deleteElement(id);
                        }
                        break;

                    case MODE_ADDLINE_END:

                        this.state.mode = MODE_NEUTRAL;
                        let line = new Line(this.elements.getId('line'),
                                            this.temporaryCoordinate.x,this.temporaryCoordinate.y,
                                            this.getPosition(e).x,this.getPosition(e).y);
                        this.elements['lines'].push(line);

                        this.temporaryCoordinate.x = -1.0;
                        this.temporaryCoordinate.y = -1.0;
                        console.log('added the line. id = ' + this.elements.getId('line'));

                        break;

                    case MODE_ADDLINE_START:
                        console.log('save the start point.');
                        this.temporaryCoordinate.x = this.getPosition(e).x;
                        this.temporaryCoordinate.y = this.getPosition(e).y;
                        //console.log(this.temporaryCoordinate);
                        this.state.mode = MODE_ADDLINE_END;

                        break;

                    default:

                        if( this.canEdit(id)) {
                            this.control_id = id;

                            this.state.mode = MODE_MOVE;

                            this.previewCoordinate.x = this.getPosition(e).x;
                            this.previewCoordinate.y = this.getPosition(e).y;

                            return;
                        }
                        break;

                }
            },
            touchmove : function(e){

                if(!this.isDisplayButton)
                    return;


                console.log(this.control_id);

                //移動量反映
                if(this.state.mode === MODE_MOVE){

                    let element = this.getSVGElementById(this.control_id);
                    if(element.id.includes('line')){

                        let moved_x = this.getPosition(e).x - this.previewCoordinate.x;
                        let moved_y = this.getPosition(e).y - this.previewCoordinate.y;

                        element.x1 += moved_x;
                        element.y1 += moved_y;
                        element.x2 += moved_x;
                        element.y2 += moved_y;

                        this.previewCoordinate.x = this.getPosition(e).x;
                        this.previewCoordinate.y = this.getPosition(e).y;
                    }else{
                        element.x = this.getPosition(e).x;
                        element.y = this.getPosition(e).y;
                    }

                    e.preventDefault();
                }
            },
            touchend : function(e){

                if(!this.isDisplayButton)
                    return;

                if(this.state.mode === MODE_MOVE)
                    this.state.mode = MODE_NEUTRAL;

                this.control_id = -1;

            },

            //SVG上のIDからdata()内の要素を取得する
            getSVGElementById : function(id){


                let element;
                for( let propertyName in this.elements){
                    let properties = this.elements[propertyName];

                    element = properties.find((property) => {
                        return (property.id === id);
                    });

                    if(typeof element !== 'undefined')
                        return element;

                }
                return null;

            },

        },
        created(){
            console.log('created!!!');
        },
        mounted() {
            console.log('mouted!!!!');

            console.log(this.procedure.procedure_data);
            console.log(JSON.parse(this.procedure.procedure_data));
            let objProcedureData = JSON.parse(this.procedure.procedure_data);
            console.log(objProcedureData);
            //JSONで渡されたデータを、Vueのデータに設定する
            for( let propName in this.elements){
                let property = objProcedureData[propName];
                if(typeof property !== 'undefined'){
                    this.elements[propName] = property;
                }
            }


        }

    }
</script>
