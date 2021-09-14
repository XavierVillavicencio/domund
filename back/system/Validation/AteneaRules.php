<?php

namespace CodeIgniter\Validation;

use Config\Database;

class AteneaRules {

    // que si no es par, no pasa la validación
    public function par(string $str): bool {
        return (int)$str % 2 == 0;
    }

    /*
        --- Para validar si una llave foranea existe se debe enviar asi el argumento 
        --- [esquema.tabla.llavePrimaria , campo para softDelete]
        ej. 'typ_int_id' => 'required|existeForanea[administration.types.typ_int_id,typ_date_deletion_date]',
        typ_int_id es el campo donde vamos a ver que exista, required significa requerida y a acontinuación la regla
    */
    public function existeForanea(string $str = null, string $field, array $data): bool {
        list($field, $deletedField) = explode(',', $field);
        sscanf($field, '%[^.].%[^.].%[^.]', $esquema, $tabla, $campo);
        
        $db = Database::connect($data['DBGroup'] ?? null);
        $row = $db->table($esquema.".".$tabla)
            ->select('1')
            ->where($campo, $str)
            ->where($deletedField, null)
            ->limit(1);
        
        //echo "select 1 from $esquema.$tabla where $campo = '$str' \n";
        //die(var_dump($row->get()->getRow()));

        return (bool) (!($row->get()->getRow() === null));
    }
}
