<?php

declare(strict_types=1);

namespace App\GraphQL\Types;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ContactType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Contact',
        'description' => 'A contact'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the contact'
            ],
            'first_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The first name of the contact'
            ],
            'last_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The last name of the contact'
            ],
            'phone_number' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'A contact\'s phone number'
            ],
            'formatted_phone_number' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'How the contact\'s phone number is displayed'
            ],
        ];
    }
}
