import React from "react";

import { DefaultInput, DefaultDate, DefaultFile } from "templates/input";

export default function Form() {
  return (
    <form className="w-100 row mx-0 border p-3" autoComplete="off">
      {/* row 1 */}
      <DefaultInput label="Número de cuenta" customClass="col-4 mb-0" />
      <DefaultInput label="Nombre" customClass="col-4 mb-0" />
      <DefaultInput label="Tipo de cuenta" customClass="col-4 mb-0" />
      {/* row 2 */}
      <DefaultInput label="Número de comprobante" customClass="col-3 mb-0" />
      <DefaultInput label="Valor" customClass="col-3 mb-0" />
      <DefaultInput label="Cuenta" customClass="col-3 mb-0" />
      <DefaultDate label="Fecha" customClass="col-3 mb-0" />
      {/* row 3 */}
      <DefaultInput label="Comentario" customClass="col-8 mb-0" />
      <DefaultFile label="Imagen comprobante" customClass="col-4 mb-0" />
    </form>
  );
}
