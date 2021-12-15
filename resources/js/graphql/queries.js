import gql from 'graphql-tag';
import { Contact } from './fragments';

export const ALL_CONTACTS = gql`
    ${Contact}
    query allContacts {
        allContacts {
            ...Contact
        }
    }
`;

export const SEARCH_CONTACTS = gql`
    query searchContacts($search_string: String!) {
        searchContacts(search_string: $search_string) {
            id
            first_name
            last_name
            phone_number
            formatted_phone_number
        }
    }
`;