<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Business_users as Business_usersModel;

class Business_users extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
        $this->business_users = new Business_usersModel;
    }

    public function index() {
        $datos = $this->business_users->findAll();
        return $this->respond($datos);
    }

    public function show($id = 1) {
        $datos = $this->business_users->find($id);
        return $this->respond($datos);
    }

    public function create() {
        $db = db_connect();
        $datos = $this->request->getPost();

        /* Validar que la relacion no exista para cambiarle a 0 o colocarle null */
        $bus_int_id = $datos['bus_int_id'];
        $use_int_id = $datos['use_int_id'];
        $sql = "SELECT * FROM administration.business_users WHERE use_int_id ='$use_int_id' and bus_int_id ='$bus_int_id'";
        $query = $db->query($sql);

        if ($query->getNumRows() == 0) {
            $id = $this->business_users->insert($datos);
            $respuesta = [
                'status' => 201,
                'messages' => "Relación empresa y usuario creada",
                'id' => $id,
            ];
            return $this->respondCreated($respuesta);
        }

        $result = $query->getResultArray();
        $bxu_int_id = $result[0]['bxu_int_id'];

        /* Si desmarca el checkbox entonces asumimos que hay q eliminar la relacion empresa x usuario */
        if ($datos['que'] == "d") {
            $this->delete($bxu_int_id);
            $respuesta = [
                'status' => 204,
                'messages' => "Relación empresa y usuario eliminada",
                'id' => $bxu_int_id,
            ];
            return $this->respondDeleted($respuesta);
        } else {
            $datos['bxu_date_deletion_date'] = null;
            $updated = $this->business_users->update($bxu_int_id, $datos);
            if ($updated === false) {
                return $this->failServerError();
            } else {
                $respuesta = [
                    'status' => 202,
                    'messages' => "Relación empresa y usuario actualizada",
                    'id' => $bxu_int_id,
                ];
                return $this->respond($respuesta);
            }
        }
    }

    public function update($id = null) {
        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $this->business_users->setUpdateRules($data);

        $updated = $this->business_users->update($id, $data);

        if ($this->business_users->errors())
            return $this->fail($this->business_users->errors());

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
        $existe = $this->business_users->find($id);

        //$sql = $this->business_users->getLastQuery();

        if (!$existe)
            return $this->fail("No existe la relación: $id", 404);

        if ($this->business_users->delete($id))
            return $this->respondDeleted(['axu_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
