<?php

class GeneratePassword
{
    public final static function generatePassword($length)
    {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $digits = '0123456789';
        $specialChars = '#?!@$%^&*-';

        $allChars = $uppercase . $lowercase . $digits . $specialChars;

        $password = '';

        $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
        $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
        $password .= $digits[rand(0, strlen($digits) - 1)];
        $password .= $specialChars[rand(0, strlen($specialChars) - 1)];

        for ($i = 0; $i < $length - 4; $i++) {
            $password .= $allChars[rand(0, strlen($allChars) - 1)];
        }

        $password = str_shuffle($password);

        return $password;
    }
}
