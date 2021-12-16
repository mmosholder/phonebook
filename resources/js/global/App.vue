<template>
    <main class="container">
        <AddContact
            v-if="allContacts"
            :has-contacts="allContacts.length > 0" />
        <ListContacts
            v-if="allContacts"
            :all-contacts="allContacts"
            @deleteContact="deleteContact" />
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
        /**
         * Deletes a contact. Triggered from a contact inside ListContacts
         */
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