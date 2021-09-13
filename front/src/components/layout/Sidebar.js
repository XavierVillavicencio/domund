import React from "react";
import { NavLink } from "react-router-dom";

import logo from "images/logo.png";
import RouterData from "router/RouterData";
import CollapseMenu from "components/layout/CollapseMenu";

import "styles/Sidebar.css";

export default function Sidebar() {
  return (
    <aside className="sidebar-custom d-flex flex-column justify-content-start align-items-center px-2 py-3 text-white">
      <header className={"py-2"}>
        <img src={logo} alt="Logo" width="200px" />
      </header>

      <div className="border w-100 d-flex flex-column align-items-start-justify-content-center rounded p-2 my-2 bg-dark">
        <p className="w-100 word-break d-flex justify-content-between">
          <span className="fw-bold me-2">Saldo:</span>
          $60.31
        </p>
        <p className="w-100 word-break d-flex justify-content-between">
          <span className="fw-bold me-2">Comisión:</span>
          $36.95
        </p>
        <p className="w-100 word-break mb-0 d-flex justify-content-between">
          <span className="fw-bold me-2">Total disponible:</span>
          $97.26
        </p>
      </div>

      <nav className="w-100">
        <ul className="ps-0">
          {RouterData.map((group, index) => (
            <li key={index} className="w-100 py-2">
              {group.map((item) =>
                item.link ? (
                  <NavLink
                    className="nav-link w-100 text-white hover-link"
                    activeClassName="active-link"
                    key={item.link}
                    to={item.link}
                  >
                    {item.name}
                  </NavLink>
                ) : (
                  <CollapseMenu
                    key={item.name}
                    name={item.name}
                    childrens={item.childrens}
                  />
                )
              )}
            </li>
          ))}
        </ul>
      </nav>
    </aside>
  );
}
