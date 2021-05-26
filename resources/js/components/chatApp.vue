<template>
    <div class="chat-app">
            <ContactsList :contacts="contacts" @selected="startConversationWith"/>
            <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
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
            };
        },

        mounted() {
            // console.log('chatapp',this.users);
            Echo.private(`messages.${this.users.id}`)
                .listen('NewMessage', (e) => {
                    this.handleIncoming(e.message)
                });
            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                    // console.log('1', this.contacts)

                });
                console.log('1',this.users);
        },

        methods: {
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);

                axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        console.log('ps', this.messages);
                        this.selectedContact = contact;
                })
            },

            saveNewMessage(message) {
                this.messages.push(message);
            },

            handleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
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
    background-color: #ebecf0;
}

</style>
