<?php
namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Access as AccessModel;

class Access extends ResourceController{
    use \CodeIgniter\API\ResponseTrait;

    public function __construct(){
        $this->access = new AccessModel;
    }

    public function index(){
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $limit = ($l != "") ? $l : 3;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);
        $where = null;

        if (strlen($k) >= 3) 
            $where = " WHERE upper like '%{$k}%'";
        
        $sqlTotal = ", (select count(*) from administration.vw_list_access {$where}) as total";
        $sql = "SELECT * {$sqlTotal} FROM  administration.vw_list_access {$where}";
        $sql .= " offset $offset limit $limit";
        $query = $db->query($sql);
        $data = $query->getResultArray();

        $arr['datos'] = $data;
        $arr['sql'] = $sql;
        $arr['total'] = $data[0]['total'];

        return $this->respond($arr);
    }

    public function show($id=1){
        $datos = $this->access->find($id);
        return $this->respond($datos);
    }

    public function create(){
        $datos = $this->request->getPost();
        $id = $this->access->insert($datos);
        if ($this->access->errors())
            return $this->fail($this->access->errors());

        if($id == false)
            return $this->failServerError();
        else{
            $respuesta = [
                'status' => 201,
                'messages' => "Permiso creado",
                'id' => $id
            ];
            return $this->respond($respuesta);
        }

    }

    public function update($id=null){
        $data = $this->request->getRawInput();
        $data['id']=$id;

        $updated = $this->access->update($id,$data);

        if ($this->access->errors())
            return $this->fail($this->access->errors());

        if ($updated === false) {
            return $this->failServerError();
        }else{
            $respuesta = [
                'status' => 201,
                'messages' => "Permiso actualizado",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null){
        $existe = $this->access->select('acc_int_id')->find($id);
        
        if(!$existe)
            return $this->fail("No existe el permiso: $id",404);

        if($this->access->delete($id))
            return $this->respondDeleted(['acc_int_id' => $id]);
        else
            return $this->failServerError();

    }
}
