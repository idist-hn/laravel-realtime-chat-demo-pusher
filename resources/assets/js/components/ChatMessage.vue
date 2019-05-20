<template lang="html">
    <div class="chat-message" :id="message.id" v-on='{ mouseover: mouseOver, mouseout: mouseOut}'>
        <div class="config-message">
            <button class="btn btn-config" @click="deleteMessage">X</button>
        </div>
        <p>{{ message.message }}</p>
        <small>{{ message.user.name }}</small>
    </div>
</template>

<script>
    export default {
        props: ['message'],
        methods: {
            mouseOver(){
                var user_id = $('#user_id').text();
                if(user_id == 1 || this.message.user.id == user_id)
                $('#'+this.$el.id).find('.config-message').show();
            },mouseOut(){
                var user_id = $('#user_id').text();
                $('#'+this.$el.id).find('.config-message').hide();
            },
            deleteMessage() {
                this.$parent.$emit('messagedeleted',{
                    id: this.$el.id,
                });
            }
        }
    }
</script>

<style lang="css">
    .chat-message {
        padding: 1rem;
        position: relative;

    }
    .chat-message:hover .config-message{
        /*display: block;*/
    }
    .config-message {
        position: absolute;
        top: 0;
        right: 0;
        display: none;
    }

    .btn-config {
        background: transparent;
        border: transparent;
        border-radius:0 0 0 10px ;
    }

    .btn-config:hover , .btn-config:focus{
        background: rgba(0,0,0,0.1);
    }

    .chat-message > p {
        margin-bottom: .5rem;
    }
</style>
