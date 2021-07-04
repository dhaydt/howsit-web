<template>
    <v-app class="composer">
        <v-footer fixed style="background-color: #ebecf0">
            <v-layout row>
                <div class="floating-div">
                    <picker
                        v-if="emoStatus"
                        set="emojione"
                        @select="onInput"
                        title="Pick your emoji…"
                    />
                </div>
                <v-flex xs12 class="d-flex justify-content-between">
                    <!-- <v-text-field
                        rows="2"
                        v-model="message"
                        @keydown.enter="send"
                        label="Enter message"
                    ></v-text-field> -->
                    <file-upload
                        :post-action="'/image/send/' + selectedCont"
                        ref="upload"
                        v-model="files"
                        @input-file="$refs.upload.active = true"
                        :headers="{ 'X-CSRF-TOKEN': token }"
                    >
                        <v-icon class="mt-3 mr-3">fa fa-paperclip</v-icon>
                    </file-upload>
                    <v-text-field
                        v-model="message"
                        row="1"
                        :prepend-icon="icon"
                        :append-icon="marker ? 'mdi-eye-off' : 'mdi-eye-off'"
                        :append-outer-icon="message ? 'mdi-send' : 'mdi-microphone'"
                        filled
                        clear-icon="mdi-close-circle"
                        clearable
                        label="Enter Message"
                        type="text"
                        @keydown.enter="send"
                        @click:append="inputStatus"
                        @click:append-outer="send"
                        @click:prepend="toggleEmo"
                        @click:clear="clearMessage"
                    ></v-text-field>
                </v-flex>

                <!-- <v-flex
                    xs1
                    class="d-flex justify-content-around"
                    style="padding-top: 10px;"
                >
                    <v-btn icon small @click="inputStatus">
                        <v-icon color="error" size="18">
                            mdi-close
                        </v-icon>
                    </v-btn>
                </v-flex> -->
            </v-layout>
        </v-footer>
    </v-app>
</template>

<script>
import { Picker } from "emoji-mart-vue";
export default {
    props: {
        contact: Number
    },
    components: {
        Picker
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
            icon:"mdi-emoticon",
        };
    },

    methods: {
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

        toggleMarker () {
        this.marker = !this.marker
      },
      sendMessage () {
        this.resetIcon()
        this.clearMessage()
      },
      clearMessage () {
        this.message = ''
      },
      resetIcon () {
        this.iconIndex = 0
      },
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
    height: 35px;
    position: absolute;
    background-color: transparent;
}
.floating-div {
    width: 353px;
    position: fixed;
    bottom: 60px;
    left: 10px;
    font-size: 15px;
    z-index: 6;
}

.file-uploads .v-icon {
    top: 5px;
    font-size: 20px;
}

.v-footer .row .d-flex {
    margin: 20px 20px 10px 20px;
    @media (max-width: 500px) {
        margin: 20px 5px 10px 5px;
    };
    @media (max-width: 350px) {
        margin: 20px 0 10px 0;
    }
}
</style>
