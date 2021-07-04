<template>
    <v-app class="contacts-list">
        <v-list subheader>
            <v-list-item
                v-for="contact in sortedContact"
                :key="contact.id"
                v-scroll:#scroll-target="onScroll"
                @click="click()"
                class="p-0"
                style="background-color: #f0f2f5; min-height: fit-content; cursor:pointer;"
            >
                <span class="unread" v-if="contact.unread">{{
                    contact.unread
                }}</span>
                <v-list-item-avatar class="me-2 mt-2 mb-2" size="30">
                    <img :src="'images/profile/' + contact.profile_image" />
                </v-list-item-avatar>
                <v-list-item-content class="p-0">
                    <v-list-item-title
                        style="text-transform: capitalize; font-size: 15px; font-weight: 500;"
                        class="m-0 p-0"
                        v-html="contact.name"
                    ></v-list-item-title>
                </v-list-item-content>
                <v-tooltip top nudge-top="-8">
                    <template v-slot:activator="{ on }">
                        <v-btn
                            v-on="on"
                            @click="selectContact(contact)"
                            text
                            icon
                        >
                            <v-icon size="18">
                                mdi-message
                            </v-icon>
                        </v-btn>
                    </template>
                    <span>Chat {{ contact.name }}</span>
                </v-tooltip>

                <v-tooltip top nudge-top="-8">
                    <template v-slot:activator="{ on }">
                        <v-btn
                            v-on="on"
                            @click="placeCall(contact.id, contact.name)"
                            text
                            icon
                        >
                            <v-icon size="22">
                                mdi-video
                            </v-icon>
                        </v-btn>
                    </template>
                    <span>Call {{ contact.name }}</span>
                </v-tooltip>
            </v-list-item>
        </v-list>
    </v-app>
</template>

<script>
export default {
    props: {
        contacts: {
            type: Array,
            default: []
        }
    },

    data() {
        return {
            selected: this.contacts.length ? this.contacts[0] : null,
            contact: { divider: true, inset: true }
        };
    },

    methods: {
        selectContact(contact) {
            this.selected = contact;
            this.$emit("selected", contact);
        },

        click() {},

        onScroll(e) {
            this.offsetTop = e.target.scrollTop;
        },

        placeCall(id, name) {
            this.eventData = [id, name];
            console.log("place", this.eventData);
            this.$events.$emit("placeCall", [id, name]);
        }
    },

    computed: {
        sortedContact() {
            return _.sortBy(this.contacts, [
                contact => {
                    if (contact == this.selected) {
                        return Infinity;
                    }
                    return contact.unread;
                }
            ]).reverse();
        }
    }
};
</script>

<style lang="scss" scoped>
.v-toolbar__title {
    font-size: 18px;
}

.v-divider {
    width: 75%;
    border: solid;
    border-width: thin 0 0;
    transition: inherit;
    position: absolute;
    right: 10px;
    bottom: -10px;
    border-color: rgba(0, 0, 0, 0.12);
}

.v-icon {
    font-size: 17px;
}

.scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
    background-color: #ebecf0;
}

span.unread {
    background: #df1111;
    color: #fff;
    position: absolute;
    right: 60px;
    top: 1%;
    z-index: 2;
    font-weight: 700;
    min-width: 10px;
    justify-content: center;
    align-items: center;
    line-height: 20px;
    font-size: 10px;
    padding: 0 4px;
    border-radius: 5px 5px 0 5px;
}

.user-info {
    font-weight: 700;
    color: #666a6e;
    letter-spacing: 0.5;
    margin-left: 15px;
    text-transform: capitalize;
}

.lh {
    background-color: #114244;
}
.contacts-list {
    flex: 2;
    margin-bottom: 20px;
}
</style>
