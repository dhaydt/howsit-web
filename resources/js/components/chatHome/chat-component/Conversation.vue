<template>
    <v-container class="conversation p-0" fill-height>
        <v-card flat fill-width>
            <v-container fluid class="p-1">
                <v-row dense>
                    <MessagesFeed
                        :contact="contact"
                        :messages="messages"
                    ></MessagesFeed>
                    <MessagesComposer
                        :contact="selectedContact"
                        @send="sendMessage"
                        @store="handler"
                        @inputStatus="inputStat"
                    ></MessagesComposer>
                </v-row>
            </v-container>
        </v-card>
    </v-container>
</template>

<script>
import MessagesFeed from "./MessagesFeed";
import MessagesComposer from "./MessagesComposer";
export default {
    props: {
        contact: {
            type: Object,
            default: null
        },
        messages: {
            type: Array,
            default: []
        },
        input: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            selectedContact: null,
            files: [],
            inputStatus: false,
            imgError: false
        };
    },

    methods: {
        sendMessage(text) {
            if (!this.contact) {
                return;
            }

            // console.log("res", text);
            axios
                .post("./conversation/send", {
                    contact_id: this.contact.id,
                    text: text
                })
                .then(response => {
                    this.$emit("new", response.data);
                });
        },

        handler(val) {
            axios
                .post("./conversation/send", {
                    contact_id: this.contact.id,
                    image: val
                })
                .then(response => {
                    // console.log('up', response)
                    this.$emit("new", response.data);
                });
        },

        inputStat(val) {
            this.inputStatus = val;
            this.$emit("input", this.inputStatus);
            // console.log("stat", this.inputStatus);
        },

        onImgError() {
            this.imgError = true;
        }
    },

    computed: {
        filename() {
            return this.imgError
                ? "'images/profile/' + contact.profile_image"
                : "images/howsit2.png";
        }
    },

    watch: {
        contact: {
            handler(val) {
                this.selectedContact = val.id;
                // console.log('conversation', this.selectedContact);
            },
            deep: true
        },
        input: {
            handler(val) {
                // console.log(val);
                this.inputStatus = val;
            }
        }
    },

    components: {
        MessagesFeed,
        MessagesComposer
    }
};
</script>

<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    width: 100%;
    justify-content: space-between;

    .v-card {
        width: 100%;
    }
    .header {
        border-radius: 20px;
        margin-bottom: 20px;
        box-shadow: inset 5px 3px 5px 0px #d0d0d0, inset -3px 3px 3px #f8f8f8;
    }
    h1 {
        // border-radius: 8px 30px 3px 2px;
        font-size: 15px;
        padding: 8px 20px;
        margin: 0;
        background: transparent;
        color: rgb(61, 65, 65);
    }
}
</style>
