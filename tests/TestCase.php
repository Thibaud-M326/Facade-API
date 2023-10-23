<?php

namespace Tests;

use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Nuwave\Lighthouse\Testing\RefreshesSchemaCache;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use MakesGraphQLRequests;
    use RefreshesSchemaCache;

    /**
     * A GraphQL test for user found by ID
     */
    public function testQueriesUser(): void
    {
        $user = User::factory()->create();

        $response = $this->graphQL('
            query ($id: ID!) {
                user(id: $id) {
                    email
                    first_name
                    last_name
                }
            }
        ', [
            'id' => $user->id
        ])->assertJson([
            "data" => [
                    "user" => [
                        'email' => $user->email,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name
                    ]
                ]
        ]);
    }

    public function testErrorMessageQueriesUser(): void 
    {
        $user = User::factory()->create();

        $response = $this->graphQL('
            query ($id: ID!) {
                user(id: $id) {
                    notExistingField
                }
            }
        ', [
            'id' => $user->id
        ])
        ->assertGraphQLErrorMessage("Cannot query field \"notExistingField\" on type \"User\".");
    }

    public function testCreatesUser(): void 
    {
        $user = User::factory()->make();

        $response = $this->graphQL('
            mutation ($input: CreateUserInput!) {
                createUser (input: $input) {
                    email
                    first_name
                    last_name
                    phone_number
                }
            }
        ', [
            'input' => [
                'email' => $user->email,
                'password' => 'secret',
                'first_name'=> $user->first_name,
                'last_name'=> $user->last_name,
                'phone_number' => $user->phone_number,
            ]
        ])->assertJson([
            "data" => [
                    "createUser" => [
                        'email' => $user->email,
                        'first_name'=> $user->first_name,
                        'last_name'=> $user->last_name,
                        'phone_number' => $user->phone_number,
                    ]
                ]
        ]);
    }
}
