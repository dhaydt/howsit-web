<template>
    <div class="conversation">
        <div class="header inner-shadow">
            <div class="avatar">
                <!-- <img class="rounded-circle" style="height: 30px; width: 30px;" :src="'images/profile/'+contact ? contact.profile_image : 'Howsit Messenger'" alt="contact.name"> -->
            </div>
            <h1>{{ contact ? contact.name : 'Howsit Messenger' }}</h1>
        </div>
        <MessagesFeed :contact="contact" :messages="messages"></MessagesFeed>
        <MessagesComposer v-if="input" :contact="selectedContact" @send="sendMessage" @store="handler"></MessagesComposer>
    </div>
</template>

<script>
    import MessagesFeed from "./MessagesFeed"
    import MessagesComposer from "./MessagesComposer"
    export default {
        props: {
            contact: {
                type: Object,
                default: null,
            },
            messages: {
                type: Array,
                default: [],
            },
            input: {
                type: Boolean,
                default: false
            }
        },
        data(){
            return{
                selectedContact: null,
                files:[],
                inputStatus: false,

            }
        },


        mounted() {


        },

        methods: {
            sendMessage(text) {
                if (!this.contact) {
                    return;
                }

                    console.log('res', text);
                axios.post('./conversation/send', {
                    contact_id: this.contact.id,
                    text: text
                }). then((response) => {
                    this.$emit('new', response.data);
                })
            },

            handler(val){
                axios.post('./conversation/send', {
                    contact_id: this.contact.id,
                    image: val
                }). then ((response) => {
                    // console.log('up', response)
                    this.$emit('new', response.data);
                })
            }
        },

        watch: {
            contact: {
                    handler (val) {
                        this.selectedContact = val.id;
                        // console.log('conversation', this.selectedContact);
                    },
                    deep: true,

            },
            input: {
                handler(val) {
                    console.log(val)
                    this.inputStatus = val;
                }
            }

        },

        components: {
            MessagesFeed,
            MessagesComposer
        }
    }
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
