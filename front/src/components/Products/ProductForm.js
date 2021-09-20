import React from "react";

import { DefaultInput, DefaultDate } from "templates/input";
import ConfigProductsList from "./ConfigProductsList";

export default function ProductForm({ activeProduct, setProduct }) {
  return (
    <div className="w-100 d-flex flex-wrap align-items-center">
      <div className="w-100 d-flex justify-content-end mb-3">
        <button
          onClick={() => setProduct(null)}
          type="button"
          className="btn btn-danger"
        >
          <i className="fas fa-times me-2"></i>
          Cerrar
        </button>
      </div>

      <div className="w-100 d-flex flex-wrap align-items-center border p-3">
        <h3 className="mb-0">{activeProduct.name}</h3>
        <img
          src={activeProduct.src}
          className="ms-auto rounded"
          alt="logo"
          width="500"
          height="70"
          style={{ objectFit: "cover" }}
        />

        <form className="w-100 row mx-0 mt-4" autoComplete="off">
          {/* Row 1 */}
          <DefaultInput
            label="Nombre de usuario/alias"
            customClass="col-4 mb-0"
          />
          <DefaultInput label="Monto" customClass="col-4 mb-0" />
          <DefaultDate label="Fecha recarga" customClass="col-4 mb-0" />

          {/* Row 2 */}
          <DefaultInput label="Nombre de la cuenta" customClass="col-4 mb-0" />
          <DefaultInput label="Teléfono" customClass="col-4 mb-0" />
          <DefaultInput label="Nota" customClass="col-4 mb-0" />

          {/* Row 3 */}
          <DefaultInput label="Cuenta" customClass="col-4 mb-0" />
          <DefaultInput label="Comentario" customClass="col-8 mb-0" />
        </form>
      </div>

      <ConfigProductsList />
    </div>
  );
}
