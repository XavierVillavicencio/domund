import React from "react";

export default function CloseToExpirationModal({
  refresh,
  logout,
  isRefreshing,
  setIsRefreshing,
}) {
  const handleRefresh = () => {
    setIsRefreshing(true);

    refresh();
  };

  return (
    <div
      className="modal fade"
      id="CloseToExpiration"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabIndex="-1"
      aria-labelledby="CloseToExpirationLabel"
      aria-hidden="true"
    >
      <div className="modal-dialog modal-dialog-centered">
        <div className="modal-content bg-dark">
          <div className="modal-header border-bottom-0">
            <h5
              className="modal-title text-uppercase text-warning"
              id="CloseToExpirationLabel"
            >
              Advertencia
              <i className="fas fa-exclamation-triangle ms-2"></i>
            </h5>
          </div>
          <div className="modal-body d-flex flex-column align-items-center justify-content-center p-5">
            <h3 className="text-center text-white">
              Su sesión se cerrará en 60 segundos
            </h3>
            <h4 className="mb-0 text-white text-center fw-light">
              ¿ Desea mantener su sesión ?
            </h4>
          </div>
          <div className="modal-footer d-flex align-items-center justify-content-center border-top-0">
            <button
              type="button"
              className="btn btn-success"
              disabled={isRefreshing ? true : false}
              onClick={handleRefresh}
            >
              {isRefreshing ? (
                <div className="d-flex align-items-center justify-content-center">
                  <div
                    className="spinner-border text-dark"
                    role="status"
                    style={{ width: "1.5em", height: "1.5em" }}
                  >
                    <span className="visually-hidden">Loading...</span>
                  </div>
                </div>
              ) : (
                "Continuar sesión"
              )}
            </button>

            <button
              type="button"
              className="btn btn-danger"
              disabled={isRefreshing ? true : false}
              onClick={logout}
            >
              Cerrar sesión
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
