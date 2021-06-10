<template>
    <div class="contacts-list d-block">
            <!-- <div class="title-dropdown">
                <a type="button" class="btn dropdown-toggle hover-in-shadow outer-shadow" data-toggle="dropdown">
                    Select Contact
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu scrollable-menu" role="menu">
                    <li class="dropdown-item outer-shadow hover-in-shadow" v-for="(contact) in sortedContact" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
                        <div class="avatar">
                            <img class="rounded-circle" style="height: 30px; width: 30px;" :src="'images/profile/'+contact.profile_image" alt="contact.name">
                        </div>

                        <div class="user-info">
                            <p class="name">{{ contact.name }}</p>
                        </div>
                        <span class="unread" v-if="contact.unread">{{ contact.unread}}</span>
                    </li>
                </ul>
            </div> -->
        <v-layout row>
            <v-flex>
            <v-card>
                <v-toolbar color="yellow accent-3" style="margin-top: -5px !important;">
                    <v-toolbar-title style="margin-left: -10px !important;">Select Contact</v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-btn icon>
                        <v-icon>fas fa-search</v-icon>
                    </v-btn>

                </v-toolbar>

                <v-list
                    id="scroll-target"
                    style="max-height: 80vh;"
                    class="scroll-y">
                    <v-list-tile
                        v-for="(contact) in sortedContact"
                        :key="contact.id"
                        @click="selectContact(contact)"
                        v-scroll:#scroll-target="onScroll">

                        <v-list-tile-content>
                            <v-list-tile-title v-text="contact.name"></v-list-tile-title>
                        </v-list-tile-content>

                        <v-list-tile-avatar>
                            <img :src="'images/profile/'+contact.profile_image">
                        </v-list-tile-avatar>
                        <span class="unread" v-if="contact.unread">{{ contact.unread}}</span>
                        <v-divider v-if="contact.id"></v-divider>
                    </v-list-tile>

                </v-list>
            </v-card>
            </v-flex>
        </v-layout>


    </div>
</template>

<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: [],
            }
        },

        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null,
                contact: { divider: true, inset: true },
            };

        },

        methods: {
            selectContact(contact) {
                this.selected = contact;
                this.$emit('selected', contact);
            },

            onScroll (e) {
                this.offsetTop = e.target.scrollTop
            }
        },

        computed: {
            sortedContact() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }
                    return contact.unread;
                }]).reverse();
            }
        }
    }
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
    border-color: rgba(0,0,0,.12);
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

.dropdown-toggle {
    width: 100%;
    border-radius: 30px;
    font-weight: 600;
    color: #666;
}

.dropdown-toggle:hover {
    color: #a4a2a2;
}

.dropdown-toggle::after {
    border: none;
}

.dropdown-menu {
    top: -5px;
    width: 100%;
    height: 80vh;
}

.scrollable-menu {
    max-height: none;
}

.dropdown-item {
    display: flex;
    cursor: pointer;
    border-radius: 10px;
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
    background-color: #114244;}
.contacts-list {
    flex: 2;
    margin-bottom: 20px;
}
</style>
