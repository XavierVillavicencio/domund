import React from "react";

export default function Navbar() {
  return (
    <header className="navbar-custom d-flex align-items-center justify-content-end py-3 pe-3 border-bottom bg-light">
      <p className="mb-0 border rounded p-2">Nombre de usuario</p>
      <p className="mb-0 bg-secondary text-white  border rounded p-1">Condominio react</p>
      <button className="btn btn-danger">
        Salir
        <i className="fas fa-sign-out-alt ms-2"></i>
      </button>
    </header>
  );
}
