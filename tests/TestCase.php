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
}
