<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Issues as IssuesModel;

class Issues extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
        $this->issues = new IssuesModel;
    }

    public function index() {
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $u = $this->request->getVar('u');
        $a = $this->request->getVar('a');
        $limit = ($l != "") ? $l : 3;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);
        $ob = "";

        $sqlTotal = ", (SELECT count(*) FROM administration.vw_list_issues) as total";

        $sql = "SELECT * {$sqlTotal} FROM administration.vw_list_issues";
        if (strlen($k) >= 3){
            $sql .= " where searchitem like '%$k%'";
        }
        $sql .= " $ob OFFSET $offset LIMIT $limit";
        $query = $db->query($sql);
        $data = $query->getResultArray();

        $arr['datos'] = $data;
        $arr['sql'] = $sql;
        $arr['total'] = $data[0]['total'];

        return $this->respond($arr);
    }

    public function show($id = 1) {
        $datos = $this->issues->find($id);
        return $this->respond($datos);
    }

    public function create() {
        $datos = $this->request->getPost();

        $id = $this->issues->insert($datos);
        if ($this->issues->errors())
            return $this->fail($this->issues->errors());

        if ($id == false)
            return $this->failServerError();
        else {
            $respuesta = [
                'status' => 201,
                'messages' => "creado",
                'id' => $id
            ];
            return $this->respond($respuesta);
        }
    }

    public function update($id = null) {

        /* Validar que exista el id recibido */
        if ($id === null)
            return $this->respond("no existe");

        $consulta = $this->issues->find($id);
        if ($consulta === NULL) {
            return $this->failNotFound('no existe ' . $id);
        }

        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $this->issues->setUpdateRules($data);

        $data['isu_date_deletion_date'] = null;

        $updated = $this->issues->update($id, $data);

        if ($this->issues->errors())
            return $this->fail($this->issues->errors());

        if ($updated === false) {
            return $this->failServerError();
        } else {
            $respuesta = [
                'status' => 201,
                'messages' => "actualizado",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null) {
        $existe = $this->issues->select('isu_int_id')->find($id);
        if (!$existe)
            return $this->fail("No existe : $id", 404);

        if ($this->issues->delete($id))
            return $this->respondDeleted(['isu_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
