<?php
// JCVB
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Customers extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.customers';
    protected $primaryKey = 'cus_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'use_int_id',
        'cus_text_name',
        'cus_text_lastname',
        'cus_text_phone',
        'cus_text_email',
        'cus_text_address',
    ];

    protected $cusTimestamps = false;
    protected $createdField  = 'cus_date_creation_date'; // created_at
    protected $updatedField  = 'cus_date_modification_date'; // updated_at
    protected $deletedField  = 'cus_date_deletion_date'; // deleted_at

    protected $skipValidation     = false;

    protected $validationRules    = [
        'cus_text_name' => 'required|string|min_length[3]|max_length[200]',
        'cus_text_lastname' => 'required|string|min_length[3]|max_length[100]',
        'cus_text_phone' => 'required|string|min_length[6]|max_length[25]',
        'cus_text_email' => 'required|is_unique[customers.cus_text_email]|valid_email|max_length[100]',
    ];

    protected $validationMessages = [
        'cus_text_name' => [
            'required' => "Debe ingresar sus nombres",
            'string' => "Debe ingresar solo letras",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 50 letras o números"
        ],
        'cus_text_lastname' => [
            'required' => "Debe ingresar sus apellidos",
            'string' => "Debe ingresar solo letras",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 50 letras o números"
        ],
        'cus_text_phone' => [
            'required' => "Debe ingresar un número de celular",
            'numeric' => "Debe ingresar solo números",
            'min_length' => "Debe tener mínimo 6 números",
            'max_length' => "Debe tener máximo 25 números"
        ],
        'cus_text_email' => [
            'required' => "Debe ingresar un correo electrónico",
            'is_unique' => "Ya está registrado el correo electrónico ingresado",
            'valid_email' => "Debe ser un correo electrónico válido",
            'max_length' => "Debe tener máximo 100 letras o números"
        ],

    ];

    public function setUpdateRules($data) {
        //si el campo no está configurado, entonces no es obligatorio que se modifique, 
        //si el dato no esta como clave en el arreglo entonces permanecerá con el mismo valor

        $rules = [];
        if (isset($data['cus_text_name']))
            $rules['cus_nombres'] = 'required|string|min_length[3]|max_length[100]';
        if (isset($data['cus_text_lastname']))
            $rules['cus_apellidos'] = 'required|string|min_length[3]|max_length[100]';
        if (isset($data['cus_text_phone']))
            $rules['cus_celular'] = 'required|numeric|min_length[6]|max_length[20]';
        /*if(isset($data['cus_text_email']))
            $rules['cus_email'] = 'required|is_unique[customers.cus_text_email]|valid_email|max_length[100]';*/
        $this->validationRules = $rules;
    }
}
