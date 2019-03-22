<template>
    <button type="button" id="favorite_button"
            class="btn rounded-circle"
            v-bind:class="{'btn-outline-danger': !isFavorite, 'btn-danger': isFavorite}"
            :value="training_id"
            v-on:click="switch_favorite"
            v-bind:disabled="!canPush"
            >
        <i class="far fa-heart"></i>
    </button>
</template>

<script>

export default {
    props: ['training_id'],
    data() {
        return {
            canPush: false,
            isFavorite: false
        }
    },
    methods: {
        switch_favorite: function () {
            var oldIsFavorite = this.isFavorite;
            this.isFavorite = !this.isFavorite;
            console.log('isFavorite :' + oldIsFavorite + '->' + this.isFavorite);

            if(oldIsFavorite){
                axios({
                    method: 'DELETE',
                    url: location.protocol + '//' + location.host + '/favorite',
                    data: {
                        training_id: this.training_id
                    }
                }).then(response => {
                  }).catch(error => {
                    this.isFavorite = !this.isFavorite;
                    console.log(error);
                  });
            }else{
                axios({
                    method: 'POST',
                    url: location.protocol + '//' + location.host + '/favorite/store',
                    data: {
                        training_id: this.training_id
                    }
                }).then(response => {
                  }).catch(error => {
                    this.isFavorite = !this.isFavorite;
                    console.log(error);
                  });
            }
        }
    },
    mounted() {
        axios
            .get(location.protocol + '//' + location.host + '/favorite/show/' + this.training_id)
            .then(
                response => {
                    this.isFavorite = response.data.isFavorite;
                    this.canPush = true;
                }
            );

    }
}
</script>
