import React from "react";

import ContentContainer from "components/layout/ContentContainer";
import DateInputs from "components/Common/DateInputs";
import TableHeaders from "components/Common/TableHeaders";
import TableBody from "components/Common/TableBody";

export default function Returns() {
  return (
    <ContentContainer>
      <h1 className="py-5">Devoluciones</h1>

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
