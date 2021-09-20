import React from "react";

export default function TableHeaders() {
  return (
    <div className="row mx-0 w-100 mt-5 border-bottom pb-3">
      <label className="col-1 px-1 fs-6 text-center fw-bold text-uppercase text-break">
        ID
      </label>

      <label className="col-1 px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Fecha petición
      </label>

      <label className="col-2 px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Banco
      </label>

      <label className="col-1 px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Fecha
        <br />
        depósito
      </label>

      <label className="col-1 px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Documento
      </label>

      <label className="col-1 px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Valor
      </label>

      <label className="col-2 px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Estado
      </label>

      <label className="col-1 px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Fecha
        <br />
        acreditación
      </label>

      <label className="col-2 px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Observación
      </label>
    </div>
  );
}
