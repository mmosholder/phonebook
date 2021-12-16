<template>
    <section class="contact__list">
        <h2>Your Contacts</h2>
        <div
            v-if="allContacts.length > 0"
            class="form__group">
            <label>Search Contacts</label>
            <input
                v-model="searchTerm"
                placeholder="Search by Name or Phone Number"
                class="underline"
                type="text" />
            <span
                :disabled="searchTerm.length < 2"
                class="form__group__clear"
                @click="searchTerm = ''">Clear Search</span>
        </div>
        <div class="contact__list__container flex">
            <card-wrapper v-if="allContacts.length > 0">
                <div class="contact__list__wrapper">
                    <template v-for="contactGrouping in computedContacts">
                        <section
                            :id="`#${contactGrouping.lastNameLetter}`"
                            :key="contactGrouping.lastNameLetter">
                            <div
                                v-for="contact in contactGrouping.contacts"
                                :key="contact.id"
                                class="contact__list__row">
                                <span>{{ contact.first_name }} {{ contact.last_name }}</span>
                                <span>{{ contact.formatted_phone_number }}</span>
                                <button
                                    class="button button__hollow"
                                    @click="emitDeleteContact(contact)">
                                    Delete
                                </button>
                            </div>
                        </section>
                    </template>
                </div>
            </card-wrapper>
            <card-wrapper v-else></card-wrapper>
            <alphabet-scroll
                :contacts="computedContacts"
                :active-letter="activeLetter"
                @letterSelection="scrollToLetter"></alphabet-scroll>
        </div>
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
} from '../@types/index';
import CardWrapper from './CardWrapper.vue';
import AlphabetScroll from './AlphabetScroll.vue';

export default Vue.extend({
    props: {
        allContacts: {
            required: true,
            type: Array as () => Array<Contact>,
            default: null,
        },
    },

    components: {
        CardWrapper,
        AlphabetScroll,
    },

    data() {
        return {
            searchTerm: '',
            skipSearchQuery: true,
            activeLetter: null,
        };
    },

    computed: {
        computedContacts(): Array<ContactGrouping> {
            if (this.searchTerm.length > 1) {
                return this.sortedAndGroupedContacts(this.searchContacts);
            }
            else {
                return this.sortedAndGroupedContacts(this.allContacts);
            }
        },
    },

    watch: {
        searchTerm() {
            if (this.searchTerm.length > 1) {
                this.triggerSearchQuery();
            }
            else {
                this.skipSearchQuery = true;
            }
        },
    },

    methods: {
        /**
         * Groups contacts by first letter of last night and then alphabetically sorts
         * @param {Array<Contact>} contacts
         */
        sortedAndGroupedContacts(contacts: Array<Contact>) {
            let sortedContacts = _.reduce(contacts, ((accumulator, value) => {
                let lastNameLetter = value.last_name[0].toLowerCase();

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

        /**
        * Scrolls names from contact list by letter clicked into view
        * @param {string} letter
        */
        scrollToLetter(letter: string) {
            const letterSection = document.getElementById(`#${letter}`);
            this.activeLetter = letter;

            if (letterSection) {
                letterSection.scrollIntoView();
            }
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