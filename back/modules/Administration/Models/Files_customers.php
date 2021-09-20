<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Files_customers extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.files_customers';
    protected $primaryKey = 'fxc_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['fxc_text_file', 'use_int_id', 'isu_int_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'fxc_date_creation_date';
    protected $updatedField  = 'fxc_date_modification_date';
    protected $deletedField  = 'fxc_date_deletion_date';

    protected $skipValidation     = false;


    protected $validationRules    = [
        'fxc_text_file' => 'required|min_length[3]|max_length[200]'
    ];

    protected $validationMessages = [
        'fxc_text_file' => [
            'required' => "Debe ingresar un nombre de archivo",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 200 letras o números"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];
        if (isset($data['fxc_text_file'])) {
            $rules['fxc_text_file'] = 'required|string|min_length[3]|max_length[200]';
        }
        $this->validationRules = $rules;
    }
}
