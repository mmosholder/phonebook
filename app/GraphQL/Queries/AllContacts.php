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

class AllContacts extends Query
{
    protected $attributes = [
        'name' => 'allContacts',
        'description' => 'A query'
    ];

    public function type(): \GraphQL\Type\Definition\Type
    {
        return Type::listOf(GraphQL::type('Contact'));
    }

    public function args(): array
    {
        return [

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Contact::all();
    }
}
