<?php

namespace Tests\Feature\Http\Controllers\Api;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_client()
    {
        $faker = Factory::create();
        $response = $this->json('POST', '/client/add', [
            'firstname'=> $firstname = $faker->firstname,
            'othernames'=> $othernames = $faker->lastName,
            'address' => $address = $faker->address,
            'customerid'=> $customerid = $faker->uuid,
            'nationalid'=> $nationalid = $faker->ean8,
            'mobilenumber'=>$mobilenumber = $faker->phonenumber,
            'customerphoto'=> $customerphoto = $faker->image
        ]);

        $response->assertStatus(201);
        \Log::info(1, [$response->getContent()]);
        $this->assertDatabaseHas('clients',[
            'firstname'=> $firstname,
            'othernames'=> $othernames,
            'address' => $address,
            'customerid'=> $customerid,
            'nationalid'=> $nationalid,
            'mobilenumber'=>$mobilenumber,
            'customerphoto'=> $customerphoto
        ]);

        // $response = $this->json('POST', '/client/add', [
        //     'firstname'=> $firstname = $faker->firstname,
        //     'othernames'=> $othernames = $faker->lastName,
        //     'address' => $address = $faker->address,
        //     'customerid'=> $customerid = $faker->uuid,
        //     'nationalid'=> $nationalid = $faker->ean8,
        //     'customerphoto'=> $customerphoto = $faker->image
        // ]);

        // $response->assertStatus(400);

        // $response = $this->json('POST', '/client/add', [
        //     'firstname'=> $firstname = $faker->firstname,
        //     'othernames'=> $othernames = $faker->lastName,
        //     'address' => $address = $faker->address,
        //     'customerid'=> $customerid = $faker->uuid,
        //     'nationalid'=> $nationalid = $faker->ean8,
        //     'mobilenumber'=>$mobilenumber = $faker->phonenumber,
        //     'customerphoto'=> $customerphoto = $faker->image,
        //     'gender' => 'female'
        // ]);

        // $response->assertStatus(413);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_client()
    {
        $faker = Factory::create();
        $response = $this->json('PUT', '/client/update/1', [
            'firstname'=> $firstname = $faker->firstname.'_updated',
            'othernames'=> $othernames = $faker->lastName.'_updated',
            'address' => $address = $faker->address.'_updated',
        ]);

        $response->assertStatus(200);
        // \Log::info(1, [$response->getContent()]);
        $this->assertDatabaseHas('clients',[
            'firstname'=> $firstname,
            'othernames'=> $othernames,
            'address' => $address,
            
        ]);

        // $response = $this->json('PUT', '/client/update/1', [
        //     'firstname'=> 211,
        //     'othernames'=> 54612,
        //     'address' => $address = $faker->address.'_updated',
        // ]);

        // $response->assertStatus(400);

        $response = $this->json('PUT', '/client/update/-1', [
            'firstname'=> $firstname = $faker->firstname.'_updated',
            'othernames'=> $othernames = $faker->lastName.'_updated',
            'address' => $address = $faker->address.'_updated',
        ]);

        $response->assertStatus(404);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_search_filters()
    {
        $faker = Factory::create();
        $response = $this->json('POST', '/client/add', [
            'firstname'=> $firstname = $faker->firstname,
            'othernames'=> $othernames = $faker->lastName,
            'address' => $address = $faker->address,
            'customerid'=> $customerid = $faker->uuid,
            'nationalid'=> $nationalid = $faker->ean8,
            'mobilenumber'=>$mobilenumber = $faker->phonenumber,
            'customerphoto'=> $customerphoto = $faker->image
        ]);

        $response = $this->json('POST', '/client/show', [
            'nationalid'=> $nationalid
        ]);

        $response->assertStatus(200);

        $response = $this->json('POST', '/client/show', [
            'nationalid'=> -200
        ]);

        $response->assertStatus(404);

        $response = $this->json('POST', '/client/show', [
            'customerid'=> $customerid
        ]);

        $response->assertStatus(200);

        $response = $this->json('POST', '/client/show', [
            'customerid'=> '56793de4-23REEds-3246-ad5e'
        ]);

        $response->assertStatus(404);

        $response = $this->json('POST', '/client/show', [
            'names'=> $firstname
        ]);

        $response->assertStatus(200);

        $response = $this->json('POST', '/client/show', [
            'names'=> $othernames
        ]);

        $response->assertStatus(200);

        $response = $this->json('POST', '/client/show', [
            'names'=> '-kl43kl'
        ]);

        $response->assertStatus(404);
        
    }
}
