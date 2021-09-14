<?php
namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Access_groups as Access_groupsModel;

class Access_groups extends ResourceController{
    use \CodeIgniter\API\ResponseTrait;

    public function __construct(){
        $this->access_groups = new Access_groupsModel;
    }

    public function index(){
        $datos = $this->access_groups->findAll();
        return $this->respond($datos);
    }

    public function show($id=null){
        $datos = $this->access_groups->find($id);
        return $this->respond($datos);
    }

    public function create(){
        $db = db_connect();
        $datos = $this->request->getPost();
        
        /* Validar que la relacion no exista para cambiarle a 0 o colocarle null */
        $acc_int_id = $datos['acc_int_id'];
        $gro_int_id = $datos['gro_int_id'];
        $sql = "SELECT * FROM administration.access_groups WHERE gro_int_id ='$gro_int_id' and acc_int_id ='$acc_int_id'";
        $query = $db->query($sql);
        

        if ($query->getNumRows() == 0) {
            $id = $this->access_groups->insert($datos);
            $respuesta = [
                'status' => 201,
                'messages' => "Permiso grupo creado",
                'id' => $id,
            ];
            return $this->respondCreated($respuesta);
        }

        $result = $query->getResultArray();
        $axg_int_id = $result[0]['axg_int_id'];

        /* Si desmarca el checkbox entonces asumimos que hay q eliminar la relacion acceso x grupo */
        if ($datos['que'] == "d") {
            $this->delete($axg_int_id);
            $respuesta = [
                'status' => 204,
                'messages' => "Permiso grupo eliminado",
                'id' => $axg_int_id,
            ];
            return $this->respondDeleted($respuesta);
        } else {
            $datos['axg_date_deletion_date'] = null;
            $updated = $this->access_groups->update($axg_int_id, $datos);
            if ($updated === false) {
                return $this->failServerError();
            } else {
                $respuesta = [
                    'status' => 202,
                    'messages' => "Permiso de grupo actualizado",
                    'id' => $axg_int_id,
                ];
                return $this->respond($respuesta);
            }
        }
    }

    public function update($id=null){
         $data = $this->request->getRawInput();
         $data['id']=$id;
         $this->access_groups->setUpdateRules($data);

         $updated = $this->access_groups->update($id,$data);

         if ($this->access_groups->errors())
             return $this->fail($this->access_groups->errors());

         if ($updated === false) {
             return $this->failServerError();
         }else{
             $respuesta = [
                 'status' => 201,
                 'messages' => "Permiso_grupo actualizado",
                 'id' => $id,
             ];
             return $this->respond($respuesta);
         }
     }

     public function delete($id = null){
         $existe = $this->access_groups->select('axg_int_id')->find($id);
         if(!$existe)
             return $this->fail("No existe el permiso_grupo: $id",404);

         if($this->access_groups->delete($id))
             return $this->respondDeleted(['axg_int_id' => $id]);
         else
             return $this->failServerError();

     }

}
