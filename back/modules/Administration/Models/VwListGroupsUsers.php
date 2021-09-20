<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class VwListGroupsUsers extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.vw_list_groups_users';
    protected $primaryKey = 'gxu_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['gxu_int_status', 'gro_int_id', 'use_int_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'gxu_date_creation_date';
    protected $updatedField  = 'gxu_date_modification_date';
    protected $deletedField  = 'gxu_date_deletion_date';
    protected $skipValidation     = false;
}
