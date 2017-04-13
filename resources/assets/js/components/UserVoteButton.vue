<template>
    <button
            class="btn btn-default"
            v-bind:class="{'btn-primary':voted}"
            v-text="text"
            v-on:click="follow"
    ></button>
</template>

<script>
    export default {
        props:['answer','count'],
        mounted() {
            this.$http.post('/api/answer/'+ this.answer +'/votes/users').then(respond => {
                this.voted = respond.data.voted
            });
        },
        data() {
            return {
                voted: false
            }
        },
        computed: {
            text() {
                return this.count;
            }
        },
        methods:{
            follow() {
                this.$http.post('/api/answer/vote',{'answer':this.answer}).then(response => {
                    this.voted = response.data.voted;
                    response.data.voted ? this.count ++ : this.count -- ;
                });
            }
        }
    }
</script>
