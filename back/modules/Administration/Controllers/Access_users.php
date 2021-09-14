<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Access_users as Access_usersModel;

class Access_users extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
        $this->access_users = new Access_usersModel;
    }

    public function create() {
        $db = db_connect();
        $datos = $this->request->getPost();

        /* Validar que la relacion no exista para cambiarle a 0 o colocarle null */
        $acc_int_id = $datos['acc_int_id'];
        $use_int_id = $datos['use_int_id'];
        $sql = "SELECT * FROM administration.access_users WHERE use_int_id ='$use_int_id' and acc_int_id ='$acc_int_id'";
        $query = $db->query($sql);
        
        if ($query->getNumRows() == 0) {
            $id = $this->access_users->insert($datos);
            $respuesta = [
                'status' => 201,
                'messages' => "Permiso usuario creado",
                'id' => $id,
            ];
            return $this->respondCreated($respuesta);
        }

        $result = $query->getResultArray();
        $axu_int_id = $result[0]['axu_int_id'];

        /* Si desmarca el checkbox entonces asumimos que hay q eliminar la relacion acceso x usuario */
        if ($datos['que'] == "d") {
            $this->delete($axu_int_id);
            $respuesta = [
                'status' => 204,
                'messages' => "Permiso usuario eliminado",
                'id' => $axu_int_id,
            ];
            return $this->respondDeleted($respuesta);
        } else {
            $datos['axu_date_deletion_date'] = null;
            $updated = $this->access_users->update($axu_int_id, $datos);
            if ($updated === false) {
                return $this->failServerError();
            } else {
                $respuesta = [
                    'status' => 202,
                    'messages' => "Permiso de usuario actualizado",
                    'id' => $axu_int_id,
                ];
                return $this->respond($respuesta);
            }
        }
    }

    public function update($id = null) {
        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $this->access_users->setUpdateRules($data);

        $updated = $this->access_users->update($id, $data);

        if ($this->access_users->errors())
            return $this->fail($this->access_users->errors());

        if ($updated === false) {
            return $this->failServerError();
        } else {
            $respuesta = [
                'status' => 201,
                'messages' => "Permiso_usuario actualizado",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null) {
        $existe = $this->access_users->select('axu_int_id')->find($id);
        if (!$existe)
            return $this->fail("No existe el permiso_grupo: $id", 404);

        if ($this->access_users->delete($id))
            return $this->respondDeleted(['axu_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
