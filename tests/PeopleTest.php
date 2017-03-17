<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PeopleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testArePeopleGettingSaved()
    {
    	// Sample input data
        $sample = [
            "data" => [
                [
                    "first_name" => "matt",
                    "last_name" => "stauffer",
                    "age" => 36,
                    "email" => "matt@stauffer.com",
                    "secret" => "VXNlIHRoaXMgc2VjcmV0IHBocmFzZSBzb21ld2hlcmUgaW4geW91ciBjb2RlJ3MgY29tbWVudHM="
                ],
                [
                    "first_name" => "guru",
                    "last_name" => "chaturvedi",
                    "age" => 38,
                    "email" => "guru4vedi@gmail.com",
                    "secret" => "VXNlIHRoaXMgc2VjcmV0IHBocmFzZSBzb21ld2hlcmUgaW4geW91ciBjb2RlJ3MgY29tbWVudHM="
                ],
                [
                    "first_name" => "dan",
                    "last_name" => "sheetz",
                    "age" => 35,
                    "email" => "dan@sheetz.com",
                    "secret" => "YWxidXF1ZXJxdWUuIHNub3JrZWwu"
                ]
            ]
        ];

        $this->json('POST', '/people', $sample)
                     ->seeJson([
                         'success' => true,
                         'count' => count($sample['data'])
                     ]);
    }
}
