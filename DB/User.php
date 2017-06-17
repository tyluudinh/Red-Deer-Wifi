<?php

/**
 * Created by dinhty.luu@gmail.com
 * Date: 13/06/2017
 * Time: 12:58
 */
require 'DBConnect.php';
require_once __DIR__ . "/../RedDeer.php";

class User extends DBConnect
{
    const STATUS_PREAUTHENTICATED = 'Preauthenticated';
    const STATUS_AVAILABLE = 'Available';
    const STATUS_AUTHENTICATED = 'Authenticated';
    const STATUS_BLOCK = 'Blocked';
    const STATUS_SESSION_TIME_OUT = 'Session Time Out';

    public function __construct()
    {
        parent::connect();
    }

    protected $_table = 'user';

    public function getAll()
    {
        $sth = $this->DBH->prepare('SELECT * FROM ' . $this->_table);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    public function insert($arr)
    {
        $sth = $this->DBH->prepare('INSERT INTO ' . $this->_table . ' ( username,password,status,created_at,min_time_out) VALUES (?,?,?,?,?)');
        $s = $sth->execute($arr);
        return $s;
    }

    public function update($arrSet, $condition)
    {
        if (!empty($arrSet) && !empty($condition)) {
            end($arrSet);
            $endKey = key($arrSet);
            $querySet = ' SET ';
            $queryValue = [];
            foreach ($arrSet as $key => $value) {
                $k = $key . ' = ?';
                if ($key != $endKey) {
                    $k .= ',';
                }
                $querySet .= $k;
                $queryValue[] = $value;
            }
            end($condition);
            $endKey = key($condition);
            $queryWhere = ' WHERE ';
            foreach ($condition as $key => $value) {
                $k = $key . ' = ?';
                if ($key != $endKey) {
                    $k .= ' and ';
                }
                $queryWhere .= $k;
                $queryValue[] = $value;
            }
            $sth = $this->DBH->prepare('UPDATE ' . $this->_table . $querySet . $queryWhere);
            return $sth->execute($queryValue);
        }
        return false;
    }

    public function deAuthenticate($user)
    {
        $tl = new RedDeer();
        $update = $this->update(
            [
                'status' => User::STATUS_SESSION_TIME_OUT
            ],
            [
                'id' => $user['id']
            ]);
        if ($update) {
            return $tl->deAuthenticate($user['mac_address']);
        }
        return $update;
    }

    public function delete($id)
    {
        $sth = $this->DBH->prepare('DELETE FROM ' . $this->_table . ' WHERE id = ?');
        return $sth->execute(array($id));
    }
    public function findOne($id)
    {
        $sth = $this->DBH->prepare('Select * FROM ' . $this->_table . ' WHERE id = ?');
        $sth->execute(array($id));
        return $sth->fetch();
    }

    public function getJsonFromRouter()
    {
        $tl = new RedDeer();
        return $tl->resultJson();
    }

    public function login()
    {
        $sql = $this->DBH->prepare('SELECT * FROM ' . $this->_table . ' where username = ?');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $token = $_POST['token'];
        $redirectUrl = isset($_POST['redir']) ? $_POST['redir'] : 'http://www.uit.edu.vn/';
        $sql->execute([$username]);
        $data = $sql->fetch();
        /**
         * Check Username password
         */
        if ($data && $data['password'] == $password) {
            $ts_login = time();
            $ts_timeOut = $ts_login + (int)$data['min_time_out'] * 60;
            /**
             * Check session timeout
             */
            if (!is_null($data['ts_time_out']) && $ts_login >= (int)$data['ts_time_out']) {
                return [
                    'success' => false,
                    'code' => -1,
                    'redirectUrl' => false,
                    'msg' => 'Your session time out expried'
                ];
            }
            /**
             * Authenticate though server nodogsplash
             */
            $tl = new RedDeer();
            $ip = $tl->getIpClient();
            $mac = $tl->getMacClient();
            if ($tl->authenticate()) {
                $update = $this->update(
                    [
                        'ip' => $ip,
                        'token' => $token,
                        'mac_address' => $mac,
                        'ts_login' => $ts_login,
                        'ts_time_out' => $ts_timeOut,
                        'status' => User::STATUS_AUTHENTICATED
                    ],
                    [
                        'id' => $data['id']
                    ]);
                if ($update) {
                    return [
                        'success' => true,
                        'code' => 200,
                        'redirectUrl' => $redirectUrl
                    ];
                }
            }
            return [
                'success' => false,
                'code' => 0,
                'redirectUrl' => false,
                'msg' => 'Authenticated failed'
            ];
        }
        return [
            'success' => false,
            'code' => -2,
            'redirectUrl' => false,
            'msg' => 'Wrong username or password'
        ];
    }


}