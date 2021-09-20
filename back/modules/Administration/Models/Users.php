<?php
// JCVB
namespace Modules\Administration\Models;

use CodeIgniter\Model;

class Users extends Model {
    protected $DBGroup = 'default';
    protected $table      = 'administration.users';
    protected $primaryKey = 'use_int_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'use_text_user',
        'use_text_pass',
        'use_text_name',
        'use_text_lastname',
        'use_text_phone',
        'use_text_address',
        'use_int_admin',
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'use_date_creation_date'; // created_at
    protected $updatedField  = 'use_date_modification_date'; // updated_at
    protected $deletedField  = 'use_date_deletion_date'; // deleted_at

    protected $skipValidation     = false;

    protected $validationRules    = [
        'use_text_user' => 'required|is_unique[users.use_text_user]|valid_email|max_length[100]',
        'use_text_pass' => 'required|string|min_length[5]|max_length[32]',
        'use_text_name' => 'required|string|min_length[3]|max_length[50]',
        'use_text_lastname' => 'required|string|min_length[3]|max_length[50]',
        'use_text_phone' => 'required|string|min_length[6]|max_length[25]',
        'use_int_admin' => 'required',
    ];

    protected $validationMessages = [
        'use_text_user' => [
            'required' => "Debe ingresar un correo electrónico",
            'is_unique' => "Ya está registrado el correo electrónico ingresado",
            'valid_email' => "Debe ser un correo electrónico válido",
            'max_length' => "Debe tener máximo 100 letras o números"
        ],
        'use_text_pass' => [
            'required' => "Debe ingresar una contraseña",
            'min_length' => "Debe tener mínimo 5 letras y números",
            'max_length' => "Debe tener máximo 32 letras y números"
        ],
        'use_text_name' => [
            'required' => "Debe ingresar sus nombres",
            'string' => "Debe ingresar solo letras",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 50 letras o números"
        ],
        'use_text_lastname' => [
            'required' => "Debe ingresar sus apellidos",
            'string' => "Debe ingresar solo letras",
            'min_length' => "Debe tener mínimo 3 letras",
            'max_length' => "Debe tener máximo 50 letras o números"
        ],
        'use_text_phone' => [
            'required' => "Debe ingresar un número de celular",
            'numeric' => "Debe ingresar solo números",
            'min_length' => "Debe tener mínimo 6 números",
            'max_length' => "Debe tener máximo 25 números"
        ],
        'use_int_admin' => [
            'required' => "Debe seleccionar el tipo de usuario",
            //'regex_match' => "Debe ingresar 0  o 1"
        ],
    ];

    public function setUpdateRules($data) {
        //si el campo no está configurado, entonces no es obligatorio que se modifique, 
        //si el dato no esta como clave en el arreglo entonces permanecerá con el mismo valor

        $rules = [];
        // if(isset($data['use_text_user']))
        //     $rules['use_text_user'] = 'required|is_unique[users.use_text_user,use_int_id,{use_int_id}]|valid_email|max_length[100]';
        if (isset($data['use_text_pass']))
            $rules['use_passwd'] = 'required|string|min_length[5]|max_length[32]';
        if (isset($data['use_text_name']))
            $rules['use_nombres'] = 'required|string|min_length[3]|max_length[100]';
        if (isset($data['use_text_lastname']))
            $rules['use_apellidos'] = 'required|string|min_length[3]|max_length[100]';
        if (isset($data['use_text_phone']))
            $rules['use_celular'] = 'required|numeric|min_length[6]|max_length[20]';

        $this->validationRules = $rules;
    }
}
