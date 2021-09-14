<?php

namespace Modules\Administration\Controllers;

use CodeIgniter\RESTful\ResourceController;

class VwListBusinessUsers extends ResourceController {
    use \CodeIgniter\API\ResponseTrait;

    public function show($id = null) {

        $db = db_connect();
        $l = $this->request->getVar('l');
        $o = $this->request->getVar('o');
        $k = $this->request->getVar('k');
        $isModal = $this->request->getVar('isModal');
        $limit = ($l != "") ? $l : 10;
        $offset = ($o != "") ? $o : 0;
        $k = strtoupper($k);
        $where_[]  = "TRUE";

        if (strlen($k) >= 3)
            $where_['keyword'] = "searchitem like '%{$k}%'";
        else
            $where_['keyword'] = "TRUE";

        if ($isModal == "undefined")
            $where_[] = "businesschecked = '1'";

        $where = implode(" AND ",$where_);
        $where = "WHERE {$where}";
        

        $sqlTotal = "SELECT count(*) as total FROM administration.sp_getbusinessxusers({$id}) WHERE {$where_['keyword']}";
        $sql = "SELECT *,({$sqlTotal}) from administration.sp_getbusinessxusers({$id}) $where";
        $sql .= " ORDER BY bus_text_name ASC";
        $sql .= " OFFSET $offset LIMIT $limit";

        $query = $db->query($sql);
        $data = $query->getResultArray();

        $arr['datos'] = $data;
        $arr['sql'] = $sql;
        $arr['total'] = empty($data[0]['total']) ? 0 : $data[0]['total'];

        return $this->respond($arr);
    }
}
