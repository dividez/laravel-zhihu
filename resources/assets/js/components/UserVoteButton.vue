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
        props:['answer'],
        mounted() {
            this.$http.post('/answer/'+ this.answer +'/votes/users').then(respond => {
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
                this.$http.post('/api/answer/vote',{'answer':this.answer}).then(respond => {
                    this.voted = respond.data.voted;
                    this.count ++
                });
            }
        }
    }
</script>
