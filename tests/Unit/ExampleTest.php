<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    // /**
    //  * A test for user found by ID
    //  */
    // public function testQueriesUser(): void
    // {
    //     $response = $this->graphQL('
    //         mutation ($id: ID!) {
    //             createPost(title: $id) {
    //                 id
    //                 email
    //                 first_name
    //             }
    //         }
    //     ', [
    //         'ID' => 1
    //     ])->assertJson([
    //     "data" => [
    //             "user" => [
    //                 "email" => "thibaudmaitre@gmail.com", 
    //                 "first_name" => "Howell", 
    //                 "last_name" => "Ankunding" 
    //             ] 
    //         ] 
    //     ]);
    // }


    public function testQueriesPosts(): void
    {
        $response = $this->graphQL(/** @lang GraphQL */ '
        {
            users(first: 10, page: 10) {
                data {
                    id
                }
            }
        }
        ');
    }
}
