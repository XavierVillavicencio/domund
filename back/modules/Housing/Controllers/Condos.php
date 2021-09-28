<?php

namespace Modules\Housing\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Housing\Models\Condos as CondosModel;

class Condos extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
        $this->condos = new CondosModel;
    }

    public function index() {
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $limit = ($l != "") ? $l : 20;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);
        $where = null;
        if (strlen($k) >= 3)
            {
                $where = " WHERE searchitem like '%{$k}%'";
            }
        $sqlTotal = ", (select count(*) from housing.condos {$where}) as total";
        $sql = "SELECT * {$sqlTotal} FROM housing.condos {$where}";
        $sql .= " offset $offset limit $limit";
        $query = $db->query($sql);
        $data = $query->getResultArray();
        $arr['datos'] = $data;
        $arr['sql'] = $sql;
        $arr['total'] = empty($data[0]['total'])?0:$data[0]['total'];
        $arr['paginas'] = empty($data[0]['total'])?0:($data[0]['total'])/$limit;
        return $this->respond($arr);
    }

    public function show($id = 1) {
        $datos = $this->condos->find($id);
        return $this->respond($datos);
    }

    public function create() {
        $datos = $this->request->getPost();
        $id = $this->condos->insert($datos);
        if ($this->condos->errors()){
              return $this->fail($this->condos->errors());
            }
        if ($id == false){
            return $this->failServerError();
        }else{
            $respuesta = [
                'status' => 201,
                'messages' => "Condominio creado",
                'id' => $id
            ];
            return $this->respond($respuesta);
        }
    }

    public function update($id = null) {
        /* Validar que exista el id recibido */
        if ($id === null)
            return $this->respond("no existe");

        $consulta = $this->condos->find($id);
        if ($consulta === NULL) {
            return $this->failNotFound('Condominio no existe ' . $id);
        }

        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $this->condos->setUpdateRules($data);

        $updated = $this->condos->update($id, $data);

        if ($this->condos->errors())
            return $this->fail($this->condos->errors());

        if ($updated === false) {
            return $this->failServerError();
        } else {
            $respuesta = [
                'status' => 201,
                'messages' => "Condominio actualizado",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null) {
        $existe = $this->condos->select('con_int_id')->find($id);
        if (!$existe)
            return $this->fail("No existe el condominio: $id", 404);

        if ($this->condos->delete($id))
            return $this->respondDeleted(['con_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
