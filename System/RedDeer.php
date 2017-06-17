<?php

/**
 * Created by dinhty.luu@gmail.com
 * Date: 13/06/2017
 * Time: 01:14
 */
include('Net/SSH2.php');

class RedDeer
{
    /**
     * @var Net_SSH2
     */
    private static $_ssh;

    const COMMAND_AUTHENTICATE = 'ndsctl auth ';
    const COMMAND_DEAUTHENTICATE = 'ndsctl deauth ';
    const COMMAND_BLOCK = 'ndsctl block ';
    const COMMAND_UNBLOCK = 'ndsctl unblock ';
    const COMMAND_JSON_RESULT = 'ndsctl json';

    public function __construct()
    {
        if (self::$_ssh === null) {
            self::$_ssh = new Net_SSH2('192.168.1.1');

            if (!self::$_ssh->login('root', 'root')) {
                self::$_ssh = null;
                throw new Exception('Cannot connect to server');
            }
        }
        return self::$_ssh;
    }

    /**
     * param $mac | token | ip
     * @param $mac bool|string
     * @return String
     */
    public function authenticate($mac = false)
    {
        if (!$mac) {
            $mac = $this->getMacClient();
        }
        return self::$_ssh->exec(self::COMMAND_AUTHENTICATE . $mac);
    }

    public function deAuthenticate($mac)
    {
        return self::$_ssh->exec(self::COMMAND_DEAUTHENTICATE . $mac);
    }

    public function block($mac)
    {
        return self::$_ssh->exec(self::COMMAND_BLOCK . $mac);
    }

    public function unBlock($mac)
    {
        return self::$_ssh->exec(self::COMMAND_UNBLOCK . $mac);
    }

    public function resultJson()
    {
        return self::$_ssh->exec(self::COMMAND_JSON_RESULT);
    }

    public function getMacClient($ip = null)
    {
        if (is_null($ip)) {
            $ip = $this->getIpClient();
        }
        exec('arp ' . $ip, $result);
        if (is_array($result)) {
            return substr($result[1], 33, 17);
        }
        return false;
    }

    public function getIpClient()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

}