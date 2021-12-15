<template>
    <section>
        <h2>Add A New Contact</h2>
        <form @submit.prevent="handleSubmission">
            <div class="form__group">
                <label>First Name</label>
                <input
                    v-model="firstName"
                    type="text"
                    placholder="First Name"
                    required />
            </div>
            <div class="form__group">
                <label>Last Name</label>
                <input
                    v-model="lastName"
                    type="text"
                    placholder="Last Name"
                    required />
            </div>
            <div class="form__group">
                <label>Phone Number</label>
                <vue-tel-input
                    v-model="phoneNumberDisplay"
                    auto-format
                    valid-characters-only
                    :input-options="{
                        required: true
                    }"
                    @validate="setPhoneNumberProperties"
                    @blur="setValidationClasses" />
            </div>
            <button
                :disabled="submitDisabled"
                type="submit"
                @submit.prevent="handleSubmission">
                Add New Contact
            </button>
        </form>
    </section>
</template>

<script lang="ts">
import Vue from 'vue';
import {
    ALL_CONTACTS,
} from '../graphql/queries';
import {
    ADD_CONTACT,
} from '../graphql/mutations';

export default Vue.extend({

    data() {
        return {
            firstName: null,
            lastName: null,
            phoneNumberDisplay: null,
            phoneNumberRaw: null,
            phoneNumberIsValid: false,
        };
    },

    computed: {
        submitDisabled(): boolean {
            return !this.firstName || !this.lastName || !this.phoneNumberIsValid;
        },
    },

    methods: {
        setPhoneNumberProperties(payload) {
            this.phoneNumberIsValid = payload.valid;
            this.phoneNumberRaw = payload.number;
        },

        setValidationClasses() {
        },

        handleSubmission() {
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
                    this.firstName = null;
                    this.lastName = null;
                })
                .catch(e => {
                    console.warn(e);
                });
        },
    },
});
</script>