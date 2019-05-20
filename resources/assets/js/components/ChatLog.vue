<template lang="html">
  <div class="chat-log" id="style_7">
      <load-more id="load-more" :page="page"></load-more>
      <chat-message v-for="message in messages" :message="message" :key="message.id"></chat-message>
      <div class="empty" v-show="messages.length === 0">
          Nothing here yet!
      </div>
  </div>
</template>

<script>
export default {
    props: ['messages','page'],
    methods: {
        handleScroll (event) {
            var _scrollTop;
            var load = this;
            $("#style_7").scroll(function () {
                _scrollTop = $('#style_7').scrollTop();
                var room_id = $('#room_id').text();
                var page = parseInt($('#page').text());
                var load_status = $('#load_status').text();
                // var load_status = 0;
                if(_scrollTop == 0 && load_status == 0 ){
                    $('#load_status').text("1");
                    console.log(" đang ở trang số "+page);
                    console.log(load);
                    load.$emit('loadingmore', {
                        position: load.messages[load.messages.length-1].id,
                        page: page,
                        room_id: room_id
                    });

                }
            });
        }
    },
    mounted () {
        document.getElementById('style_7').addEventListener('scroll', this.handleScroll);
    },
    destroyed () {
        document.getElementById('style_7').removeEventListener('scroll', this.handleScroll);
    }
}
</script>

<style lang="css">
    .chat-log{
        max-height: 400px;
        overflow-y: hidden;
        overflow-x: hidden;
    }
    /*
     *  STYLE 7
     */

    #style_7::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
        border-radius: 10px;
    }

    #style_7::-webkit-scrollbar
    {
        width: 5px;
        background-color: #F5F5F5;
        margin-right: -5px;
    }

    #style_7::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        background-image: -webkit-gradient(linear,
        left bottom,
        left top,
        color-stop(0.44, rgb(122,153,217)),
        color-stop(0.72, rgb(73,125,189)),
        color-stop(0.86, rgb(28,58,148)));
    }


    .chat-log:hover{
        overflow-y: scroll;
    }
.chat-log .chat-message:nth-child(even) {
    background-color: #ccc;
}

.empty {
    padding: 1rem;
    text-align: center;
}
</style>
