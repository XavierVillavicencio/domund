<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Files_follow extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.files_follow';
    protected $primaryKey = 'fxf_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['fxf_text_file', 'use_int_id', 'fol_int_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'fxf_date_creation_date';
    protected $updatedField  = 'fxf_date_modification_date';
    protected $deletedField  = 'fxf_date_deletion_date';

    protected $skipValidation     = false;


    protected $validationRules    = [
        'fxf_text_file' => 'required|min_length[3]|max_length[200]'
    ];

    protected $validationMessages = [
        'fxf_text_file' => [
            'required' => "Debe ingresar un nombre de archivo",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 200 letras o números"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];
        if (isset($data['fxf_text_file'])) {
            $rules['fxf_text_file'] = 'required|string|min_length[3]|max_length[200]';
        }
        $this->validationRules = $rules;
    }
}
