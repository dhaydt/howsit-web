<template>
    <div class="composer">


        <v-footer height="auto" fixed color="grey">
            <v-layout row>
                <div class="floating-div">
                    <picker v-if="emoStatus" set="emojione" @select="onInput" title="Pick your emoji…" />
                </div>
                <v-flex class="ml-2 text-right" xs2>
                    <v-btn @click="toggleEmo"
                    fab dark small color="pink">
                        <v-icon>fa fa-smile-o </v-icon>
                    </v-btn>
                </v-flex>

                <v-flex xs1 class="text-center">
                    <file-upload
                            :post-action="'/image/send/'+selectedCont"
                            ref='upload'
                            v-model="files"

                            @input-file="$refs.upload.active = true"
                            :headers="{'X-CSRF-TOKEN': token}"
                    >
                        <v-icon class="mt-3 mr-3">fa fa-paperclip</v-icon>
                    </file-upload>

                </v-flex>

                <v-flex xs6>
                    <v-text-field
                        rows=2
                        v-model="message"
                        @keydown.enter="send"
                        label="Enter message"
                    ></v-text-field>
                </v-flex>

                <v-flex xs3>
                    <v-btn class="mt-3 ml-2 black--text" small color="yellow" @click="send">send</v-btn>
                </v-flex>
            </v-layout>
        </v-footer>
    </div>
</template>

<script>
    import Vuetify from 'vuetify'
    import Vue from 'vue'
    import 'vuetify/dist/vuetify.min.css'
    Vue.use(Vuetify)

    import { Picker } from 'emoji-mart-vue'
    export default {
        props:{
            contact: Number,
        },
        components: {
            Picker,
        },

        data() {
            return {
                message: '',
                selectedCont: null,
                files:[],
                emoStatus:false,
                token:document.head.querySelector('meta[name="csrf-token"]').content
            };
        },

        methods: {
            send(e) {
                e.preventDefault();

                if (this.message == '') {
                    return alert('Please enter message');
                }

                console.log('send', this.message)
                this.$emit('send', this.message);
                this.message = '';
            },

            toggleEmo(){
                this.emoStatus= !this.emoStatus;
            },

            onInput(e){
                if(!e){
                return false;
                }
                if(!this.message){
                this.message=e.native;
                }else{
                this.message=this.message + e.native;
                }
                this.emoStatus=false;
            },
        },

        watch: {
            contact: {
                deep: true,
                    handler (val) {
                        this.selectedCont = val;
                        // console.log('composer', this.selectedCont);
                    },
            },
            files:{
                deep:true,
                    handler(){
                        let success=this.files[0].success;
                        if(success){

                            // console.log('file', this.files[0].response.image);
                            this.$emit('store', this.files[0].response.image);
                        }
                    }
            },

            '$refs.upload'(val){
                this.files = val;
                // console.log('ref', this.files[0].success);
            }
        }
    }
</script>

<style lang="scss" scoped>
.floating-div {
    width: 353px;
    position: fixed;
    bottom: 60px;
    left: 10px;
    font-size: 15px;
    z-index: 6;
}
</style>
