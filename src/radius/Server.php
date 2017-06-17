<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 17/02/2017
 * Time: 13:56
 */



namespace TyLuu\Radius;
use Dapphp\Radius\Radius;
error_reporting(E_ALL);
ini_set('display_errors', 1);


class Server
{
    public function init(){
        $radius = new Radius();
        $radius->setServer('192.168.1.138')        // IP or hostname of RADIUS server
        ->setSecret('testing123')       // RADIUS shared secret
        ->setNasIpAddress('192.168.1.138')  // IP or hostname of NAS (device authenticating user)
        ->setAttribute(32, 'vpn')       // NAS identifier
        ->setDebug();                   // Enable debug output to screen/console
        return $radius;

    }
}
