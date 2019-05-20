/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('load-more', require('./components/LoadMore.vue'));


const app = new Vue({
        el: '#app',
        data: {
            messages: [],
            usersInRoom: []
        },
        methods: {
            loadingMore(data) {
                console.log(data);
                axios.get('/messages-more/' + data.room_id + "/" + data.page).then(response => {
                    console.log(this.messages.length);
                    console.log(response.data.length);
                    if (this.messages.length < response.data.length) {
                        this.messages = response.data;
                        $('#page').text(++data.page);
                        $('#load_status').text("0");
                    }
                    else{
                        $('.lazy-load').hide();
                    }
                });
            },

            addMessage(message) {
                // Add to existing messages
                this.messages.push(message);

                // Persist to the database etc
                var room_id = $('#room_id').text();
                axios.post('/messages', message).then(response => {
                    axios.get('/messages/' + room_id).then(response => {
                        this.messages = response.data;
                        $(".chat-log").animate({scrollTop: $('.chat-log').prop("scrollHeight")}, 1000);

                    });
                })
            },
            removeMessage(message) {
                var room_id = $('#room_id').text();
                var id = message.id;
                axios.get('/message/delete/' + room_id + "/" + id).then(response => {
                    axios.get('/messages/' + room_id).then(response => {
                        this.messages = response.data;
                    });
                });
            },
            loadMore() {
                console.log("running loadmore function ok");
            }
        },
        created() {
            var room_id = $('#room_id').text();
            console.log(room_id);
            axios.get('/messages/' + room_id).then(response => {
                this.messages = response.data;

                $(".chat-log").animate({
                    scrollTop: 2 * ($('.chat-log').offset().top + $('.chat-log').outerHeight(true))
                }, 1000);
            });


            Echo.join('room_' + room_id)
                .here((users) => {
                    this.usersInRoom = users;
                })
                .joining((user) => {
                    this.usersInRoom.push(user);
                })
                .leaving((user) => {
                    this.usersInRoom = this.usersInRoom.filter(u => u != user)
                })
                .listen('MessagePosted', (e) => {
                    this.messages.push({
                        message: e.message.message,
                        user: e.user
                    });

                    axios.get('/messages/' + room_id).then(response => {
                        $('.chat-log').scrollTop($('.chat-log').scrollHeight);
                        this.messages = response.data;
                    });
                })
                .listen('DeleteMessage', (e) => {
                    var id = message.id;

                    //delete mess in dtb
                    axios.get('/messages/' + room_id).then(response => {
                        this.messages = response.data;
                    });
                })
            ;
        }
    })
;
