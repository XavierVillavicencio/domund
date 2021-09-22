import React from "react";

import ContentContainer from "components/layout/ContentContainer";
import DateInputs from "components/Common/DateInputs";

export default function Condos() {
  return (
    <ContentContainer>
      <h1 className="py-5">Condominios</h1>

      <form className="w-100 d-flex flex-column" autoComplete="off">
        <DateInputs />
        <div className="row mx-0 w-100 mt-5 border-bottom pb-3">
      <label className="col px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Nombre
      </label>
      <label className="col px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Dirección
      </label>
      <label className="col px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Fecha de creación
      </label>
      <label className="col px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Opciones
      </label>
    </div>
    <div className="row mx-0 w-100 border-bottom py-2">
      <label className="col px-1 fs-6 text-center text-uppercase text-break">
        Hogar Simpson
      </label>
      <label className="col px-1 fs-6 text-center text-uppercase text-break">
        Av. Siempre viva 742
      </label>
      <label className="col px-1 fs-6 text-center text-uppercase text-break">
        2021-01-01
      </label>
      <label className="col px-1 fs-6 text-center text-uppercase text-break">
        <div className="btn-group">
          <div className="btn btn-warning" title="Editar"><i class="fas fa-edit"></i></div>
          <div className="btn btn-primary" title="Unidades Habitacionales"><i class="fas fa-person-booth"></i></div>
          <div className="btn btn-primary" title="Contactos"><i class="far fa-address-book"></i></div>
          <div className="btn btn-danger" title="Eliminar">
          <i class="fas fa-trash"></i>
            </div>
        </div>
      </label>
    </div>
      </form>
    </ContentContainer>
  );
}
