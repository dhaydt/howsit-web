<template>
    <div class="feed inner-shadow" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                <div class="text outer-shadow">
                    <div class="" style="text-align: left; margin-bottom: 8px;">
                        <span>{{ message.created_at | formatDate }}</span>
                    </div>
                    {{ message ? message.text: null }}
                    <img v-if="message.image"  :src="'/'+message.image" alt="" style="max-width: 150px;">
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import moment from 'moment';
    import Vue from 'vue';

    Vue.filter('formatDate', function(value) {
        if (value) {
            return moment(String(value)).format('DD/MM/YYYY | hh:mm')
        }
    });

    export default {
        props: {
            contact: {
                type: Object,
            },
            messages: {
                type: Array,
                required: true,
            }
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 10)
            },


        },

        watch: {

            contact(contact) {
                this.scrollToBottom();
            },

            messages(messages) {
                this.scrollToBottom();
                // console.log('feed', this.messages)
            },

            date: function(date) {
        		return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
        	},
        }
    }
</script>

<style lang="scss" scoped>
.feed {
    background-color: #ebecf0;
    height: 50vh;
    min-height: 470px;
    width: 100%;
    overflow: scroll;
    ul {
        list-style-type: none;
        padding: 5px;
        li {
            &.message {
                margin: 10px 0;
                width: 100%;
                .text {
                    max-width: 200px;
                    border-radius: 20px 20px 3px 20px;
                    padding: 5px 15px;
                    display: inline-block;
                    text-align: center;
                }
                &.received {
                    text-align: left;
                    .text {
                        min-width: 100px;
                        background: #f7f7f7;
                        margin-left: 15px;
                        margin-top: 10px;
                    }
                }
                &.sent {
                    text-align: right;
                    .text {
                        min-width: 100px;
                        background: #ebecf0;
                        margin-right: 15px;
                        margin-top: 10px;
                    }
                }
            }
        }
    }
}
</style>
