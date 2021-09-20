<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Files extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function __construct() {
    }

    public function show($id = null) {
        $db = db_connect();
        $modulo = $this->request->getVar('modulo');
        $debug = $this->request->getVar('debug');
        switch ($modulo) {
            case 'business':
                $fid = 'fxb_int_id';
                $fname = 'fxb_text_file';
                $table = "files_{$modulo}";
                $sql = "SELECT $fname as file, $fid as id from administration.{$table} where $fid = '$id'";
                break;
            case 'issues':
                $fid = 'fxi_int_id';
                $fname = 'fxi_text_file';
                $table = "files_{$modulo}";
                $sql = "SELECT $fname as file, $fid as id from administration.{$table} where $fid = '$id'";
                break;
            case 'topics':
                $fid = 'fxt_int_id';
                $fname = 'fxt_text_file';
                $table = "files_{$modulo}";
                $sql = "SELECT $fname as file, $fid as id from administration.{$table} where $fid = '$id'";
                break;
            case 'customers':
                $fid = 'fxc_int_id';
                $fname = 'fxc_text_file';
                $table = "files_{$modulo}";
                $sql = "SELECT $fname as file, $fid as id from administration.{$table} where $fid = '$id'";
                break;
            case 'follow':
                $fid = 'fxf_int_id';
                $fname = 'fxf_text_file';
                $table = "files_{$modulo}";
                $sql = "SELECT $fname as file, $fid as id from administration.{$table} where $fid = '$id'";
                break;
            default:
                return $this->fail("No existe el archivo", 404);
        }
        $query = $db->query($sql);
        $data = $query->getRow();
        
        if ($debug) {
            $arr['datos'] = $data;
            $arr['sql'] = $sql;
            return $this->respond($arr);
        } else {
            $fichero = WRITEPATH."uploads/administration.{$table}/{$data->id}";
            if (file_exists($fichero)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($data->file) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($fichero));
                readfile($fichero);
                exit;
            } else {
                return "no existe el archivo $fichero";
            }
        }
    }
}
