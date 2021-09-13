import React from "react";

import ContentContainer from "components/layout/ContentContainer";
import DateInputs from "components/Common/DateInputs";
import TableHeaders from "components/Funds/TableHeaders";
import TableBody from "components/Funds/TableBody";

export default function Funds() {
  return (
    <ContentContainer>
      <h1 className="py-5">Transacciones de acreditación</h1>

      <form className="w-100 d-flex flex-column" autoComplete="off">
        <DateInputs />
        <TableHeaders />

        <TableBody />
        <TableBody />
        <TableBody />
        <TableBody />
      </form>
    </ContentContainer>
  );
}
