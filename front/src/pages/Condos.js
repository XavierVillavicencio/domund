import React, { useState, useEffect } from "react";
import ContentContainer from "components/layout/ContentContainer";
import DateInputs from "components/Common/DateInputs";
import { DefaultInput,DefaultDate,DefaultFile } from "templates/input";

export default function Condos() {
  const [obsflag, setObsflag] = useState(true)
  const [list, setList] = useState([])

  const parseCondos = (result) => {
      let d = JSON.parse(result).datos
      console.info(d)
      let list = d.map((item) => {
        return (
          <div className="row mx-0 w-100 border-bottom py-2">
            <label className="col px-1 fs-6 text-center text-uppercase text-break">
              {item.con_text_name}
            </label>
            <label className="col px-1 fs-6 text-center text-uppercase text-break">
              {item.con_text_address}
            </label>
            <label className="col px-1 fs-6 text-center text-uppercase text-break">
              {item.con_date_creation_date}
            </label>
            <label className="col px-1 fs-6 text-center text-uppercase text-break">
              <div className="btn-group">
                <div className="btn btn-warning" onClick={(e) => getCondo(item.con_int_id)}  title="Editar"><i class="fas fa-edit"></i></div>
                <div className="btn btn-primary" data-id="{item.con_int_id}" title="Unidades Habitacionales"><i class="fas fa-person-booth"></i></div>
                <div className="btn btn-primary" data-id="{item.con_int_id}" title="Contactos"><i class="far fa-address-book"></i></div>
                <div className="btn btn-danger" data-id="{item.con_int_id}" title="Eliminar">
                <i class="fas fa-trash"></i>
                  </div>
              </div>
            </label>
          </div>
        )
      })
      setList(list)
  }

  const handleSave = async (e) =>{
    e.preventDefault();

    var myHeaders = new Headers();
    myHeaders.append("Authorization", "Basic dGVzdGNsaWVudDp0ZXN0c2VjcmV0");
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

    var urlencoded = new URLSearchParams();
    urlencoded.append("con_text_name", document.getElementById('con_text_name').value);
    urlencoded.append("con_text_ruc", document.getElementById('con_text_ruc').value);
    urlencoded.append("con_text_site", document.getElementById('con_text_site').value);
    urlencoded.append("con_text_address", document.getElementById('con_text_address').value);
    urlencoded.append("con_float_area", document.getElementById('con_float_area').value);
    urlencoded.append("con_text_email", document.getElementById('con_text_email').value);
    urlencoded.append("con_text_url", document.getElementById('con_text_url').value);
    urlencoded.append("con_date_license", document.getElementById('con_date_license').value);
    urlencoded.append("con_date_expiresms", document.getElementById('con_date_expiresms').value);

    var requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: urlencoded,
      redirect: 'follow'
    };

    fetch("https://domund.test/housing/condos", requestOptions)
      .then(response => response.text())
      .then(result => sendResult(result))
      .catch(error => console.log('error', error));
  }

  const sendResult = (result) => {
    let d = JSON.parse(result)
    console.info(d)
    if(d.error == 400){
      alert(d.messages)
    }else{
        alert(d.messages)
        let response = !obsflag
        setObsflag(response)
    }
    document.getElementById("addForm").reset();

  }

  const getCondo = (id) => {
    var myHeaders = new Headers();
    myHeaders.append("Authorization", "Basic dGVzdGNsaWVudDp0ZXN0c2VjcmV0");
    var requestOptions = {
      method: 'GET',
      headers: myHeaders,
      redirect: 'follow'
    };

    fetch("https://domund.test/housing/condos/"+id, requestOptions)
      .then(response => response.text())
      .then(result => parseCondo(result))
      .catch(error => console.log('error', error));
  }

  const parseCondo = (result) => {
    console.info(result)
  }

  const GetCondos = () => {
    var myHeaders = new Headers();
    myHeaders.append("Authorization", "Basic dGVzdGNsaWVudDp0ZXN0c2VjcmV0");
    var requestOptions = {
      method: 'GET',
      headers: myHeaders,
      redirect: 'follow'
    };
    fetch("https://domund.test/housing/condos", requestOptions)
      .then(response => response.text())
      .then(result => parseCondos(result))
      .catch(error => console.error('error', error));
  }

  useEffect(() => {
    GetCondos()
  },[obsflag])

  return (
    <ContentContainer>
      <h1 className="py-5">Condominios</h1>
      <button className="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <i className="fas fa-plus"></i> Agregar Condominio
      </button>
      <div id="collapseExample" className="collapse" data-parent="#collapseExample">
      <form id="addForm"  onSubmit={handleSave} className="w-100 row m-4 mx-0 border p-3" autoComplete="off">
        {/* row 1 */}
        <DefaultInput label="Nombre" inputName="con_text_name" customClass="col-4 mb-0" />
        <DefaultInput label="Cédula / RUC" inputName="con_text_ruc" customClass="col-4 mb-0" />
        <DefaultInput label="Lugar" inputName="con_text_site" customClass="col-4 mb-0" />
        <DefaultInput label="Dirección" inputName="con_text_address" customClass="col-4 mb-0" />
        {/* row 2 */}
        <DefaultInput label="Área (m2)" inputName="con_float_area" customClass="col-4 mb-0" />
        <DefaultInput label="E-mail" inputName="con_text_email" customClass="col-4 mb-0" />
        <DefaultInput label="URL" inputName="con_text_url" customClass="col-4 mb-0" />
        {/* row 3 */}
        <DefaultDate
          customClass="col-4 mb-0"
          label="Fecha de Licencia"
          inputName="con_date_license"
        />
        <DefaultDate
          customClass="col-4 mb-0"
          label="Fecha de Expiración SMS"
          inputName="con_date_expiresms"
        />
        <DefaultFile label="Imagen / Logotipo" inputName="con_text_image" customClass="col-4 mb-0" />
        <div class="col-4 mb-0">
          <br />
          <button className="btn btn-success">Enviar</button>
        </div>
      </form>
      </div>
      <form id="searchForm" className="w-100 d-flex flex-column" autoComplete="off">
        <div class="container">
            <div class="row">
              <DefaultInput label="Buscar" placeholder="Buscar nombre de condominio" customClass="col-6 mb-0" />
              <div class="col">
                <br />
                <button className="btn btn-info">Enviar</button>
              </div>
            </div>
        </div>
        <div className="row mx-0 w-100 mt-5 border-bottom pb-3">
      <label className="col px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Nombre
      </label>
      <label className="col px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Dirección
      </label>
      <label className="col px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Fecha de creación
      </label>
      <label className="col px-1 fs-6 text-center fw-bold text-uppercase text-break">
        Opciones
      </label>
    </div>
      {list}
    </form>
    </ContentContainer>
  );
}
