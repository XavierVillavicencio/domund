<?php
namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;
use \Modules\Administration\Models\Topics as TopicsModel;

class Topics extends ResourceController{
    use \CodeIgniter\API\ResponseTrait;

    public function __construct(){
        $this->topics = new TopicsModel;
    }

    public function index(){
        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $limit = ($l != "") ? $l : 3;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);
        $where_[''] = "top_date_deletion_date is null";

        if (strlen($k) >= 3)
            $where_['keyword'] = "upper(top_text_name) like '%{$k}%'";
        else
            $where_['keyword'] = "TRUE";
            
        $where = implode(" AND ", $where_);
        $where = "WHERE {$where}";

        $sqlTotal="SELECT count(*) as total FROM administration.topics $where";        
        $sql = "SELECT *,({$sqlTotal}) from administration.topics $where";
        $sql .= " ORDER BY top_int_id DESC";
        $sql .= " OFFSET $offset LIMIT $limit";
        $query = $db->query($sql);
        $data = $query->getResultArray();
        
        $arr['datos'] = $query->getResultArray();
        $arr['sql'] = $sql;
        $arr['total'] = empty($data[0]['total']) ? 0 : $data[0]['total'];

        return $this->respond($arr);
    }

    public function show($id=1){
        $datos = $this->topics->find($id);
        return $this->respond($datos);
    }

    public function create(){
        $datos = $this->request->getPost();
        $id = $this->topics->insert($datos);
        if ($this->topics->errors())
            return $this->fail($this->topics->errors());

        if($id == false)
            return $this->failServerError();
        else{
            $respuesta = [
                'status' => 201,
                'messages' => "Tema creado",
                'id' => $id
            ];
            return $this->respond($respuesta);
        }
    }

    public function update($id=null){
        
        /* Validar que exista el id recibido */
        if($id===null)
            return $this->respond("no recibió id");   

        $consulta = $this->topics->find($id);
        if($consulta===NULL){
            return $this->failNotFound('Tema no existe '.$id);
        }

        $data = $this->request->getRawInput();
        $data['id']=$id;
        $this->topics->setUpdateRules($data);

        $updated = $this->topics->update($id,$data);

        if ($this->topics->errors())
            return $this->fail($this->topics->errors());

        if ($updated === false) {
            return $this->failServerError();
        }else{
            $respuesta = [
                'status' => 201,
                'messages' => "Tema actualizado",
                'id' => $id,
            ];
            return $this->respond($respuesta);
        }
    }

    public function delete($id = null){
        $existe = $this->topics->select('top_int_id')->find($id);
        if(!$existe)
            return $this->fail("No existe el Tema: $id",404);

        if($this->topics->delete($id))
            return $this->respondDeleted(['top_int_id' => $id]);
        else
            return $this->failServerError();
    }
}
