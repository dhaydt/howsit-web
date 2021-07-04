<template>
    <div class="contacts-list">
        <v-list subheader>
            <v-list-item
                v-for="contact in sortedContact"
                :key="contact.id"
                @click="selectContact(contact)"
                v-scroll:#scroll-target="onScroll"
                class="p-0"
            >
                <span class="unread" v-if="contact.unread">{{
                    contact.unread
                }}</span>
                <v-list-item-avatar class="me-2">
                    <img :src="'images/profile/' + contact.profile_image" />
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title
                        v-html="contact.name"
                    ></v-list-item-title>
                </v-list-item-content>
                <v-list-item-action>
                    <v-icon>mdi-chat</v-icon>
                </v-list-item-action>
            </v-list-item>
        </v-list>
    </div>
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

        onScroll(e) {
            this.offsetTop = e.target.scrollTop;
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
    font-size: 20px;
}

.hover-in-shadow::after {
    border-radius: 30px;
}

.scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
    background-color: #ebecf0;
}

span.unread {
    background: #82e0a8;
    color: #fff;
    position: absolute;
    right: 11px;
    top: 20px;
    display: flex;
    font-weight: 700;
    min-width: 20px;
    justify-content: center;
    align-items: center;
    line-height: 20px;
    font-size: 12px;
    padding: 0 4px;
    border-radius: 3px;
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
