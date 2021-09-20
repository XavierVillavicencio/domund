<?php
// JCVB
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Business extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.business';
    protected $primaryKey = 'bus_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['bus_text_name', 'bus_text_identification', 'bus_text_address', 'bus_text_phone', 'bus_text_email', 'bus_date_deletion_date'];

    protected $useTimestamps = false;
    protected $createdField  = 'bus_date_creation_date'; // created_at
    protected $updatedField  = 'bus_date_modification_date'; // updated_at
    protected $deletedField  = 'bus_date_deletion_date'; // deleted_at

    protected $skipValidation     = false;

    protected $validationRules    = [
        'bus_text_name' => 'required|string|min_length[3]|max_length[200]',
        'bus_text_identification' => 'required|numeric|min_length[3]|max_length[20]',
        'bus_text_address' => 'required|string|min_length[3]|max_length[200]',
        'bus_text_phone' => 'required|numeric|min_length[3]|max_length[20]',
        'bus_text_email' => 'required|string|valid_email|min_length[3]|max_length[100]'
    ];

    protected $validationMessages = [
        'bus_text_name' => [
            'required' => "Debe ingresar un nombre de la Empresa",
            'min_length' => "Debe tener mínimo 3 letras o números",
            'max_length' => "Debe tener máximo 200 letras o números"
        ],
        'bus_text_identification' => [
            'required' => "Debe ingresar una identificación",
            'is_unique' => "Ya está registrado la identificación ingresada",
            'min_length' => "Debe tener mínimo 3 letras y números",
            'max_length' => "Debe tener máximo 20 letras y números",
            'numeric' => "Debe ingresar solo números"
        ],
        'bus_text_address' => [
            'required' => "Debe ingresar una dirección",
            'min_length' => "Debe tener mínimo 3 letras o números",
            'max_length' => "Debe tener máximo 200 letras o números"
        ],
        'bus_text_phone' => [
            'required' => "Debe ingresar un número de teléfono",
            'min_length' => "Debe tener mínimo 3 letras o números",
            'max_length' => "Debe tener máximo 20 letras o números",
            'numeric' => "Debe ingresar solo números",
        ],
        'bus_text_email' => [
            'required' => "Debe ingresar un correo electrónico",
            'valid_email' => "Debe ser un correo electrónico válido",
            'min_length' => "Debe tener mínimo 3 letras o números",
            'max_length' => "Debe tener máximo 100 letras o números"
        ]
    ];


    public function setUpdateRules($data) {
        //si el campo no está configurado, entonces no es obligatorio que se modifique, 
        //si el dato no esta como clave en el arreglo entonces permanecerá con el mismo valor

        $rules = [];
        if (isset($data['bus_text_name']))
            $rules['bus_text_name'] = 'required|string|min_length[3]|max_length[200]';
        if (isset($data['bus_text_identification']))
            $rules['bus_text_identification'] = 'required|string|min_length[3]|max_length[20]';
        if (isset($data['bus_text_address']))
            $rules['bus_text_address'] = 'required|string|min_length[3]|max_length[200]';
        if (isset($data['bus_text_phone']))
            $rules['bus_text_phone'] =  'required|string|min_length[3]|max_length[20]';
        if (isset($data['bus_text_email']))
            $rules['bus_text_email'] =  'required|string|valid_email|min_length[3]|max_length[100]';

        $this->validationRules = $rules;
    }
}
