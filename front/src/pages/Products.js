import React, { useState } from "react";

import ContentContainer from "components/layout/ContentContainer";
import ProductCard from "components/Common/ProductCard";
import ProductForm from "components/Products/ProductForm";

const data = [
  {
    id: 1,
    nombreProd: "PS4",
    miniatura:
      "https://conexiontc.s3.amazonaws.com/static/cover/ps4_banner.jpg",
  },
  {
    id: 2,
    nombreProd: "BattleNet",
    miniatura: "http://spootmedia.com/wp-content/uploads/2020/12/CSGO.jpg",
  },
  {
    id: 3,
    nombreProd: "TV-Cable",
    miniatura: "http://spootmedia.com/wp-content/uploads/2020/12/CSGO.jpg",
  },
  {
    id: 4,
    nombreProd: "FREE FIRE",
    miniatura:
      "https://cflvdg.avoz.es/sc/H-z_NEEczx0gpVM7wCfYYRqcmZc=/x/2020/11/24/00121606214139375912911/Foto/videojuego.jpg",
  },
  {
    id: 5,
    nombreProd: "Movi",
    miniatura:
      "https://conexiontc.s3.amazonaws.com/static/logos/Paquete_Movistar.png",
  },
  {
    id: 6,
    nombreProd: "CNT",
    miniatura: "https://conexiontc.s3.amazonaws.com/static/logos/LOGO_CNT.png",
    claseCss: "",
  },
  {
    id: 16,
    nombreProd: "ESET",
    miniatura:
      "https://conexiontc.s3.amazonaws.com/static/logos/eset-profile.jpg",
    claseCss: "",
  },
  {
    id: 7,
    nombreProd: "DirectTV",
    miniatura:
      "https://conexiontc.s3.amazonaws.com/static/logos/LOGO_DIRECTV.png",
    claseCss: "",
  },
  {
    id: 8,
    nombreProd: "Tuenti",
    miniatura:
      "https://conexiontc.s3.amazonaws.com/static/logos/Paquete_Tuenti.png",
    claseCss: "",
  },
  {
    id: 9,
    nombreProd: "XBOX",
    miniatura:
      "https://conexiontc.s3.amazonaws.com/static/logos/xbox-profile.jpg",
    claseCss: "",
  },
  {
    id: 10,
    nombreProd: "Amazon",
    miniatura:
      "https://conexiontc.s3.amazonaws.com/static/logos/amazon-profile.jpg",
    claseCss: "",
  },
];

export default function Home() {
  const [activeProduct, setActiveProduct] = useState(null);

  return (
    <ContentContainer>
      <h1 className="py-5">Productos</h1>

      <div className="d-flex flex-wrap align-items-center justify-content-evenly w-100 gap-3">
        {!activeProduct ? (
          data.map((item) => (
            <ProductCard
              key={item.id}
              setActive={setActiveProduct}
              name={item.nombreProd}
              src={item.miniatura}
            />
          ))
        ) : (
          <ProductForm
            activeProduct={activeProduct}
            setProduct={setActiveProduct}
          />
        )}
      </div>
    </ContentContainer>
  );
}
