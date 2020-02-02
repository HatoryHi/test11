<?php

namespace application\models;

use application\core\Model;

class User extends Model
{

    public function getUsers($login, $pass)
    {
        $params = [
            'login' => $login,
            'pass' => $pass,
        ];
        $result = $this->db->query('SELECT * FROM users WHERE login = :login and pass = :pass', $params)->fetchAll();
        try {
            if (($login and $pass) === ($result['0']['login'] and $result['0']['pass'])) {
                return true;
            }
        } catch (\Exception $exception) {
        }
    }

    public function login($login, $pass)
    {
        $params = [
            'login' => $login,
            'pass' => $pass
        ];
        $result = $this->db->query(
            'SELECT login,pass FROM users WHERE login = :login and pass = :pass',
            $params
        )->fetchAll();
        return $result[0];
    }

}