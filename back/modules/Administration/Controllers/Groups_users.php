<?php
namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Groups_users as Groups_usersModel;

class Groups_users extends ResourceController{
    use \CodeIgniter\API\ResponseTrait;

    public function __construct(){
        $this->group_users = new Groups_usersModel;
    }

    public function index(){
        $datos = $this->group_users->findAll();
        return $this->respond($datos);
    }

    public function show($id=null){
        $datos = $this->group_users->find($id);
        return $this->respond($datos);
    }

    public function create(){
        
        $db = db_connect();
        $datos = $this->request->getPost();
        
        /* Validar que la relacion no exista para cambiarle a 0 o colocarle null */
        $gro_int_id = $datos['gro_int_id'];
        $use_int_id = $datos['use_int_id'];
        $sql = "SELECT * FROM administration.groups_users WHERE use_int_id ='$use_int_id' and gro_int_id ='$gro_int_id'";
        $query = $db->query($sql);
        if ($query->getNumRows() == 0) {
            $id = $this->group_users->insert($datos);
            $respuesta = [
                'status' => 201,
                'messages' => "Relación grupo y usuario creada",
                'id' => $id,
            ];
            return $this->respondCreated($respuesta);
        }

        $result = $query->getResultArray();
        $gxu_int_id = $result[0]['gxu_int_id'];

        /* Si desmarca el checkbox entonces asumimos que hay q eliminar la relacion grupo x usuario */
        if ($datos['que'] == "d") {
            $this->delete($gxu_int_id);
            $respuesta = [
                'status' => 204,
                'messages' => "Relación grupo y usuario eliminada",
                'id' => $gxu_int_id,
            ];
            return $this->respondDeleted($respuesta);
        } else {
            $datos['gxu_date_deletion_date'] = null;
            $updated = $this->group_users->update($gxu_int_id, $datos);
            if ($updated === false) {
                return $this->failServerError();
            } else {
                $respuesta = [
                    'status' => 202,
                    'messages' => "Relación grupo y usuario actualizada",
                    'id' => $gxu_int_id,
                ];
                return $this->respond($respuesta);
            }
        }
    }

    public function delete($id = null){
        $existe = $this->group_users->find($id);
        if(!$existe)
            return $this->fail("No existe el permiso_grupo: $id",404);

        if($this->group_users->delete($id))
            return $this->respondDeleted(['gxu_int_id' => $id]);
        else
            return $this->failServerError();

    }

}
