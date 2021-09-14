<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Customers as CustomersModel;


class Customers extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;
    protected $format = 'json';


    public function __construct() {
        $this->customers = new CustomersModel;
    }

    ## api metodo: GET  url: https://ofv.test/administration/customers
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
        
        $sqlTotal = ", (select count(*) from administration.vw_list_customers {$where}) as total";
        $sql = "SELECT * {$sqlTotal} FROM  administration.vw_list_customers {$where}";
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
        $datos = $this->customers->find($id);
        return $this->respond($datos);
    }

    public function create() {
        $datos = $this->request->getPost();

        global $userData, $sesionDataLoged;
        $datos['use_int_id'] = $sesionDataLoged['use_int_id'];
        $id = $this->customers->insert($datos);

        if ($this->customers->errors())
            return $this->fail($this->customers->errors());

        $respuesta = [
            'status' => 201,
            'messages' => "Cliente creado",
            'cus_int_id' => $id,
        ];

        return $this->respond($respuesta);
    }

    public function update($id = null) {
        /* Validar que exista el id recibido */
        if ($id === null)
            return $this->respond("no existe");

        $consulta = $this->customers->find($id);

        if ($consulta === NULL) {
            return $this->failNotFound('Cliente no existe ' . $id);
        }

        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $this->customers->setUpdateRules($data);

        $updated = $this->customers->update($id, $data);
        if ($this->customers->errors())
            return $this->fail($this->customers->errors());

        if ($updated === false) {
            return $this->failServerError();
        } else {
            $respuesta = [
                'status' => 201,
                'messages' => "Cliente actualizado",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null) {

        $existe = $this->customers->select('cus_int_id')->find($id);
        if (!$existe)
            return $this->fail("No existe el cliente: $id", 404);

        if ($this->customers->delete($id))
            return $this->respondDeleted(['cus_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
