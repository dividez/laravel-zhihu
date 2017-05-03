<template>
    <div>
        <button
                class="btn btn-default"
                v-bind:class="{'btn-primary':voted}"
                v-on:click="showSendMessageForm"
        >发送私信</button>
        <!-- Access Token Modal -->
        <div class="modal fade" id="modal-send-message" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            发送私信
                        </h4>
                    </div>

                    <div class="modal-body">
                        <textarea name="body" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" @click="store">
                            发送私信
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            },
            showSendMessageForm() {
                $('#modal-send-message').modal('show');
            }
        }
    }
</script>
