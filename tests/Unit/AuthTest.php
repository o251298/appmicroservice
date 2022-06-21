<?php

namespace Tests\Unit;


use App\Exceptions\AuthException;
use Tests\TestCase;
use App\Models\User;
class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_find_user_by_token_success()
    {
        $token = 'aac19cec81358d0d5e595e1b86afff487d560253eb0441afaaf8b37798b286ea';
        $id = 26;
        $userExpected = User::find($id);
        $userActual = User::isAuthByTokenForApi($token);
        $this->assertEquals($userExpected, $userActual);
    }
    public function test_find_user_by_token_fail()
    {
        try {
            $token = '';
            $user = User::isAuthByTokenForApi($token);
        } catch (AuthException $exception)
        {
            $this->assertInstanceOf(AuthException::class, $exception);
        }
    }
}
