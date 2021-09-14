<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class VwListBusinessUsers extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.vw_list_business_users';
    protected $primaryKey = 'bxu_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['bxu_int_status', 'bus_int_id', 'use_int_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'bxu_date_creation_date';
    protected $updatedField  = 'bxu_date_modification_date';
    protected $deletedField  = 'bxu_date_deletion_date';
    protected $skipValidation     = false;
}
