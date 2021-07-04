<template>
    <div class="chat-app">
        <v-main>
            <v-row class="mb-6" no-gutters>
                <v-col sm="3">
                    <v-card class="pa-2 mx-auto" outlined tile>
                        <v-app-bar flat>
                            <v-toolbar-title>Messenger</v-toolbar-title>

                            <v-spacer></v-spacer>

                            <v-btn icon>
                                <v-icon>fas fa-video</v-icon>
                            </v-btn>
                        </v-app-bar>

                        <v-container>
                            <ContactsList
                                :contacts="contacts"
                                @selected="startConversationWith"
                            />
                        </v-container>
                    </v-card>
                </v-col>
                <v-col class="sm-9">
                    <v-card class="pa-2" outlined tile>
                        <Conversation
                            :input="inputStatus"
                            :contact="selectedContact"
                            :messages="messages"
                            @new="saveNewMessage"
                            @input="inputChange"
                        />
                    </v-card>
                </v-col>
            </v-row>
        </v-main>
    </div>
</template>

<script>
import Conversation from "../chat/Conversation";
import ContactsList from "../chat/ContactList";

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
            inputStatus: false
            // inputStatus: true,
        };
    },

    mounted() {
        Echo.private(`messages.${this.users.id}`).listen("NewMessage", e => {
            console.log("chatapp", this.messages);
            this.handleIncoming(e.message);
        });
        axios.get("/contacts").then(response => {
            this.contacts = response.data;
            // console.log('1', this.contacts)
        });
        // console.log('1',this.users);
    },

    methods: {
        startConversationWith(contact) {
            this.updateUnreadCount(contact, true);
            this.toggleInput();

            axios.get(`/conversation/${contact.id}`).then(response => {
                this.messages = response.data;
                // console.log('ps', this.messages);
                this.selectedContact = contact;
                // console.log('chat-method', this.messages);
            });
        },

        toggleInput() {
            if (this.selectedContact == null) {
                this.inputStatus = false;
            }
            this.inputStatus = true;
        },

        inputChange(val) {
            this.inputStatus = val;
        },

        saveNewMessage(message) {
            if (this.selectedContact == null) {
                return alert("Please select contact");
            }
            this.messages.push(message);
        },

        handleIncoming(message) {
            if (
                this.selectedContact &&
                message.from == this.selectedContact.id
            ) {
                this.saveNewMessage(message);
                console.log("handle", this.messages);
                return;
            }

            this.updateUnreadCount(message.from_contact, false);
        },

        updateUnreadCount(contact, reset) {
            this.contact = this.contacts.map(single => {
                if (single.id != contact.id) {
                    return single;
                }

                if (reset) single.unread = 0;
                else single.unread += 1;

                return single;
            });
        }
    },

    components: {
        Conversation,
        ContactsList
    }
};
</script>

<style lang="scss" scoped>
.chat-app {
    margin-top: 50px;
}
.conversation {
    transition: all 3s ease;
}

.col .v-card .container {
    overflow: scroll;
    max-height: 80vh;
}

@media screen and (max-width: 575px) {
    .col .v-card .container {
        max-height: 30vh;
        overflow: scroll;
    }
}
</style>
