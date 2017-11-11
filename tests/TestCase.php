<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function login($user = null)
    {
        if (!$user) {
            $user = factory('App\User')->create();
        }

        auth()->login($user);

        return $user;
    }
}
