import React from "react";

import { DefaultInput } from "templates/input";

export default function Form() {
  return (
    <form className="w-100 row mx-0 border p-3" autoComplete="off">
      {/* row 1 */}
      <DefaultInput label="Cédula" customClass="col-4 mb-0" />
      <DefaultInput label="Nombres" customClass="col-4 mb-0" />
      <DefaultInput label="Teléfono" customClass="col-4 mb-0" />
      {/* row 2 */}
      <DefaultInput label="E-mail" customClass="col-4 mb-0" />
      <DefaultInput label="Ciudad" customClass="col-4 mb-0" />
      <DefaultInput
        label="Contraseña"
        type="password"
        customClass="col-4 mb-0"
      />
    </form>
  );
}
