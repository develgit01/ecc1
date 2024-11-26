<?php

namespace App\Models;

use CodeIgniter\Model;

class UserStatusesModel extends Model
{
    protected $table = 'user_statuses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description']; // Agrega los campos manualmente

    public function all(){
        return $this->select('user_statuses.*')
            ->get()
            ->getResult();
    }

    public function pagination($page, $offset){
        return $this->select('user_statuses.*')
            ->get($page, $offset)
            ->getResult();
    }

    public function getOne($id){
        return $this->getWhere([
            'id' => $id
        ])->getResult();
    }
}
