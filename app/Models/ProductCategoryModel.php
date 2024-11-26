<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description']; // Agrega los campos manualmente

    public function all(){
        return $this->select('product_categories.*')
            ->get()
            ->getResult();
    }

    public function pagination($page, $offset){
        return $this->select('product_categories.*')
            ->get($page, $offset)
            ->getResult();
    }

    public function getOne($id){
        return $this->getWhere([
            'id' => $id
        ])->getResult();
    }
}
