<template>
    <div class="chat-app">
        <v-card
            class="d-flex flex-row mb-6"
            flat
        >
            <v-card
                class="col-4"
                outlined
                tile
            >
            <ContactsList :contacts="contacts" @selected="startConversationWith"/>

            </v-card>
            <v-card
                class="pa-2"
                outlined
                tile>
            <Conversation  :input="inputStatus" :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
                </v-card>
        </v-card>
    </div>
</template>

<script>
import Conversation from './chat/Conversation'
import ContactsList from './chat/ContactList'

    export default {
        props: {
            users: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: [],
                files: [],
                inputStatus: false,
                // inputStatus: true,
            };
        },

        mounted() {
            Echo.private(`messages.${this.users.id}`)
                .listen('NewMessage', (e) => {
            console.log('chatapp', this.messages);
                    this.handleIncoming(e.message)
                });
            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                    // console.log('1', this.contacts)

                });
                // console.log('1',this.users);
        },

        methods: {
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);
                this.toggleInput();

                axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        // console.log('ps', this.messages);
                        this.selectedContact = contact;
                        // console.log('chat-method', this.messages);
                })

            },

            toggleInput(){
                if (this.selectedContact == null) {
                    this.inputStatus= false;
                }
                this.inputStatus = true;
            },

            saveNewMessage(message) {
                if (this.selectedContact == null) {
                    return alert('Please select contact');
                }
                this.messages.push(message);
            },

            handleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    console.log('handle', this.messages);
                    return;

                }


                this.updateUnreadCount(message.from_contact, false);
            },

            updateUnreadCount(contact, reset) {
                this.contact = this.contacts.map((single) => {
                    if(single.id != contact.id) {
                        return single;
                    }

                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;

                    return single;
                })
            }
        },

        components: {
            Conversation,
            ContactsList
        }
    }
</script>

<style lang="scss" scoped>
.chat-app {
    min-height: 100vh;
}

.conversation {
    transition: all 3s ease;
}

</style>
