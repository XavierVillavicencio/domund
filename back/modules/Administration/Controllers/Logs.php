<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Logs as LogsModel;

class Logs extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
        $this->logs = new LogsModel;
    }

    public function index() {
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $d = $this->request->getVar('d');
        $limit = ($l != "") ? $l : 3;
        $offset = ($o != "") ? $o : 0;
        $desde = ($d != "") ? $d : 'now()';
        $k = strtoupper($k);

        /*
        // no calculo el total porque es un scroll infinito
        $sql = "SELECT count(*) as total FROM logs";
        if (strlen($k) >= 3)
            $sql .= " where log_text_descrption like '%$k%'";
        $queryTotal = $db->query($sql);
        $total = $queryTotal->getRow()->total;
        */

        $fields = "log_int_id,use_int_id,log_text_url,log_date_creation_date";
        $sql = "SELECT $fields FROM logs";
        if (strlen($k) >= 3)
            $sql .= " where log_data like '%$k%'";

        $where = "WHERE log_date_creation_date < '$desde'";       
        $sql .= " $where order by log_int_id DESC offset $offset limit $limit ";
        $query = $db->query($sql);

        $arr['datos'] = $query->getResultArray();
        $arr['sql'] = $sql;
        $arr['desde'] = ($d != "") ? $d : $arr['datos'][0]['log_date_creation_date'];

        return $this->respond($arr);
    }

    public function show($id = null) {
        $datos=[
            'status' => 201,
            'data' => "Mostrando el log 1, siempre el uno"
        ];
        return $this->respond($datos);
    }

}
