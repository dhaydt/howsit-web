<template>
    <div class="conversation">
        <v-card flat>
            <v-toolbar flat>
                <v-list-item-avatar style="margin: 0 15px;">
                    <v-img :src="filename" @error="onImgError()"></v-img>
                </v-list-item-avatar>
                <v-toolbar-title style="text-transform: capitalize;">{{
                    contact ? contact.name : "Howsit Messenger"
                }}</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider class="m-0"></v-divider>
            <v-container fluid>
                <v-row dense>
                    <v-card
                        min-height="77vh"
                        max-height="77vh"
                        style="overflow-y: scroll;"
                        flat
                    >
                        <MessagesFeed
                            :contact="contact"
                            :messages="messages"
                        ></MessagesFeed>
                    </v-card>

                    <MessagesComposer
                        v-if="input"
                        :contact="selectedContact"
                        @send="sendMessage"
                        @store="handler"
                        @inputStatus="inputStat"
                    ></MessagesComposer>
                </v-row>
            </v-container>
        </v-card>
    </div>
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
