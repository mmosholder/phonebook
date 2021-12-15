<template>
    <main>
        <div class="marvel-device iphone-x">
            <div class="notch">
                <div class="camera"></div>
                <div class="speaker"></div>
            </div>
            <div class="top-bar"></div>
            <div class="sleep"></div>
            <div class="bottom-bar"></div>
            <div class="volume"></div>
            <div class="overflow">
                <div class="shadow shadow--tr"></div>
                <div class="shadow shadow--tl"></div>
                <div class="shadow shadow--br"></div>
                <div class="shadow shadow--bl"></div>
            </div>
            <div class="inner-shadow"></div>
            <div class="screen">
                <AddContact />
                <ListContacts
                    v-if="allContacts"
                    :all-contacts="allContacts"
                    @deleteContact="deleteContact" />
            </div>
        </div>
    </main>
</template>

<script>
import Vue from 'vue';
import {
    ALL_CONTACTS,
} from '../graphql/queries.js';
import {
    DELETE_CONTACT,
} from '../graphql/mutations.js';
import AddContact from '../components/AddContact.vue';
import ListContacts from '../components/ListContacts.vue';

export default Vue.extend({
    components: {
        AddContact,
        ListContacts,
    },

    data() {
        return {
            allContacts: null,
        };
    },

    methods: {
        deleteContact(payload) {
            this.$apollo.mutate({
                mutation: DELETE_CONTACT,
                variables: {
                    id: payload.id,
                },
                update: (cache, {
                    data: {
                        deleteContact,
                    },
                }) => {
                    const {
                        allContacts,
                    } = cache.readQuery({
                        query: ALL_CONTACTS,
                    });
                    cache.writeQuery({
                        query: ALL_CONTACTS,
                        data: {
                            allContacts: allContacts.filter(name => {
                                return name.id !== deleteContact.id;
                            }),
                        },
                    });
                },
            }).catch(e => {
                console.warn(e);
            });
        },
    },

    apollo: {
        allContacts: {
            query: ALL_CONTACTS,
            result({
                data,
            }) {
                this.allContacts = data.allContacts;
            },
        },
    },
});
</script>