<template>
    <div class="chat-app-home">
        <v-main>
            <v-row class="mb-6" no-gutters>
                <v-col>
                    <v-card class="pa-2 mx-auto" flat>
                        <v-app-bar flat>
                            <v-toolbar-title class="title-chat"
                                >Contact</v-toolbar-title
                            >

                            <v-spacer></v-spacer>

                            <v-btn icon>
                                <v-icon>fas fa-address-book</v-icon>
                            </v-btn>
                        </v-app-bar>
                        <v-divider class="m-1"></v-divider>
                        <v-container fluid class="p-0">
                            <ContactsList
                                :contacts="contacts"
                                @selected="startConversationWith"
                            />
                        </v-container>
                    </v-card>
                </v-col>
            </v-row>
            <v-row>
                <v-footer
                    fixed
                    v-if="inputStatus"
                    class="pb-0"
                    style="bottom: 1%; width: 330px; left: 3%"
                >
                    <v-col sm="3" justify="center" style="min-width: 330px;">
                        <v-expansion-panels accordion :model="panel">
                            <v-expansion-panel>
                                <v-expansion-panel-header
                                    class="p-2 d-flex justify-content-between"
                                >
                                    <v-avatar
                                        size="25"
                                        style="max-width: 25px;"
                                    >
                                        <img
                                            :src="
                                                '/images/profile/' +
                                                    selectedContact.profile_image
                                            "
                                            alt=""
                                        />
                                    </v-avatar>
                                    <span
                                        style="margin-right: auto; text-transform: capitalize;"
                                    >
                                        {{ selectedContact.name }}</span
                                    ><v-btn
                                        class="me-2"
                                        text
                                        icon
                                        color="red lighten-2"
                                        max-width="20"
                                        max-height="20"
                                        @click="closeInput"
                                    >
                                        <v-icon>mdi-close-circle</v-icon>
                                    </v-btn>
                                </v-expansion-panel-header>

                                <v-divider class="m-1"></v-divider>
                                <v-expansion-panel-content
                                    style="height: 70vh;"
                                >
                                    <v-container fluid fill-height class="p-0">
                                        <Conversation
                                            :input="inputStatus"
                                            :contact="selectedContact"
                                            :messages="messages"
                                            @new="saveNewMessage"
                                            @input="inputChange"
                                        />
                                    </v-container>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-col>
                </v-footer>
            </v-row>
        </v-main>
    </div>
</template>

<script>
import Conversation from "./chat-component/Conversation";
import ContactsList from "./chat-component/ContactList";

export default {
    props: {
        users: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            selectedContact: [],
            messages: [],
            contacts: [],
            files: [],
            panel: [0],
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
            console.log(this.inputStatus);
        },

        inputChange(val) {
            this.inputStatus = val;
        },

        closeInput() {
            this.inputStatus = !this.inputStatus;
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
.v-card {
    background-color: #f0f2f5;
}

.v-card > :first-child:not(.v-btn):not(.v-chip) {
    background-color: #f0f2f5;
    height: 50px !important;

    .v-icon {
        font-size: 17px;
    }
}

.v-card:first-child::v-deep .title-chat {
    font-size: 17px;
    font-weight: 600;
    color: #65676b;
    letter-spacing: 1px;
}

.col .v-card .container {
    overflow: scroll;
    max-height: 80vh;
    max-width: 100%;
}

.v-footer {
    background-color: transparent;
    justify-content: flex-end;
}

.v-footer .col .v-expansion-panels {
    border-radius: 10px 10px 0 0;
}

.v-footer .col .v-expansion-panel-header {
    min-height: 5px;
}

@media screen and (max-width: 575px) {
    .col .v-card .container {
        min-height: 30vh;
        overflow: scroll;
    }
}
</style>
