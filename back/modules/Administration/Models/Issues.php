<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Issues extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.issues';
    protected $primaryKey = 'isu_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['isu_int_pid', 'use_int_id', 'isu_text_description'];

    protected $useTimestamps = true;
    protected $createdField  = 'isu_date_creation_date';
    protected $updatedField  = 'isu_date_modification_date';
    protected $deletedField  = 'isu_date_deletion_date';

    protected $skipValidation     = false;

    protected $validationRules    = [
        'isu_int_pid' => 'required',
        'use_int_id' => 'required',
        'isu_text_description' => 'required|min_length[3]|max_length[125]'
    ];

    protected $validationMessages = [
        'isu_int_id' => [
            'required' => "Debe seleccionar un issues"
        ],
        'use_int_id' => [
            'required' => "Debe seleccionar un usuario"
        ],
        'isu_text_description' => [
            'required' => "Debe ingresar una descripción",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 125 letras o números"
        ]
    ];

    public function setUpdateRules($data) {
        $rules = [];
        if (isset($data['isu_text_description'])) {
            $rules['isu_text_description'] = 'required|string|min_length[3]|max_length[125]';
        }
        if (isset($data['use_int_id'])) {
            $rules['use_int_id'] = 'required';
        }
        $this->validationRules = $rules;
    }
}
