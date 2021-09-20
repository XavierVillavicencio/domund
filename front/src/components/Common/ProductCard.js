import React from "react";

import "styles/ProductCard.css";

export default function ProductCard({ name, src, setActive }) {
  return (
    <div
      onClick={() => setActive({ name, src })}
      className="product-card card shadow"
      style={{ width: "18rem" }}
    >
      <img
        src={src}
        className="card-img-top"
        alt="logo"
        width="200"
        height="200"
        style={{ objectFit: "cover" }}
      />
      <div className="card-body">
        <h5 className="card-title text-center">{name}</h5>
      </div>
    </div>
  );
}
