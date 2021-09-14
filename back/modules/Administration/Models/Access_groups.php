<?php
// Cris
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Access_groups extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.access_groups';
    protected $primaryKey = 'axg_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['acc_int_id', 'gro_int_id', 'axg_date_deletion_date'];
    protected $useTimestamps = true;
    protected $createdField  = 'axg_date_creation_date';
    protected $updatedField  = 'axg_date_modification_date';
    protected $deletedField  = 'axg_date_deletion_date';
    protected $skipValidation     = false;

    protected $validationRules    = [
        'acc_int_id' => 'required',
        'gro_int_id' => 'required'
    ];

    protected $validationMessages = [
        'acc_int_id' => [
            'required' => "Debe seleccionar un permiso"
        ],
        'gro_int_id' => [
            'required' => "Debe seleccionar un grupo"
        ]
    ];

    public function setUpdateRules($data) {
        $rules = [];

        if (isset($data['acc_int_id'])) {
            $rules['acc_int_id'] = 'required';
        }
        if (isset($data['gro_int_id'])) {
            $rules['gro_int_id'] = 'required';
        }
        $this->validationRules = $rules;
    }
}
