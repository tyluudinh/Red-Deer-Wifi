<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 15/06/2017
 * Time: 14:38
 */
include 'CommonFunction.php';
include 'RedDeer.php';
session_start();
$queryParams = $_GET;
if (isset($queryParams['action'])) {
    include 'DB/User.php';
    $action = $queryParams['action'];
    $minTimeOut = isset($queryParams['min_time_out']) ? (int)$queryParams['min_time_out'] : 2;
    switch ($action) {
        case 'authenticate':
            $token = $queryParams['token'];
            $user = new User();
            $usernameG = CommonFunction::generateRandomString(7);
            $passwordG = CommonFunction::generateRandomString(7);
            $timeCreated = date('Y-m-d H:i:s', time());
            $res = $user->insert([$usernameG, $passwordG, User::STATUS_AVAILABLE, $timeCreated, $minTimeOut]);
            $result = [
                'type' => 'error',
                'msg' => 'Authenticated failed'
            ];
            if ($res) {
                $tl = new RedDeer();
                if ($tl->authenticate($token)) {
                    $ts_login = time();
                    $ts_timeOut = $ts_login + (int)$minTimeOut * 60;
                    $update = $user->update(
                        [
                            'ts_time_out' => $ts_timeOut,
                            'status' => User::STATUS_AUTHENTICATED,
                            'ip' => $queryParams['ip'],
                            'token' => $token,
                            'mac_address' => $queryParams['mac'],
                            'ts_login' => $ts_login,
                        ],
                        [
                            'username' => $usernameG,
                            'password' => $passwordG
                        ]);
                    if ($update) {
                        $_SESSION['toast'] = [
                            'type' => 'success',
                            'msg' => 'Authenticated successfully'
                        ];
                        header('Location: manage.php');
                        return true;
                    }
                    $tl->deAuthenticate($token);
                }
            }
            $_SESSION['toast'] = $result;
            header('Location: manage.php');
            break;
        case 'delete':
            $id = $queryParams['id'];
            $user = new User();
            if ($user->delete($id)){
                $_SESSION['toast'] = [
                    'type' => 'success',
                    'msg' => 'Deleted successfully'
                ];
                header('Location: manage.php');
                return true;
            };
            $_SESSION['toast'] = [
                'type' => 'error',
                'msg' => 'Delete failed'
            ];
            header('Location: manage.php');
            break;
        case 'edit':
            $id = $queryParams['id'];
            $user = new User();
            $update = $user->update(
                [
                    'min_time_out' => (int) $minTimeOut,
                ],
                [
                    'id' => $id
                ]);
            if ($update) {
                $_SESSION['toast'] = [
                    'type' => 'success',
                    'msg' => 'Edit successfully'
                ];
                header('Location: manage.php');
                return true;
            };
            $_SESSION['toast'] = [
                'type' => 'error',
                'msg' => 'Edit failed'
            ];
            header('Location: manage.php');
            break;
        case 'update':
            $id = $queryParams['id'];
            $user = new User();
            $u = $user->findOne($id);
            if ($u){
                $update = $user->update(
                    [
                        'ts_time_out' => (int) $minTimeOut * 60 + $u['ts_time_out'],
                    ],
                    [
                        'id' => $id
                    ]);
                if ($update) {
                    $_SESSION['toast'] = [
                        'type' => 'success',
                        'msg' => 'Update successfully'
                    ];
                    header('Location: manage.php');
                    return true;
                };
            }
            $_SESSION['toast'] = [
                'type' => 'error',
                'msg' => 'Update failed'
            ];
            header('Location: manage.php');
            break;
        case 'block':
            $id = $queryParams['id'];
            $user = new User();
            $update = $user->update(
                [
                    'status' => User::STATUS_BLOCK,
                ],
                [
                    'id' => $id
                ]);
            if ($update) {
                $tl = new RedDeer();
                $mac = $queryParams['mac'];
                $tl->block($mac);
                $_SESSION['toast'] = [
                    'type' => 'success',
                    'msg' => 'Block successfully'
                ];
                header('Location: manage.php');
                return true;
            };
            $_SESSION['toast'] = [
                'type' => 'error',
                'msg' => 'Block failed'
            ];
            header('Location: manage.php');
            break;
        case 'unblock':
            $id = $queryParams['id'];
            $user = new User();
            $update = $user->update(
                [
                    'status' => User::STATUS_AUTHENTICATED,
                ],
                [
                    'id' => $id
                ]);
            if ($update) {
                $tl = new RedDeer();
                $mac = $queryParams['mac'];
                $tl->unBlock($mac);
                $_SESSION['toast'] = [
                    'type' => 'success',
                    'msg' => 'UnBlock successfully'
                ];
                header('Location: manage.php');
                return true;
            };
            $_SESSION['toast'] = [
                'type' => 'error',
                'msg' => 'UnBlock failed'
            ];
            header('Location: manage.php');
            break;
    };
}
//header('Location: manage.php');

?>

