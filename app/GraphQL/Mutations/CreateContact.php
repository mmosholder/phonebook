<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use GraphQL;
use Closure;
use App\Models\Contact;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateContact extends Mutation
{
    protected $attributes = [
        'name' => 'createContact',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Contact');
    }

    public function args(): array
    {
        return [
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'phone_number' => [
                'name' => 'phone_number',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'formatted_phone_number' => [
                'name' => 'formatted_phone_number',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {        
        $contact = Contact::create(array_filter($args));

        return $contact;        
    }
}
