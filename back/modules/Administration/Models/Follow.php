<?php
// F.V.
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Follow extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.follow';
    protected $primaryKey = 'fol_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'use_int_id',
        'isu_int_id',
        'fol_date_from',
        'fol_date_to',
        'fol_text_description',
    ];

    protected $cusTimestamps = false;
    protected $createdField  = 'fol_date_creation_date'; // created_at
    protected $updatedField  = 'fol_date_modification_date'; // updated_at
    protected $deletedField  = 'fol_date_deletion_date'; // deleted_at

    protected $skipValidation     = false;

    protected $validationRules    = [
        'fol_date_from' => 'required',
        'fol_date_to' => 'required',
        'fol_text_description' => 'required',
    ];

    protected $validationMessages = [
        'fol_date_from' => [
            'required' => "Debe ingresar una fecha"
        ],
        'fol_date_to' => [
            'required' => "Debe ingresar una fecha"
        ],
        'fol_text_description' => [
            'required' => "Debe ingresar un correo electrónico"
        ],

    ];

    public function setUpdateRules($data) {
        $rules = [];
        if (isset($data['fol_text_description']))
            $rules['fol_text_description'] = 'required';
        $this->validationRules = $rules;
    }
}
