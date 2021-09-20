<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Business_users extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.business_users';
    protected $primaryKey = 'bxu_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['bus_int_id', 'use_int_id', 'bxu_date_deletion_date'];
    protected $useTimestamps = true;
    protected $createdField  = 'bxu_date_creation_date';
    protected $updatedField  = 'bxu_date_modification_date';
    protected $deletedField  = 'bxu_date_deletion_date';
    protected $skipValidation     = false;

    protected $validationRules    = [
        'bus_int_id' => 'required',
        'use_int_id' => 'required'
    ];

    protected $validationMessages = [
        'bus_int_id' => [
            'required' => "Debe seleccionar una empresa"
        ],
        'use_int_id' => [
            'required' => "Debe seleccionar un usuario"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];

        if (isset($data['bus_int_id'])) {
            $rules['acc_int_id'] = 'required';
        }
        if (isset($data['use_int_id'])) {
            $rules['use_int_id'] = 'required';
        }
        $this->validationRules = $rules;
    }
}
