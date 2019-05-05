<template>
    <div id="tennis_courts">
        <tennis_court-component
            v-for="procedure in this.procedures"
            v-bind:key="procedure.id"
            :is-display-button="isDisplayButton"
            :procedure="procedure"
            ></tennis_court-component>

        <button type="button" class="btn btn-light"
                v-on:click="addProcedure()"
                v-if="this.isDisplayButton===true">
            手順追加
            </button>
        <button type="button" class="btn btn-light"
                v-on:click="save()"
                v-if="this.isDisplayButton===true">
            保存
            </button>
        <!--
        {{this.isDisplayButton}}
        {{this.procedures}}
        -->
    </div>
</template>
<script>
    export default {
        props: {

            isDisplayButton: Boolean,
            trainingId: Number
        }
        ,watch: {
        }
        ,data(){
            return {
                procedures: {
                },
                procedure_data: []
            }
        }
        , created(){
            this.asyncUpdateProcedures();
            console.log('created! trainingId = ' + this.trainingId);
        }
        , methods: {
            save: function(){
                console.log("TennisCourtsComponent save");
                axios({
                    method: "POST",
                    url: location.protocol + '//' + location.host + '/trainings/' + this.trainingId + '/procedures',
                    data: {
                        procedures: this.procedures
                    }
                }).then(response => {
                    console.log('success');
                }).catch(error => {
                    console.log(error);
                });


            },

            asyncUpdateProcedures : function(){

                console.log('ayncUpdateProcedures Start');

                axios({
                    method: 'GET',
                    url: location.protocol + '//' + location.host + '/trainings/' + this.trainingId + '/procedures',
                    data: {
                        trainingId: this.trainingId
                    }
                }).then(response => {
                    console.log(response.data);
                    this.procedures = response.data;
                    /*for(var i = 0; i < this.procedures.length; i++){
                        console.log(this.procedures[i]);
                        this.procedures[i].procedure_data = JSON.parse(this.procedures[i].procedure_data);
                    }*/

                    }).catch(error => {
                    console.log(error);
                });
            },

            addProcedure : function(){
                axios({
                    method: 'POST',
                    url: location.protocol + '//' + location.host + '/trainings/' + this.trainingId + '/procedures/create',
                    data:{
                        trainingId: this.trainingId,
                        description: '初期値を入力してください。',
                        procedure_data: ' '
                    }
                }).then(response =>{
                    console.log(response.data);
                    this.procedures.push([]);
                }).catch(error => {
                    console.log(error);
                });

            }
        },

        mounted() {
        }

    }
</script>
