import React from "react";
import { NavLink } from "react-router-dom";

import logo from "images/logo.png";
import RouterData from "router/RouterData";
import CollapseMenu from "components/layout/CollapseMenu";

import "styles/Sidebar.css";

export default function Sidebar() {
  return (
    <aside className="sidebar-custom d-flex flex-column justify-content-start align-items-center px-2 py-3">
      <header className={"py-2"}>
        DOMUND
      </header>

      <nav className="w-100">
        <ul className="ps-0">
          {RouterData.map((group, index) => (
            <li key={index} className="w-100 py-2">
              {group.map((item) =>
                item.link ? (
                  <NavLink
                    className="nav-link w-100 hover-link"
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
