<template>
    <div class="composer">
        <v-footer
            absolute
            class="p-0"
            style="bottom: -20%; backgorund-color: #fff; height: 60px"
        >
            <v-layout row>
                <v-flex
                    xs12
                    class="d-flex justify-content-evenly align-items-center"
                >
                    <v-text-field
                        v-model="message"
                        :append-icon="message ? 'mdi-send' : 'mdi-keyboard'"
                        clear-icon="mdi-close-circle"
                        clearable
                        solo
                        label="Enter Message"
                        type="text"
                        style="max-width: 80%; "
                        @keydown.enter="send"
                        @click:append="send"
                        @click:clear="clearMessage"
                    ></v-text-field>

                    <v-btn icon color="pink" @click="toogleDialogEmoji">
                        <v-icon>mdi-emoticon</v-icon>
                    </v-btn>

                    <VEmojiPicker
                        v-show="showDialog"
                        style="width: 330px; font-size: 15px; height: 450px; left: 20%; bottom: 70%; position: absolute; overflow-y: scroll;"
                        labelSearch="Search"
                        lang="pt-BR"
                        @select="onSelectEmoji"
                    />

                    <file-upload
                        class="ps-2"
                        :post-action="'/image/send/' + selectedCont"
                        ref="upload"
                        v-model="files"
                        @input-file="$refs.upload.active = true"
                        :headers="{ 'X-CSRF-TOKEN': token }"
                    >
                        <v-icon class="mt-3 mr-3">fa fa-paperclip</v-icon>
                    </file-upload>
                </v-flex>
            </v-layout>
        </v-footer>
    </div>
</template>

<script>
import { Picker } from "emoji-mart-vue";

import { VEmojiPicker, emojisDefault, categoriesDefault } from "v-emoji-picker";

export default {
    props: {
        contact: Number
    },
    components: {
        Picker,
        VEmojiPicker
    },

    data() {
        return {
            message: "",
            selectedCont: null,
            files: [],
            input: true,
            emoStatus: false,
            token: document.head.querySelector('meta[name="csrf-token"]')
                .content,

            password: "Password",
            show: false,
            marker: true,
            iconIndex: 0,
            icon: "mdi-emoticon",
            showDialog: false
        };
    },
    mounted() {
        console.log(categoriesDefault);
        console.log("Total emojis:", emojisDefault.length);
    },

    methods: {
        toogleDialogEmoji() {
            console.log("Toogle!");
            this.showDialog = !this.showDialog;
        },
        onSelectEmoji(emoji) {
            this.message += emoji.data;
            this.showDialog = false;
            // Optional
            // this.toogleDialogEmoji();
        },
        inputStatus() {
            this.input = !this.input;
            console.log("inp", this.input);
            this.$emit("inputStatus", this.input);
        },

        send(e) {
            e.preventDefault();

            if (this.message == "") {
                return alert("Please enter message");
            }

            console.log("send", this.message);
            this.$emit("send", this.message);
            this.message = "";
        },

        toggleEmo() {
            this.emoStatus = !this.emoStatus;
        },

        onInput(e) {
            if (!e) {
                return false;
            }
            if (!this.message) {
                this.message = e.native;
            } else {
                this.message = this.message + e.native;
            }
            this.emoStatus = false;
        },

        toggleMarker() {
            this.marker = !this.marker;
        },
        sendMessage() {
            this.resetIcon();
            this.clearMessage();
        },
        clearMessage() {
            this.message = "";
        },
        resetIcon() {
            this.iconIndex = 0;
        }
    },

    watch: {
        contact: {
            deep: true,
            handler(val) {
                this.selectedCont = val;
                // console.log('composer', this.selectedCont);
            }
        },
        files: {
            deep: true,
            handler() {
                let success = this.files[0].success;
                if (success) {
                    // console.log('file', this.files[0].response.image);
                    this.$emit("store", this.files[0].response.image);
                }
            }
        },

        "$refs.upload"(val) {
            this.files = val;
            // console.log('ref', this.files[0].success);
        }
    }
};
</script>

<style lang="scss" scoped>
.composer {
    background-color: transparent;
}

.file-uploads .v-icon {
    font-size: 18px;
}

.v-footer .row .d-flex {
    // margin: 20px 20px 10px 20px;
    @media (max-width: 500px) {
        // margin: 20px 5px 10px 5px;
    }
    @media (max-width: 350px) {
        // margin: 20px 0 10px 0;
    }
}
</style>
