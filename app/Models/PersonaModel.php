<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
	protected $table = 'personas';
	protected $primaryKey = 'id_persona';
	protected $allowedFields = ['nombre','apellido','fecha_nacimiento','genero_id'];

	public function all(){
      return $this->select('personas.*, generos.nombre as genero')
        ->join('generos', 'generos.id = personas.genero_id')
        ->get()
        ->getResult();
	}

	public function pagination($page, $offset){
      return $this->select('personas.*, generos.nombre as genero')
        ->join('generos', 'generos.id = personas.genero_id')
        ->get($page, $offset)
        ->getResult();
	}

	public function getOne($id){
		return $this->getWhere([
			'id' => $id
		])->getResult();
	}
}
