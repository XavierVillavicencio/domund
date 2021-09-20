<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class VwListAccessUsers extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.vw_list_access_users';
    protected $primaryKey = 'axu_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['axu_int_status', 'acc_int_id', 'use_int_id', 'acc_text_description', 'searchitem', 'use_text_fullname'];
    protected $useTimestamps = true;
    protected $createdField  = 'axu_date_creation_date';
    protected $updatedField  = 'axu_date_modification_date';
    protected $deletedField  = 'axu_date_deletion_date';
    protected $skipValidation     = true;
    protected $validationRules    = null;
    protected $validationMessages = null;
}
