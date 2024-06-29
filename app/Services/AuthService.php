<?php

namespace App\Services;


interface AuthService
{

    function findUserByEmail(string $email);

    function authenticate(array $data);

    function logout();

    function registerUser(array $data);
}
