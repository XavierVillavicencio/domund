<?php
// Cris
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Groups_users extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.groups_users';
    protected $primaryKey = 'gxu_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['gro_int_id', 'use_int_id', 'gxu_date_deletion_date'];
    protected $useTimestamps = true;
    protected $createdField  = 'gxu_date_creation_date';
    protected $updatedField  = 'gxu_date_modification_date';
    protected $deletedField  = 'gxu_date_deletion_date';
    protected $skipValidation     = false;

    protected $validationRules    = [
        'gro_int_id' => 'required',
        'use_int_id' => 'required'
    ];

    protected $validationMessages = [
        'gro_int_id' => [
            'required' => "Debe seleccionar un grupo"
        ],
        'use_int_id' => [
            'required' => "Debe seleccionar un usuario"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];

        if (isset($data['gro_int_id'])) {
            $rules['gro_int_id'] = 'required';
        }
        if (isset($data['use_int_id'])) {
            $rules['use_int_id'] = 'required';
        }
        $this->validationRules = $rules;
    }
}
