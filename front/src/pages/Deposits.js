import React from "react";

import ContentContainer from "components/layout/ContentContainer";
import Form from "components/Deposits/Form";

export default function Home() {
  return (
    <ContentContainer>
      <h1 className="py-5">Depósitos</h1>

      <Form />
    </ContentContainer>
  );
}
