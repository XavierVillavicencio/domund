import React from "react";

import { DefaultDate } from "templates/input";

export default function DateInputs() {
  return (
    <div className="w-100 d-flex align-items-end justify-content-center gap-3 border p-3">
      <DefaultDate label="Desde" mb="0" customClass="w-25" />
      <DefaultDate label="Hasta" mb="0" customClass="w-25" />
      <button type="button" className="btn btn-success">
        <i className="fas fa-search me-2"></i>
        Buscar
      </button>
    </div>
  );
}
