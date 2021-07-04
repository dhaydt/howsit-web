<template>
    <div class="messageFeed">
        <!-- <v-footer fixed> -->
            <!-- <div class="feed inner-shadow" ref="feed"> -->
            <div class="feed" ref="feed">
                <ul v-if="contact" class="pb-2">
                    <li
                        v-for="message in messages"
                        :class="
                            `message${
                                message.to == contact.id ? ' sent' : ' received'
                            }`
                        "
                        :key="message.id"
                    >
                        <div class="text outer-shadow">
                            <div
                                class=""
                                style="text-align: left; margin-bottom: 8px;"
                            >
                                <!-- <span>{{
                                    message.created_at | formatDate
                                }}</span> -->
                            </div>
                            {{ message ? message.text : null }}
                            <img
                                v-if="message.image"
                                :src="'/' + message.image"
                                alt=""
                                style="max-width: 100px;"
                            />
                        </div>
                    </li>
                </ul>
            </div>
        <!-- </v-footer> -->
    </div>
</template>

<script>
import moment from "moment";
import Vue from "vue";

Vue.filter("formatDate", function(value) {
    if (value) {
        return moment(String(value)).format("DD/MM/YYYY | hh:mm");
    }
});

export default {
    props: {
        contact: {
            type: Object
        },
        messages: {
            type: Array,
            required: true
        }
    },

    methods: {
        scrollToBottom() {
            setTimeout(() => {
                this.$refs.feed.scrollTop =
                    this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }, 10);
        }
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
            return moment(date, "YYYY-MM-DD").format("DD/MM/YYYY");
        }
    }
};
</script>

<style lang="scss" scoped>
.messageFeed {
    height: 100%;
    padding: 0;
}
.feed {
    background-color: #fff;
    height: 60vh;

    width: 100%;
    overflow-y: auto;
    ul {
        list-style-type: none;
        padding: 5px;
        max-height: 100%;
        li {
            &.message {
                padding: 10px 0;
                width: 100%;
                .text {
                    max-width: fit-content;
                    border-radius: 20px 20px 3px 20px;
                    padding: 5px 15px;
                    display: inline-block;
                    text-align: center;
                }
                &.received {
                    text-align: left;
                    .text {
                        min-width: 100px;
                        background: #c0c0c2;
                        margin-left: 15px;
                    }
                }
                &.sent {
                    text-align: right;
                    .text {
                        min-width: 100px;
                        background: #ffe100;
                        margin-right: 15px;
                    }
                }
            }
        }
    }
}
</style>
