import React from "react";
import { NavLink } from "react-router-dom";

export default function CollapseMenu({ name, childrens }) {
  const id = name.replaceAll(" ", "");
  const hashedId = "#" + id;

  return (
    <>
      <p className="mb-0 w-100">
        <a
          className="nav-link w-100"
          data-bs-toggle="collapse"
          href={hashedId}
          role="button"
          aria-expanded="false"
          aria-controls={id}
        >
          {name}
        </a>
      </p>
      <div className="collapse mx-0 w-100" id={id}>
        {childrens.map((item) => (
          <NavLink
            className="nav-link hover-link"
            activeClassName="active-link"
            key={item.link}
            to={item.link}
          >
            - {item.name}
          </NavLink>
        ))}
      </div>
    </>
  );
}
