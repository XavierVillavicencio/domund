<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Files_topics extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.files_topics';
    protected $primaryKey = 'fxt_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['fxt_text_file', 'use_int_id', 'top_int_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'fxt_date_creation_date';
    protected $updatedField  = 'fxt_date_modification_date';
    protected $deletedField  = 'fxt_date_deletion_date';

    protected $skipValidation     = false;

    protected $validationRules    = [
        'fxt_text_file' => 'required|min_length[3]|max_length[200]'
    ];

    protected $validationMessages = [
        'fxt_text_file' => [
            'required' => "Debe ingresar un nombre de archivo",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 200 letras o números"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];
        if (isset($data['fxt_text_file'])) {
            $rules['fxt_text_file'] = 'required|string|min_length[3]|max_length[200]';
        }
        $this->validationRules = $rules;
    }
}
