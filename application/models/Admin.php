<?php

namespace application\models;

use application\core\Model;
use http\Params;
use PDO;

class Admin extends Model
{

    public function getBanners()
    {
        return $this->db->row('SELECT * FROM banners order by pos ASC ');
    }

    public function bannerAdd($id, $title, $image, $link, $status, $pos)
    {
        $params = [
            'id' => $id,
            'title' => $title,
            'image' => $image,
            'link' => $link,
            'status' => $status,
            'pos' => $pos,
        ];
        $this->db->query('INSERT INTO banners VALUES (:id,:title, :image,:link,:status,:pos)', $params);
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

    public function bannerUpd()
    {
        $id = $_POST['id'];
        $title = $_POST['name'];
        $link = $_POST['link'];
        $status = $_POST['status'];
        $pos = $_POST['position'];
        $params = [
            'id' => $id,
            'title' => $title,
            'link' => $link,
            'status' => $status,
            'pos' => $pos,
        ];
        $this->db->query(
            'UPDATE banners SET name = :title,link = :link,status = :status,pos =:pos WHERE id = :id',
            $params
        );
    }

    public function bannerDelete($id)
    {
        $params = [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM banners WHERE id = :id', $params);
    }

    public function getItembyId()
    {
        $id = $_POST['edt'];
        $p = [
            'id' => $id,
        ];
        return $this->db->row('SELECT * FROM banners WHERE id = :id', $p);
    }


}