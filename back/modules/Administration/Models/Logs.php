<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Logs extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.logs';
    protected $primaryKey = 'log_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'log_date_creation_date';
    protected $updatedField  = 'log_date_modification_date';
    protected $deletedField  = 'log_date_deletion_date';
    protected $skipValidation = false;
}
