<?php 


use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ParticipantType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Participant',
        'description' => 'A competitor of the WRC championship',
        'model' => \App\Models\Participant::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the participant'
            ],
            'first_name' => [
                'type' => Type::string(),
                'description' => 'The first name of the participant'
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'The last name of the participant'
            ],
            'birthday' => [
                'type' => Type::string(),
                'description' => 'The birthday of the participant'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The date the participant was created',
                'resolve' => function($model) {
                    return $model->created_at->toDateTimeString();
                }
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The date the participant was last updated',
                'resolve' => function($model) {
                    return $model->updated_at->toDateTimeString();
                }
            ]
        ];
    }
}