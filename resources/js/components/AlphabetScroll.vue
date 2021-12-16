<template>
    <div class="contact__list__alphabet">
        <div
            class="flex flex-column align-center"
            aria-role="list">
            <span
                v-for="(letter, i) in alphabet"
                :key="`letter${i}`"
                aria-role="button"
                tabindex="0"
                :aria-label="`Scroll to last names starting with ${letter}`"
                :class="setLetterClasses(letter)"
                @keyup.enter="emitLetterClick(letter)"
                @click="emitLetterClick(letter)">{{ letter }}</span>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue';
import {
    ContactGrouping,
} from '../@types/index';

const alphabet = String.fromCharCode(...Array(123).keys()).slice(97).toLowerCase().split('');

export default Vue.extend({
    props: {
        contacts: {
            type: Array as () => Array<ContactGrouping>,
            required: true,
        },
        activeLetter: {
            type: String,
            default: '',
        },
    },

    data() {
        return {
            alphabet: alphabet,
        };
    },

    methods: {
        emitLetterClick(letter: string) {
            this.$emit('letterSelection', letter);
        },

        /**
         * Sets a class on the letter if it's active or inactive (no last names start with that letter)
         * @param {string} letter
         */
        setLetterClasses(letter: string): Array<string> {
            if (!this.findLetter(letter)) {
                return [
                    '-inactive',
                ];
            }
            else if (letter === this.activeLetter) {
                return [
                    '-active',
                ];
            }
            else {
                return [];
            }
        },

        /**
         * Helper function to find if letter in the alphabet matches on the first letter of last names of contacts
         * @param {string} letter
         */
        findLetter(letter: string): boolean {
            const foundLetter = this.contacts.find((item: ContactGrouping) => {
                return item.lastNameLetter === letter;
            });

            return foundLetter ? true : false;
        },
    },
});

</script>