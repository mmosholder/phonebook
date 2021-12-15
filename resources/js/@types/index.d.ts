export interface Contact {
    id: number
    first_name: string
    last_name: string
    phone_number: string
    formatted_phone_number: string
}

export interface ContactGrouping {
    lastNameLetter: string,
    contacts: Array<Contact>
}