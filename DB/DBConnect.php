<?php

/**
 * Created by dinhty.luu@gmail.com
 * Date: 13/06/2017
 * Time: 12:56
 */
class DBConnect
{
    /**
     * @var $DBH PDO
     */
    var $DBH;
    var $host = 'localhost';
    var $dbname = 'wifi_otp';
    var $user = 'root';
    var $password = 'root';

    public function connect()
    {
        try {
            $this->DBH = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function disconnect()
    {
        $this->DBH = null;
    }

}