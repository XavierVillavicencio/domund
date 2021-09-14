<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Follow as FollowModel;


class Follow extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;
    protected $format = 'json';


    public function __construct() {
        $this->follow = new followModel;
    }

    ## api metodo: GET  url: https://ofv.test/administration/follow
    public function index() {
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $limit = ($l != "") ? $l : 3;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);
        
        $sql = "SELECT count(*) as total FROM vw_list_follow";
        
        if (strlen($k) >= 3) 
            $sql .= " where searchitem like '%$k%'";
        $queryTotal = $db->query($sql);
        $total = $queryTotal->getRow()->total;

        $sql="SELECT * FROM vw_list_follow";
        if (strlen($k) >= 3) 
            $sql .= " where searchitem like '%$k%'";
        $sql .= " offset $offset limit $limit";
        $query = $db->query($sql);
        
        $arr['datos'] = $query->getResultArray();
        $arr['sql'] = $sql;
        $arr['total'] = $total;
        $arr['paginas'] = "5";

        return $this->respond($arr);
    }

    public function show($id = 1) {
        $datos = $this->follow->find($id);
        return $this->respond($datos);
    }

    public function create() {
        $datos = $this->request->getPost();
        $id = $this->follow->insert($datos);

        if ($this->follow->errors())
            return $this->fail($this->follow->errors());

        $respuesta = [
            'status' => 201,
            'messages' => "Seguimiento creado",
            'fol_int_id' => $id,
        ];

        return $this->respond($respuesta);
    }

    public function update($id = null) {
        /* Validar que exista el id recibido */
        if ($id === null)
            return $this->respond("no existe");

        $consulta = $this->follow->find($id);
        
        if ($consulta === NULL) {
            return $this->failNotFound('Seguimiento no existe ' . $id);
        }

        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $this->follow->setUpdateRules($data);
        
        $updated = $this->follow->update($id, $data);
        if ($this->follow->errors())
            return $this->fail($this->follow->errors());

        if ($updated === false) {
            return $this->failServerError();
        } else {
            $respuesta = [
                'status' => 201,
                'messages' => "Seguimiento actualizado",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null) {

        $existe = $this->follow->select('fol_int_id')->find($id);
        if (!$existe)
            return $this->fail("No existe el Seguimiento: $id", 404);

        if ($this->follow->delete($id))
            return $this->respondDeleted(['fol_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
