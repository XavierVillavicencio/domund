<?php 
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Business_customers extends Model{
    protected $DBGroup = 'default';
    protected $table      = 'administration.business_customers';
    protected $primaryKey = 'bxc_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['bus_int_id','cus_int_id','bxc_date_deletion_date'];
    protected $useTimestamps = true;
    protected $createdField  = 'bxc_date_creation_date';
    protected $updatedField  = 'bxc_date_modification_date';
    protected $deletedField  = 'bxc_date_deletion_date';
    protected $skipValidation     = false;
    
    protected $validationRules    = [
        'bus_int_id' => 'required',
        'cus_int_id' => 'required'
    ];

    protected $validationMessages = [
        'bus_int_id' => [
            'required' => "Debe seleccionar un permiso"
        ],
        'cus_int_id' => [
            'required' => "Debe seleccionar un cliente"
        ]
        
    ]; 

    public function setUpdateRules($data){
        $rules = [];

        if(isset($data['bus_int_id'])){
            $rules['bus_int_id'] = 'required';
        }
        if(isset($data['cus_int_id'])){
            $rules['cus_int_id'] = 'required';
        }
        $this->validationRules = $rules;
    }

    


}