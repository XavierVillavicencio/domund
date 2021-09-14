<?php
// JCVB
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Access extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.access';
    protected $primaryKey = 'acc_int_id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['acc_text_description', 'acc_text_tag', 'acc_text_url'];
    protected $useTimestamps = false;
    protected $createdField  = 'acc_date_creation_date'; // created_at
    protected $updatedField  = 'acc_date_modification_date'; // updated_at
    protected $deletedField  = 'acc_date_deletion_date'; // deleted_at

    protected $skipValidation     = true;

    protected $validationRules    = [
        'acc_text_description' => 'required|string|min_length[3]|max_length[125]',
        'acc_text_tag' => 'required|is_unique|string|min_length[3]|max_length[15]',
        'acc_text_url' => 'required|string|min_length[8]|max_length[256]'
    ];

    protected $validationMessages = [
        'acc_text_description' => [
            'required' => "Debe ingresar una descripción del permiso",
            'min_length' => "Debe tener mínimo 3 letras o números",
            'max_length' => "Debe tener máximo 125 letras o números"
        ],
        'acc_text_tag' => [
            'required' => "Debe ingresar un tag",
            'is_unique' => "Ya está registrado el tag ingresado",
            'min_length' => "Debe tener mínimo 3 letras y números",
            'max_length' => "Debe tener máximo 15 letras y números"
        ],
        'acc_text_url' => [
            'required' => "Debe ingresar una dirección web",
            'min_length' => "Debe tener mínimo 8 caracteres",
            'max_length' => "Debe tener máximo 256 caracteres"
        ],
    ];

    public function setUpdateRules($data) {
        $rules = [];
        if (isset($data['acc_text_description'])) {
            $rules['acc_text_description'] = 'required|string|min_length[3]|max_length[125]';
        }
        if (isset($data['acc_text_tag'])) {
            $rules['acc_text_tag'] = 'required|is_unique|string|min_length[3]|max_length[15]';
        }
        if (isset($data['acc_text_url'])) {
            $rules['acc_text_tag'] = 'required|string|min_length[8]|max_length[256]';
        }
        $this->validationRules = $rules;
    }
}
