<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Business_customers as Business_customersModel;

class Business_customers extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
        $this->business_customers = new Business_customersModel;
    }

    public function create() {
        $db = db_connect();
        $datos = $this->request->getPost();

        /* Validar que la relacion no exista para cambiarle a 0 o colocarle null */
        $bus_int_id = $datos['bus_int_id'];
        $cus_int_id = $datos['cus_int_id'];
        $sql = "SELECT * FROM administration.business_customers WHERE cus_int_id ='$cus_int_id' and bus_int_id ='$bus_int_id'";
        $query = $db->query($sql);

        if ($query->getNumRows() == 0) {
            $id = $this->business_customers->insert($datos);
            $respuesta = [
                'status' => 201,
                'messages' => "Relación empresa y cliente creada",
                'id' => $id,
            ];
            return $this->respondCreated($respuesta);
        }

        $result = $query->getResultArray();
        $bxc_int_id = $result[0]['bxc_int_id'];

        /* Si desmarca el checkbox entonces asumimos que hay q eliminar la relacion empresa x cliente */
        if ($datos['que'] == "d") {
            $this->delete($bxc_int_id);
            $respuesta = [
                'status' => 204,
                'messages' => "Relación empresa y cliente eliminada",
                'id' => $bxc_int_id,
            ];
            return $this->respondDeleted($respuesta);
        } else {
            $datos['bxc_date_deletion_date'] = null;
            $updated = $this->business_customers->update($bxc_int_id, $datos);
            if ($updated === false) {
                return $this->failServerError();
            } else {
                $respuesta = [
                    'status' => 202,
                    'messages' => "Relación empresa y cliente actualizada",
                    'id' => $bxc_int_id,
                ];
                return $this->respond($respuesta);
            }
        }
    }

    public function update($id = null) {
        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $this->business_customers->setUpdateRules($data);

        $updated = $this->business_customers->update($id, $data);

        if ($this->business_customers->errors())
            return $this->fail($this->business_customers->errors());

        if ($updated === false) {
            return $this->failServerError();
        } else {
            $respuesta = [
                'status' => 201,
                'messages' => "Permiso_cliente actualizado",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null) {
        $existe = $this->business_customers->find($id);

        //$sql = $this->business_customers->getLastQuery();

        if (!$existe)
            return $this->fail("No existe la relación: $id", 404);

        if ($this->business_customers->delete($id))
            return $this->respondDeleted(['axu_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
