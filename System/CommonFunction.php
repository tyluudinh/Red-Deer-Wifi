<?php

/**
 * Created by dinhty.luu@gmail.com
 * Date: 16/06/2017
 * Time: 05:38
 */
class CommonFunction
{
    public static function generateRandomString($length = 11)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}