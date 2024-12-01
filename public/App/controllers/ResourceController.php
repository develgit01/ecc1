<?php
namespace App\Controllers;

use App\Models\ResourceModel;

class ResourceController {
    private $model;

    public function __construct($tableName) {
        $this->model = new ResourceModel($tableName);
    }

    public function getResources() {
        return $this->model->getAll();
    }

    public function getResource($id) {
        return $this->model->getOne($id);
    }

    public function createResource() {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->model->save($data);
        return [
            'code' => 02,
            'result' => $result,
            'message' => 'Resource created successfully',
        ];
    }
}
