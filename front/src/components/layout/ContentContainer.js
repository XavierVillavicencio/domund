import React from "react";

import "styles/ContentContainer.css";

export default function ContentContainer({ children }) {
  return (
    <section className="content-container d-flex flex-column flex-grow-1 align-items-center p-2">
      {children}
    </section>
  );
}
