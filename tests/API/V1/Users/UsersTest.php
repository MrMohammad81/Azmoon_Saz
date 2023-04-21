<?php

namespace Tests\API\V1\Users;

use Tests\TestCase;

class UsersTest extends TestCase
{
    public function test_should_create_a_new_user()
    {
        $response = $this->call('POST' , 'api/v1/users' , [
            'full_name' => 'Mohammad',
            'email' => 'RezaMajidi@gmail.com',
            'mobile' => '0930655622',
            'password' => '123456'
        ]);

        $this->assertEquals(201 , $response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'full_name',
                'email',
                'mobile',
                'password'
            ]
        ]);
    }

    public function test_it_must_throw_exception_if_we_dont_sent_parameters()
    {
        $response = $this->call('POST' , 'api/v1/users' ,[]);

        $this->assertEquals(422 , $response->status());
    }

    public function test_should_update_the_information_of_user()
    {
        $response = $this->call('PUT' , 'api/v1/users' , [
            'id' => '814' ,
            'full_name' => 'Reza',
            'email' => 'mohammad@gmail.com',
            'mobile' => '0930655622',
        ]);

        $this->assertEquals(200 , $response->status());
        $this->seeJsonStructure([
           'success',
           'message',
           'data' => [
               'full_name',
               'email',
               'mobile'
           ]
        ]);
    }

    public function test_it_must_throw_exception_if_we_dont_sent_parameters_to_update_information_of_user()
    {
        $response = $this->call('PUT' , 'api/v1/users' ,[]);

        $this->assertEquals(422 , $response->status());
    }

    public function test_should_update_password()
    {
        $response = $this->call('PUT' , 'api/v1/users/change-password' , [
            'id' => '607',
            'password' => '12Fisaghores34',
            'password_repeat' => '12Fisaghores34'
        ]);

        $this->assertEquals(200 , $response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'full_name',
                'email',
                'mobile',
            ]
        ]);
    }

    public function test_it_must_throw_exception_if_we_dont_sent_parameters_to_update_password()
    {
        $response = $this->call('PUT' , 'api/v1/users/change-password' ,[]);

        $this->assertEquals(422 , $response->status());
    }

    public function test_should_delete_a_user()
    {
        $response = $this->call('DELETE' , 'api/v1/users' , [
            'id' => '471'
        ]);

        $this->assertEquals(200 , $response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data'
        ]);
    }

     public function test_should_get_users()
     {
         $pagesize = 20;
         $response = $this->call('GET' , 'api/v1/users' , [
             'page' => 1,
             'pagesize' => $pagesize
         ]);

         $data = json_decode($response->getContent() , true);

         $this->assertEquals($pagesize , count($data['data']));
         $this->assertEquals(200 , $response->status());
         $this->seeJsonStructure([
             'success',
             'message',
             'data'
         ]);
     }

     public function test_should_filtered_users()
     {
         $pagesize = 20;
         $userEmail = 'mohammad@gmail.com';
         $response = $this->call('GET' , 'api/v1/users' , [
             'search' => $userEmail ,
             'page' => 1,
             'pagesize' => $pagesize
         ]);

         $data = json_decode($response->getContent() , true);

         $this->assertEquals(200 , $response->status());
         $this->seeJsonStructure([
             'success',
             'message',
             'data'
         ]);
         $this->assertEquals($data['data']['email'] , $userEmail);
     }
}
