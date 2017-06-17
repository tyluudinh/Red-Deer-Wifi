<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 17/02/2017
 * Time: 13:42
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-type: application/json');
include('DB/User.php');
$user = new User();
$data = $user->login();
echo json_encode($data);