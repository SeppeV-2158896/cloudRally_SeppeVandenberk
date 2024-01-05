<?php

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ParticipantsQuery extends Query
{
    protected $attributes = [
        'name' => 'participants'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('participant'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::string()
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => Type::string()
            ],
            'birthday' => [
                'name' => 'birthday',
                'type' => Type::string()
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return App\Models\Participant::where('id', $args['id'])->get();
        }

        if (isset($args['first_name'])) {
            return App\Models\Participant::where('first_name', $args['first_name'])->get();
        }

        if (isset($args['last_name'])) {
            return App\Models\Participant::where('last_name', $args['last_name'])->get();
        }

        if (isset($args['birthday'])) {
            return App\Models\Participant::where('birthday', $args['birthday'])->get();
        }

        return App\Models\Participant::all();
    }
}
