<?php
// Cris
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Groups extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.groups';
    protected $primaryKey = 'gro_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['gro_text_description'];

    protected $useTimestamps = true;
    protected $createdField  = 'gro_date_creation_date';
    protected $updatedField  = 'gro_date_modification_date';
    protected $deletedField  = 'gro_date_deletion_date';

    protected $skipValidation     = false;


    protected $validationRules    = [
        'gro_text_description' => 'required|min_length[3]|max_length[125]'
    ];

    protected $validationMessages = [
        'gro_text_description' => [
            'required' => "Debe ingresar una descripción",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 125 letras o números"
        ]

    ];

    public function setUpdateRules($data) {
        $rules = [];
        if (isset($data['gro_text_description'])) {
            $rules['gro_text_description'] = 'required|string|min_length[3]|max_length[125]';
        }
        $this->validationRules = $rules;
    }
}
