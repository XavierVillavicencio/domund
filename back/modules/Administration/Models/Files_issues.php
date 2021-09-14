<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Files_issues extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.files_issues';
    protected $primaryKey = 'fxi_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['fxi_text_file', 'use_int_id', 'isu_int_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'fxi_date_creation_date';
    protected $updatedField  = 'fxi_date_modification_date';
    protected $deletedField  = 'fxi_date_deletion_date';

    protected $skipValidation     = false;


    protected $validationRules    = [
        'fxi_text_file' => 'required|min_length[3]|max_length[200]'
    ];

    protected $validationMessages = [
        'fxi_text_file' => [
            'required' => "Debe ingresar un nombre de archivo",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 200 letras o números"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];
        if (isset($data['fxi_text_file'])) {
            $rules['fxi_text_file'] = 'required|string|min_length[3]|max_length[200]';
        }
        $this->validationRules = $rules;
    }
}
