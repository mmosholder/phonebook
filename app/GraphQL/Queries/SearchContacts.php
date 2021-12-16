<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use GraphQL;
use Closure;
use App\Models\Contact;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class SearchContacts extends Query
{
    protected $attributes = [
        'name' => 'searchContacts',
        'description' => 'A query to search contacts by name or phone number'
    ];

    public function type(): \GraphQL\Type\Definition\Type
    {
        return Type::listOf(GraphQL::type('Contact'));
    }

    public function args(): array
    {
        return [
            'search_string' => [
                'name' => 'search_string',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $contacts = Contact::where('first_name', 'like', '%' . $args['search_string'] . '%')->orWhere('last_name', 'like', '%' . $args['search_string'] . '%')->orWhere('formatted_phone_number', 'like', '%' . $args['search_string'] . '%')->get();

        return $contacts;
    }
}
