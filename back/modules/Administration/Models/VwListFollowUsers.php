<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class VwListFollowUsers extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.follow';
    protected $primaryKey = 'fol_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['use_int_id', 'isu_int_id', 'fol_date_from', 'fol_date_to', 'fol_text_description'];
    protected $useTimestamps = true;
    protected $createdField  = 'fol_date_creation_date';
    protected $updatedField  = 'fol_date_modification_date';
    protected $deletedField  = 'fol_date_deletion_date';
    protected $skipValidation     = true;
    protected $validationRules    = null;
    protected $validationMessages = null;
}
