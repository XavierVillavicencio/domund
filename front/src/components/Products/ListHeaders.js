import React from "react";

export default function ListHeaders() {
  //prettier-ignore
  return (
    <div className="row w-100 mx-0 bg-secondary text-white rounded mb-2">
      <span className="col-1 text-center border-end py-2 text-truncate">ID</span>
      <span className="col-5 text-center border-end py-2 text-truncate">Producto</span>
      <span className="col-2 text-center border-end py-2 text-truncate">Precio cliente</span>
      <span className="col-2 text-center border-end py-2 text-truncate">Precio PVP</span>
      <span className="col-2 text-center py-2 text-truncate">Opciones</span>
    </div>
  );
}
