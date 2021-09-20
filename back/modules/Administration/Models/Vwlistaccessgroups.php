<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class VwListAccessGroups extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.vw_list_access_groups';
    protected $primaryKey = 'axg_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['axg_int_id', 'gro_int_id', 'acc_int_id', 'acc_text_description', 'searchitem', 'gro_text_fullname'];
    protected $useTimestamps = true;
    protected $createdField  = 'axg_date_creation_date';
    protected $updatedField  = 'axg_date_modification_date';
    protected $deletedField  = 'axg_date_deletion_date';
    protected $skipValidation     = true;
    protected $validationRules    = null;
    protected $validationMessages = null;
}
