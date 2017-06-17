<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 17/02/2017
 * Time: 13:56
 */

namespace TyLuu\Radius;

class Client
{
    public static function auth($username, $password)
    {
        $radius = new Server();
        $radius = $radius->init();
        $response = $radius->accessRequest($username, $password);

        if ($response === false) {
            // false returned on failure
            echo sprintf("Access-Request failed with error %d (%s).\n",
                $radius->getErrorCode(),
                $radius->getErrorMessage()
            );
        } else {
            // access request was accepted - client authenticated successfully
            echo "Success!  Received Access-Accept response from RADIUS server.\n";
        }

    }
}