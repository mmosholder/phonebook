import gql from 'graphql-tag';
import { Contact } from './fragments.js'

export const ADD_CONTACT = gql`
    ${Contact}
    mutation createContact($first_name: String!, $last_name: String!, $phone_number: String!, $formatted_phone_number: String!) {        
        createContact(first_name: $first_name, last_name: $last_name, phone_number: $phone_number, formatted_phone_number: $formatted_phone_number) {
            ...Contact
        }
    }
`;

export const DELETE_CONTACT = gql`
    mutation deleteContact($id: Int!) {
        deleteContact(id: $id) {
            id
        }
    }
`;