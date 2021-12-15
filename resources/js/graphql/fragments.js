import gql from 'graphql-tag';

export const Contact = gql`
    fragment Contact on Contact {
        id
        first_name
        last_name
        phone_number
        formatted_phone_number
    }
`;