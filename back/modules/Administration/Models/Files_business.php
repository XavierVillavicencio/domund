<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Files_business extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.files_business';
    protected $primaryKey = 'fxb_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['fxb_text_file', 'use_int_id', 'bus_int_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'fxb_date_creation_date';
    protected $updatedField  = 'fxb_date_modification_date';
    protected $deletedField  = 'fxb_date_deletion_date';

    protected $skipValidation     = false;


    protected $validationRules    = [
        'fxb_text_file' => 'required|min_length[3]|max_length[200]'
    ];

    protected $validationMessages = [
        'fxb_text_file' => [
            'required' => "Debe ingresar un nombre de archivo",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 200 letras o números"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];
        if (isset($data['fxb_text_file'])) {
            $rules['fxb_text_file'] = 'required|string|min_length[3]|max_length[200]';
        }
        $this->validationRules = $rules;
    }
}
