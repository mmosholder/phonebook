<template>
    <section class="contact__add">
        <h1 v-if="!hasContacts">Add a contact to get started</h1>
        <card-wrapper>
            <h2
                v-if="!hasContacts"
                class="card__title">
                New Contact Info
            </h2>
            <h2
                v-else
                class="card__title">
                Add a Contact
            </h2>
            <form
                v-if="!submissionMessage"
                class="form"
                @submit.prevent="handleSubmission">
                <div class="form__group">
                    <label>First Name*</label>
                    <input
                        v-model="firstName"
                        type="text"
                        placholder="First Name"
                        required />
                </div>
                <div class="form__group">
                    <label>Last Name*</label>
                    <input
                        v-model="lastName"
                        type="text"
                        placholder="Last Name"
                        required />
                </div>
                <div class="form__group">
                    <label>Phone Number*</label>
                    <vue-tel-input
                        v-model="phoneNumberDisplay"
                        auto-format
                        valid-characters-only
                        :input-options="{
                            required: true
                        }"
                        @validate="setPhoneNumberProperties"
                        @blur="setValidationClasses" />
                    <span class="form__group__helper">Valid phone numbers only, no fake ones!</span>
                </div>
                <div
                    class="button button__main"
                    :disabled="submitDisabled">
                    <button
                        :disabled="submitDisabled"
                        type="submit"
                        @submit.prevent="handleSubmission">
                        Add Contact
                    </button>
                </div>
            </form>

            <div
                v-if="submissionMessage"
                :class="['contact__add__message', error ? '-error' : '']">
                <p>{{ submissionMessage }}</p>
            </div>
        </card-wrapper>
    </section>
</template>

<script lang="ts">
import Vue from 'vue';
import CardWrapper from './CardWrapper.vue';
import {
    ALL_CONTACTS,
} from '../graphql/queries';
import {
    ADD_CONTACT,
} from '../graphql/mutations';

export default Vue.extend({
    components: {
        CardWrapper,
    },

    props: {
        hasContacts: {
            type: Boolean,
            required: true,
        },
    },

    data() {
        return {
            firstName: null,
            lastName: null,
            phoneNumberDisplay: '',
            phoneNumberRaw: '',
            phoneNumberIsValid: false,
            error: false,
            submissionMessage: null,
            submitting: false,
        };
    },

    computed: {
        submitDisabled(): boolean {
            return !this.firstName || !this.lastName || !this.phoneNumberIsValid || this.submitting;
        },
    },

    methods: {
        /**
         * Takes values from even on vue-tel-input and sets the values I need.
         */
        setPhoneNumberProperties(payload) {
            this.phoneNumberIsValid = payload.valid;
            this.phoneNumberRaw = payload.number;
        },

        /**
         * Submits mutation to create a new contact
         */
        handleSubmission() {
            this.submitting = true;

            this.$apollo.mutate({
                mutation: ADD_CONTACT,
                variables: {
                    first_name: this.firstName,
                    last_name: this.lastName,
                    phone_number: this.phoneNumberRaw,
                    formatted_phone_number: this.phoneNumberDisplay,
                },
                update: (cache, {
                    data: {
                        createContact,
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
                            allContacts: allContacts.concat(createContact),
                        },
                    });
                },
            })
                .then(() => {
                    // Set a very rudimentally success state and message, then clear it out after 5sec
                    this.submissionMessage = '💣 Boom, new contact added to your list!';
                    this.submitting = false;

                    setTimeout(() => {
                        this.submissionMessage = null;
                    }, 5000);

                    // Reset form values
                    this.$nextTick(() => {
                        this.firstName = null;
                        this.lastName = null;
                        this.phoneNumberDisplay = '';
                        this.phoneNumberRaw = '';
                    });

                })
                .catch(e => {
                    // Set a very rudimentally error state and message, then clear it out after 5sec
                    this.submitting = false;
                    this.error = true;
                    this.submissionMessage = '😬 Yikes, there was an error we definitely did not prepare for.';

                    setTimeout(() => {
                        this.submissionMessage = null;
                        this.error = false;
                    }, 5000);

                    console.warn(e);
                });
        },
    },
});
</script>