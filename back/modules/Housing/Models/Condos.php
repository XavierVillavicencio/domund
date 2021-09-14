<?php
namespace Modules\Housing\Models;

use CodeIgniter\Model;

class Condos extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'housing.condos';
    protected $primaryKey = 'con_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['con_text_description'];

    protected $useTimestamps = true;
    protected $createdField  = 'con_date_creation_date';
    protected $updatedField  = 'con_date_modification_date';
    protected $deletedField  = 'con_date_deletion_date';

    protected $skipValidation     = false;


    protected $validationRules    = [
        'con_text_description' => 'required|min_length[3]|max_length[125]'
    ];

    protected $validationMessages = [
        'con_text_description' => [
            'required' => "Debe ingresar una descripción",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 125 letras o números"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];
        if (isset($data['con_text_description'])) {
            $rules['con_text_description'] = 'required|string|min_length[3]|max_length[125]';
        }
        $this->validationRules = $rules;
    }
}
