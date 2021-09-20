import React from "react";

export default function Navbar() {
  return (
    <header className="navbar-custom d-flex align-items-center justify-content-end p-3 bg-light">
      <p className="mb-0 border rounded p-2">Nombre de usuario</p>
      <p className="mb-0 bg-info border rounded p-2 text-white">Condominio <i class="fas fa-chevron-down"></i></p>
      <button className="btn btn-danger">
        Salir
        <i className="fas fa-sign-out-alt ms-2"></i>
      </button>
    </header>
  );
}
