import React from "react";

export default function ProductListItem() {
  return (
    <div className="row w-100 mx-0 align-items-center border">
      <span className="col-1 text-center border-end py-2 word-break">1</span>
      <span className="col-5 text-center border-end py-2 word-break">
        80 CP ⚔️ CALL OF DUTY
      </span>
      <span className="col-2 text-center border-end py-2 text-truncate">
        $ 1.45
      </span>
      <span className="col-2 text-center border-end py-2 word-break">
        $ 1.75
      </span>
      <div className="col-2 d-flex align-items-center justify-content-center gap-2 py-2">
        <button className="btn btn-primary btn-sm">
          <i className="fas fa-dollar-sign px-1 me-2"></i>
          Vender
        </button>
      </div>
    </div>
  );
}
