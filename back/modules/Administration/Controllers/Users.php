<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Users as UsersModel;


class Users extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;
    protected $format = 'json';


    public function __construct() {
        $this->users = new UsersModel;
    }

    ## api metodo: GET  url: https://ofv.test/administration/users
    public function index() {
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $limit = ($l != "") ? $l : 3;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);
        
        $sql="SELECT count(*) as total FROM administration.vw_list_users";
        if (strlen($k) >= 3) 
            $sql .= " where searchitem like '%$k%'";
        $queryTotal = $db->query($sql);
        $total = $queryTotal->getRow()->total;

        $sql="SELECT * FROM administration.vw_list_users";
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
        $datos = $this->users->find($id);
        return $this->respond($datos);
    }

    public function create() {

        $datos = $this->request->getPost();
        $id = $this->users->insert($datos);

        if ($this->users->errors())
            return $this->fail($this->users->errors());

        $respuesta = [
            'status' => 201,
            'messages' => "Usuario creado",
            'use_int_id' => $id,
        ];

        return $this->respond($respuesta);
    }

    public function update($id = null) {
        $data = $this->request->getRawInput();
        if ($data['use_text_pass'] == "")
            unset($data['use_text_pass']);
        else
            $use_text_pass = $data['use_text_pass'];

        $this->users->setUpdateRules($data);
        
        $updated = $this->users->update($id, $data);

        if ($this->users->errors())
            return $this->fail($this->users->errors());

        if ($updated === false) {
            return $this->failServerError();
        } else {
            $msj = ", no actualiza contraseña";
            if (isset($data['use_text_pass']) and trim($data['use_text_pass']) != "") {
                $passwd['use_text_pass'] = md5(trim($use_text_pass));
                $this->users->update($id, $passwd);
                $msj = ", contraseña actualizada";
            }
            $respuesta = [
                'status' => 201,
                'messages' => "Actualizado satisfactoriamente" . $msj,
                'use_int_id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null) {

        $existe = $this->users->select('use_int_id')->find($id);
        if (!$existe)
            return $this->fail("No existe el usuario: $id", 404);

        if ($this->users->delete($id))
            return $this->respondDeleted(['use_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
