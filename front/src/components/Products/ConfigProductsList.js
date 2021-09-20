import React from "react";

import ListHeaders from "./ListHeaders";
import ProductListItem from "./ProductListItem";

export default function ConfigProductsList() {
  return (
    <div className="w-100 d-flex flex-column mt-4">
      <ListHeaders />

      <ProductListItem />
      <ProductListItem />
      <ProductListItem />
    </div>
  );
}
