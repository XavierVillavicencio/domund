<?php

namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Topics extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.topics';
    protected $primaryKey = 'top_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['top_text_name'];

    protected $useTimestamps = true;
    protected $createdField  = 'top_date_creation_date';
    protected $updatedField  = 'top_date_modification_date';
    protected $deletedField  = 'top_date_deletion_date';

    protected $skipValidation     = false;


    protected $validationRules    = [
        'top_text_name' => 'required|min_length[3]|max_length[125]'
    ];

    protected $validationMessages = [
        'top_text_name' => [
            'required' => "Debe ingresar un nombre",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 125 letras o números"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];

        if (isset($data['top_text_name'])) {
            $rules['top_text_name'] = 'required|string|min_length[3]|max_length[125]';
        }
        $this->validationRules = $rules;
    }
}
