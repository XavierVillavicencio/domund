<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Files_issues as FilesModel;

class Files_issues extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
        $this->files = new FilesModel;
    }

    public function index() {
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $i = $this->request->getVar('i');
        $limit = ($l != "") ? $l : 3;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);


        $sql = "SELECT count(*) as total FROM administration.files_issues ";
        $sql.= "where isu_int_id = '$i' and fxi_date_deletion_date is null";

        if (strlen($k) >= 3)
            $sql .= " where searchitem like '%$k%'";

        $queryTotal = $db->query($sql);
        $total = $queryTotal->getRow()->total;

        $sql = "SELECT * FROM administration.files_issues where isu_int_id = '$i' ";
        $sql.= "AND isu_int_id = '$i' and fxi_date_deletion_date is null";

        if (strlen($k) >= 3)
            $sql .= " and searchitem like '%$k%' and fxi_date_deletion_date is null";
        $sql .= " offset $offset limit $limit";
        $query = $db->query($sql);

        $arr['datos'] = $query->getResultArray();
        $arr['sql'] = $sql;
        $arr['total'] = $total;
        $arr['paginas'] = "5";

        return $this->respond($arr);
    }

    public function show($id = 1) {
        $datos = $this->files->find($id);
        return $this->respond($datos);
    }

    public function create() {
        $db = db_connect();
        $data = $this->request->getPost();
        $file = $this->request->getFile('file');
        
        
        $namef = "fxi_text_file";
        $campo = "isu_int_id";
        $table = "administration.files_issues";
        
        $arreglo = array(
            $campo => $data['id'],
            $namef => $file->getName(),
            'use_int_id' => 16019, // TO_DO Hay que asociar el id del usuario logueado loged :)
        );
                
        $db->table($table)->insert($arreglo);
        $fil_int_id = $db->insertID();
        
        $file->move(WRITEPATH . "uploads/$table", $fil_int_id);
        if (!$file->hasMoved())
            return $this->fail($file->getErrorString());

        if ($fil_int_id) {
            $respuesta = [
                'status' => 201,
                'messages' => "Archivo de issue ingresado y almacenado",
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
        
        $existe = $this->files->select('fxi_int_id')->find($id);
        if (!$existe)
            return $this->fail("No existe el archivo: $id", 404);

        if ($this->files->delete($id))
            return $this->respondDeleted(['fxi_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
