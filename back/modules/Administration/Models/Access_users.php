<?php
// Cris
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Access_users extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.access_users';
    protected $primaryKey = 'axu_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['acc_int_id', 'use_int_id', 'axu_date_deletion_date'];
    protected $useTimestamps = true;
    protected $createdField  = 'axu_date_creation_date';
    protected $updatedField  = 'axu_date_modification_date';
    protected $deletedField  = 'axu_date_deletion_date';
    protected $skipValidation     = false;

    protected $validationRules    = [
        'acc_int_id' => 'required',
        'use_int_id' => 'required'
    ];

    protected $validationMessages = [
        'acc_int_id' => [
            'required' => "Debe seleccionar un permiso"
        ],
        'use_int_id' => [
            'required' => "Debe seleccionar un usuario"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];

        if (isset($data['acc_int_id'])) {
            $rules['acc_int_id'] = 'required';
        }
        if (isset($data['use_int_id'])) {
            $rules['use_int_id'] = 'required';
        }
        $this->validationRules = $rules;
    }
}
