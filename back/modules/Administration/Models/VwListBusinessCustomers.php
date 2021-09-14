<?php 
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class VwListBusinessCustomers extends Model{
    protected $DBGroup = 'default';
    protected $table      = 'administration.vw_list_business_customers';
    protected $primaryKey = 'bxc_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['bus_int_id','cus_int_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'bxc_date_creation_date';
    protected $updatedField  = 'bxc_date_modification_date';
    protected $deletedField  = 'bxc_date_deletion_date';
    protected $skipValidation     = false;
}