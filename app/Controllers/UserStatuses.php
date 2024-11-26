<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserStatusesModel;

class UserStatuses extends ResourceController
{
    use ResponseTrait;

    // get all
    public function index()
    {
        $model = new UserStatusesModel();
        $data = $model->all();
        return $this->respond($data, 200);
    }

    // create a product category
    public function create(){
        $response = [
            'status'   => false,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
        $data = $this->request->getJSON();
        if ($data) {
            $model = new UserStatusesModel();
            $response['status'] = $model->insert($data);
        }
        return $this->respondCreated($response);
    }

    // update product category
    public function update($id = null)
    {
        $json = $this->request->getJSON();
        if($json){
            $data = $json;
        }else{
            $data = $this->request->getRawInput();
        }
        // Insert to Database
        $model = new UserStatusesModel();
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    // delete product category
    public function delete($id = null)
    {
        $model = new UserStatusesModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

    // get single product category
    public function show($id = null)
    {
        $model = new UserStatusesModel();
        $result = $model->getOne($id);
        if($result){
            return $this->respond($result);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

}
