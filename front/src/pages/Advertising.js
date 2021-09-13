import React from "react";

import ContentContainer from "components/layout/ContentContainer";
import ProductCard from "components/Common/ProductCard";

const data = [
  {
    id: 1,
    nombreProd: "Netflix",
    miniatura:
      "https://conexiontc.com/wp-content/uploads/2020/10/WhatsApp-Image-2020-10-24-at-11.25.57.jpeg",
  },
  {
    id: 2,
    nombreProd: "DisneyPlus",
    miniatura:
      "https://conexiontc.com/wp-content/uploads/2020/10/WhatsApp-Image-2020-10-24-at-11.25.57.jpeg",
  },
];

export default function Returns() {
  const clg = () => {
    console.log("Publicidad!");
  };

  return (
    <ContentContainer>
      <h1 className="py-5">Publicidad</h1>

      <div className="d-flex flex-wrap align-items-center justify-content-evenly w-100 gap-3">
        {data.map((item) => (
          <ProductCard
            setActive={clg}
            key={item.id}
            name={item.nombreProd}
            src={item.miniatura}
          />
        ))}
      </div>
    </ContentContainer>
  );
}
