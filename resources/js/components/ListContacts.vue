<template>
    <section>
        <div class="form__group">
            <label>Search Contacts by Name or Phone Number</label>
            <input
                v-model="searchTerm"
                type="text" />
        </div>
        <template v-for="contactGrouping in computedContacts">
            <div
                v-for="contact in contactGrouping.contacts"
                :key="contact.id">
                {{ contact.first_name }}
                {{ contact.last_name }}
                {{ contact.formatted_phone_number }}
                <button
                    @click="emitDeleteContact(contact)">
                    Delete Contact
                </button>
            </div>
        </template>
    </section>
</template>

<script lang="ts">
import Vue from 'vue';
import _ from 'lodash';
import {
    SEARCH_CONTACTS,
} from '../graphql/queries';
import {
    Contact, ContactGrouping,
} from '../@types';

export default Vue.extend({
    props: {
        allContacts: {
            required: true,
            type: Array as () => Array<Contact>,
            default: null,
        },
    },

    data() {
        return {
            searchTerm: '',
            skipSearchQuery: true,
        };
    },

    computed: {
        computedContacts(): Array<ContactGrouping> {
            if (this.searchTerm.length > 2) {
                return this.sortedAndGroupedContacts(this.searchContacts);
            }
            else {
                return this.sortedAndGroupedContacts(this.allContacts);
            }
        },
    },

    watch: {
        searchTerm() {
            if (this.searchTerm.length > 2) {
                this.triggerSearchQuery();
            }
            else {
                this.skipSearchQuery = true;
            }
        },
    },

    methods: {
        sortedAndGroupedContacts(contacts: Array<Contact>) {
            let sortedContacts = _.reduce(contacts, ((accumulator, value) => {
                let lastNameLetter = value.last_name[0];

                // Look for an entry for the letter in the accumulator, otherwise create it
                if (!accumulator[lastNameLetter]) {
                    accumulator[lastNameLetter] = {
                        lastNameLetter,
                        contacts: [
                            value,
                        ],
                    };
                }
                else {
                    accumulator[lastNameLetter].contacts.push(value);
                }

                // return accumulator
                return accumulator;
            }), {});

            sortedContacts = Object.values(sortedContacts);

            // Give the contacts a sort since iteration order is not guaranteed
            return _.orderBy(sortedContacts, 'lastNameLetter');
        },

        emitDeleteContact(contact: Contact) {
            this.$emit('deleteContact', contact);
        },

        triggerSearchQuery() {
            this.skipSearchQuery = false;
        },

    },

    apollo: {
        searchContacts: {
            query: SEARCH_CONTACTS,
            variables() {
                return {
                    search_string: this.searchTerm,
                };
            },
            skip() {
                return this.skipSearchQuery;
            },
        },
    },
});
</script>