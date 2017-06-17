<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 14/06/2017
 * Time: 01:20
 */
//include('permisson.php');
include('DB/User.php');
$u = new User();
$users = $u->getAll();
foreach ($users as $user) {
    if ($user['status'] == User::STATUS_AUTHENTICATED && (int)$user['ts_time_out'] <= time()) {
        $u->deAuthenticate($user);
    }
}