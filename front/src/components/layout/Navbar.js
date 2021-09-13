import React from "react";

export default function Navbar() {
  return (
    <header className="navbar-custom d-flex align-items-center justify-content-end py-3 pe-3 border-bottom bg-light">
      <p className="mb-0 border rounded p-2">Nombre de usuario</p>
      <button className="btn btn-success mx-3">
        Recargar
        <i className="fas fa-plus ms-2"></i>
      </button>
      <button className="btn btn-danger">
        Salir
        <i className="fas fa-sign-out-alt ms-2"></i>
      </button>
    </header>
  );
}
