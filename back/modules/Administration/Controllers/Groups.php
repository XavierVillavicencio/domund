<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Groups as GroupsModel;

class Groups extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
        $this->groups = new GroupsModel;
        //$this->db->schema = 'administration';
    }

    public function index() {
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $limit = ($l != "") ? $l : 3;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);
        $where = null;

        if (strlen($k) >= 3) 
            $where = " WHERE searchitem like '%{$k}%'";
        
        $sqlTotal = ", (select count(*) from administration.vw_list_groups {$where}) as total";
        $sql = "SELECT * {$sqlTotal} FROM  administration.vw_list_groups {$where}";
        $sql .= " offset $offset limit $limit";
        $query = $db->query($sql);
        $data = $query->getResultArray();

        $arr['datos'] = $data;
        $arr['sql'] = $sql;
        $arr['total'] = $data[0]['total'];
        $arr['paginas'] = "5";

        return $this->respond($arr);
    }

    public function show($id = 1) {
        $datos = $this->groups->find($id);
        return $this->respond($datos);
    }

    public function create() {
        
        $datos = $this->request->getPost();
        
        $id = $this->groups->insert($datos);
        if ($this->groups->errors())
            return $this->fail($this->groups->errors());

        if ($id == false)
            return $this->failServerError();
        else {
            $respuesta = [
                'status' => 201,
                'messages' => "Grupo creado",
                'id' => $id
            ];
            return $this->respond($respuesta);
        }
    }

    public function update($id = null) {

        /* Validar que exista el id recibido */
        if ($id === null)
            return $this->respond("no existe");

        $consulta = $this->groups->find($id);
        if ($consulta === NULL) {
            return $this->failNotFound('Grupo no existe ' . $id);
        }

        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $this->groups->setUpdateRules($data);

        $updated = $this->groups->update($id, $data);

        if ($this->groups->errors())
            return $this->fail($this->groups->errors());

        if ($updated === false) {
            return $this->failServerError();
        } else {
            $respuesta = [
                'status' => 201,
                'messages' => "Grupo actualizado",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null) {
        $existe = $this->groups->select('gro_int_id')->find($id);
        if (!$existe)
            return $this->fail("No existe el grupo: $id", 404);

        if ($this->groups->delete($id))
            return $this->respondDeleted(['gro_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
