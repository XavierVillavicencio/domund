<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Business as BusinessModel;

class Business extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
        $this->business = new BusinessModel;
    }

    public function index() {
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $u = $this->request->getVar('u');
        $limit = ($l != "") ? $l : 3;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);
        $ob = "";

        if ($u != "undefined" and $u != "")
            $sql = "SELECT count(*) as total from administration.sp_getbusinessxusers($u)";
        else
            $sql = "SELECT count(*) as total FROM administration.vw_list_business";

        if (strlen($k) >= 3)
            $sql .= " where searchitem like '%$k%'";

        $queryTotal = $db->query($sql);
        $total = $queryTotal->getRow()->total;

        if ($u != "undefined" and $u != "") {
            $sql = "SELECT * from administration.sp_getbusinessxusers($u)";
            $ob = "ORDER BY businesschecked ASC";
        } else
            $sql = "SELECT * FROM administration.vw_list_business";

        if (strlen($k) >= 3)
            $sql .= " where searchitem like '%$k%'";

        $sql .= " $ob OFFSET $offset LIMIT $limit";
        $query = $db->query($sql);

        $arr['datos'] = $query->getResultArray();
        $arr['sql'] = $sql;
        $arr['total'] = $total;
        $arr['paginas'] = "5";

        return $this->respond($arr);
    }

    public function show($id = 1) {
        $datos = $this->business->find($id);
        return $this->respond($datos);
    }

    public function create() {
        // recibir archivos
        $datos = $this->request->getPost();
        $id = $this->business->insert($datos);
        if ($this->business->errors())
            return $this->fail($this->business->errors());

        if ($id == false)
            return $this->failServerError();
        else {

            /* Gestionar archivo RUC */
            $file = $this->request->getFile('emp_ruc_fisico');
            //$type = $file->getClientMimeType();       
            //die(var_dump($_FILES));  // ok
            //die(var_dump($file));    // ok
            //die($file->getName());   // ok
            //die($type);   // ok  // application/pdf
            $file->move(WRITEPATH . 'uploads/rucs/', $datos['emp_ruc'] . ".pdf");

            $arr['fil_int_id'] = $id;
            $arr['bus_int_id'] = $id;

            $respuesta = [
                'status' => 201,
                'messages' => "Empresa creada",
                'id' => $id
            ];
            return $this->respond($respuesta);
        }
    }

    public function update($id = null) {
        $data = $this->request->getRawInput();
        //die(var_dump($data));
        $data['bus_date_deletion_date'] = null;

        $updated = $this->business->update($id, $data);

        if ($this->business->errors())
            return $this->fail($this->business->errors());

        if ($updated === false) {
            return $this->failServerError();
        } else {
            $respuesta = [
                'status' => 201,
                'messages' => "Empresa actualizada",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null) {

        $existe = $this->business->select('bus_int_id')->find($id);
        if (!$existe)
            return $this->fail("No existe la empresa: $id", 404);

        if ($this->business->delete($id))
            return $this->respondDeleted(['bus_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
