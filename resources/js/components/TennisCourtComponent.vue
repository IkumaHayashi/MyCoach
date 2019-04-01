<template>
    <div id="procedure_div">
        <div id="svg_div">
            <svg
                width="100%" height="100%"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                preserveAspectRatio="xMidYMid meet" viewBox="0 0 152 280"
                id="tennis_court_svg"
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
                <line v-for="line in lines" v-bind:key="line.id"
                    :x1="line.x1" :y1="line.y1" :x2="line.x2" :y2="line.y2"
                    v-bind:id="line.id"
                    stroke="black" stroke-width="3" marker-end="url(#arrow)" />
                <circle v-for="ball in balls" v-bind:key="ball.id"
                    r="6" stroke="black" stroke-width="1" fill="white"
                    v-bind:id="ball.id" :cx="ball.x" :cy="ball.y"
                />
                <circle v-for="debug_point in debug_points" v-bind:key="debug_point.id"
                    r="1" :stroke="debug_point.color" stroke-width="1" fill="black"
                    v-bind:id="debug_point.id" :cx="debug_point.cx" :cy="debug_point.cy"
                />
                <use v-for="human in humans" v-bind:key="human.id"
                    :xlink:href="require('./graphics/human.svg') + '#human'"
                    v-bind:id="human.id" :x="human.x" :y="human.y"
                    width="24" height="24"/>

                <use v-for="racket in rackets" v-bind:key="racket.id"
                    :xlink:href="require('./graphics/racket.svg') + '#racket'"
                    v-bind:id="racket.id" :x="racket.x" :y="racket.y"
                    width="24" height="24"/>
            </svg>
        </div>
        <div id="button_div" v-if="this.isDisplayButton===true">
            <button type="button" class="btn-light"
                    v-on:click="addElement('ball')">
                ボールを追加
                </button>
            <button type="button" class="btn-light"
                    v-on:click="startClickPoint">
                直線を追加
            </button>
            <button type="button" class="btn-light"
                    v-on:click="addElement('racket')">
                    球出しを追加
            </button>
            <button type="button" class="btn-light"
                    v-on:click="addElement('human')">
                    プレイヤーを追加
            </button>
            <button type="button" class="btn-light"
                    v-on:click="deleteElement">
                    要素を削除
            </button>
        </div>
    </div>
</template>
<style scoped>
</style>
<script>
    export default {
        props: {
            isDisplayButton: Boolean,
            courtStatus: Object
        },
        data(){
            return {
                full_size: {
                    width: 152, height: 280
                },
                state: {
                    is_moveElement: false,
                    is_addLine: false,
                    is_delete: false,
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
                balls: [

                ],
                lines: [
                    /*
                    {"id": "line_1", "x1": 10, "y1": 10, "x2": 100, "y2": 100},
                    {"id": "line_2", "x1": 10, "y1": 20, "x2": 90, "y2": 100}
                    */

                ],
                debug_points: [
                    /*
                    {"id": "debug_point_1", "cx": 10, "cy": 10, color: "red"},
                    {"id": "debug_point_2", "cx": 20, "cy": 20, color: "blue"},
                    */
                ],
                humans: [
                ],
                rackets: [
                ]
            }
        }
        ,watch: {
            'state.is_moveElement': function(value){
                console.log('state.is_moveElement is changed');
                this.state.is_addLine = false;
                this.state.is_delete = false;
            }
        }
        , methods: {
            //Offsetからsvgの絶対座標を取得
            getPosition: function(e){

                if(e === null){
                    console.error('e is not set.');
                    return;
                }

                var svg = document.getElementById('tennis_court_svg');
                console.log({ "x": e.offsetX / ( svg.clientWidth / this.full_size.width )
                        ,"y": e.offsetY / ( svg.clientHeight / this.full_size.height )});
                return { "x": e.offsetX / ( svg.clientWidth / this.full_size.width )
                        ,"y": e.offsetY / ( svg.clientHeight / this.full_size.height )};
            },

            startClickPoint: function()
            {
                console.log('start click point mode');
                this.state.is_addLine = true;
            },
            addElement: function(elementName){

                console.log('addElement. elementName: ' + elementName);

                if(elementName === 'ball'){
                    var circle = {"id": 'ball' + (this.balls.length + 1), "x": 20, "y": 20};
                    console.log(circle);
                    this.balls.push(circle);
                    console.log(this.balls);
                }
                if(elementName === 'human'){
                    var human = {"id": 'human' + (this.humans.length + 1), "x": 20, "y": 20};
                    this.humans.push(human);
                }
                if(elementName === 'racket'){
                    var racket = {"id": 'racket' + (this.rackets.length + 1), "x": 20, "y": 20};
                    console.log('add racket');
                    this.rackets.push(racket);
                }
            },
            deleteElement: function(){
                this.state.is_moveElement = false;
                this.state.is_addLine = false;
                this.state.is_delete = true;
            },
            touchstart : function(e){

                //直線追加処理
                if(this.state.is_addLine
                    && ( e.type === 'mousedown' || e.type === 'touchstart')){
                    console.log('add line mode');

                    //1回目は座標の記憶
                    if(this.temporaryCoordinate.x === -1.0
                       && this.temporaryCoordinate.y === -1.0){

                        this.temporaryCoordinate.x = this.getPosition(e).x;
                        this.temporaryCoordinate.y = this.getPosition(e).y;

                    //2回目は直線を描画して初期化
                    }else{

                        var line = {"id": 'line_' + (this.lines.length + 1)
                                    , "x1": this.temporaryCoordinate.x
                                    , "y1": this.temporaryCoordinate.y
                                    , "x2": this.getPosition(e).x
                                    , "y2": this.getPosition(e).y};
                        this.lines.push(line);
                        this.state.is_addLine = false;
                        this.temporaryCoordinate.x = -1.0;
                        this.temporaryCoordinate.y = -1.0;

                    }

                    return;
                }

                //移動フラグON
                var id = e.target.id;
                console.log(id);
                if( id.includes('ball')
                    || id.includes('human')
                    || id.includes('racket')
                    || id.includes('line')) {
                    this.control_id = id;
                    this.state.is_moveElement = true;
                    this.previewCoordinate.x = this.getPosition(e).x;
                    this.previewCoordinate.y = this.getPosition(e).y;

                    console.log('touchstart. state.is_moveElement : ' + this.state.is_moveElement);
                    return;
                }

            },
            touchmove : function(e){

                console.log(this.control_id);

                if(this.state.is_moveElement){

                    var element;
                    if(this.control_id.includes('ball')){
                        element = this.balls.find( (ball) => {
                                        return (ball.id === this.control_id);
                                    });
                    }
                    if(this.control_id.includes('human')){
                        element = this.humans.find( (human) => {
                                        return (human.id === this.control_id);
                                    });
                    }
                    if(this.control_id.includes('racket')){
                        element = this.rackets.find( (racket) => {
                                        return (racket.id === this.control_id);
                                    });
                    }
                    if(this.control_id.includes('line')){
                        element = this.lines.find( (line) => {
                                        return (line.id === this.control_id);
                                    });
                    }
                    console.log(element);
                    console.log(element.id.includes('line'));
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
                this.state.is_moveElement = false;
                this.control_id = -1;
                console.log("touch end");
            },

        },

        mounted() {
            console.log('mouted!');
            console.log(this.courtStatus.lines);
            this.lines = this.courtStatus.lines;

        }

    }
</script>
