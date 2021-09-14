<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Files_customers as FilesModel;

class Files_customers extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
        $this->files = new FilesModel;
    }

    public function show($id = null) {
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $limit = ($l != "") ? $l : 10;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);
        $where_['customerId'] = "cus_int_id = '{$id}'";

        $where_[] = "fxc_date_modification_date is null";

        if (strlen($k) >= 3)
            $where_['keyword'] = "upper(fxc_text_file) like '%{$k}%'";
        else
            $where_['keyword'] = "TRUE";
            
        $where = implode(" AND ", $where_);
        $where = "WHERE {$where}";


        $sqlTotal = "SELECT count(*) as total FROM administration.files_customers {$where}";
        $sql = "SELECT *,({$sqlTotal}) from administration.files_customers $where";
        $sql .= " ORDER BY fxc_int_id DESC";
        $sql .= " OFFSET $offset LIMIT $limit";
        $query = $db->query($sql);
        $data = $query->getResultArray();
        
        $arr['datos'] = $data;
        $arr['sql'] = $sql;
        $arr['total'] = empty($data[0]['total']) ? 0 : $data[0]['total'];

        return $this->respond($arr);
    }

    public function create() {
        $db = db_connect();
        $data = $this->request->getPost();
        $file = $this->request->getFile('file');


        $namef = "fxc_text_file";
        $campo = "cus_int_id";
        $table = "administration.files_customers";

        $arreglo = array(
            $campo => $data['id'],
            $namef => $file->getName(),
            'use_int_id' => 1, // TO_DO Hay que asociar el id del usuario logueado loged :)
        );

        $db->table($table)->insert($arreglo);
        $fil_int_id = $db->insertID();

        $file->move(WRITEPATH . "uploads/$table", $fil_int_id);
        if (!$file->hasMoved())
            return $this->fail($file->getErrorString());

        if ($fil_int_id) {
            $respuesta = [
                'status' => 201,
                'messages' => "Archivo de files_customers ingresado y almacenado",
                'id' => $fil_int_id
            ];
            return $this->respond($respuesta);
        } else {
            return $this->failServerError();
        }
    }

    public function update($id = null) {

        /* Validar que exista el id recibido */
        if ($id === null)
            return $this->respond("no existe");

        $consulta = $this->files->find($id);
        if ($consulta === NULL) {
            return $this->failNotFound('Archivo no existe ' . $id);
        }

        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $this->files->setUpdateRules($data);

        $updated = $this->files->update($id, $data);

        if ($this->files->errors())
            return $this->fail($this->files->errors());

        if ($updated === false) {
            return $this->failServerError();
        } else {
            $respuesta = [
                'status' => 201,
                'messages' => "Archivo actualizado",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null) {

        $existe = $this->files->select('fxc_int_id')->find($id);
        if (!$existe)
            return $this->fail("No existe el archivo: $id", 404);

        if ($this->files->delete($id))
            return $this->respondDeleted(['fxc_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
