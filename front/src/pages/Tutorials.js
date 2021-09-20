import React from "react";

import ContentContainer from "components/layout/ContentContainer";

const data = [
  {
    id: 1,
    video: "https://www.youtube.com/embed/N9xruuKyzto",
    title: "Depósitos Plataforma CT Conexión y Tecnología",
  },
  {
    id: 2,
    video: "https://www.youtube.com/embed/TAOf5NvahDc",
    title: "Introducción CT Conexión y Tecnología",
  },
  {
    id: 3,
    video: "https://www.youtube.com/embed/_XQR_wIHbxA",
    title: "Regionalizar Cuenta de Google Play",
  },
];

export default function Tutorials() {
  return (
    <ContentContainer>
      <h1 className="py-5">Tutoriales</h1>

      <div className="w-100 d-flex flex-wrap justify-content-evenly align-items-center gap-5">
        {data.map((item) => (
          <iframe
            key={item.id}
            width="560"
            height="315"
            src={item.video}
            title={item.title}
            frameBorder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowFullScreen
          ></iframe>
        ))}
      </div>
    </ContentContainer>
  );
}
