<?php
namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\VwListFollowUsers as VwListFollowUsersModel;

class VwListFollowUsers extends ResourceController{
    use \CodeIgniter\API\ResponseTrait;

    public function __construct(){
        $this->model = new VwListFollowUsersModel;
        $this->use_int_id_logged = 1;
    }

    public function index(){
        $datos = $this->model->where("use_int_id",$this->use_int_id_logged)->orderBy('isu_int_id', 'asc')->findAll();
        return $this->respond($datos);
    }

    public function show($id=null){
        $datos = $this->model->where("use_int_id",$id)->orderBy('isu_int_id', 'asc')->findAll();
        return $this->respond($datos);
    }

}

