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

class DeleteContact extends Mutation
{
    protected $attributes = [
        'name' => 'deleteContact',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Contact');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $contact = Contact::find($args['id']);

        $contact->delete();

        return $contact;
    }
}
