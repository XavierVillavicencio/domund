import React from "react";

export const DefaultInput = ({
  customClass = "",
  label,
  type,
  value,
  inputName,
  onChange,
  placeholder,
  error,
  required = true,
  min = "1",
}) => {
  return (
    <div className={`mb-3 ${customClass}`}>
      <label htmlFor={inputName} className="form-label fw-bold">
        {label}
      </label>
      <input
        type={type}
        className={`form-control ${error && "is-invalid"}`}
        id={inputName}
        name={inputName}
        value={value}
        onChange={onChange}
        placeholder={placeholder}
        required={required}
        minLength={min}
        autoComplete="off"
      />
      {error && <p className="mt-2 text-danger w-100 mb-0">{error}</p>}
    </div>
  );
};

export const DefaultDate = ({
  customClass = "",
  label,
  type,
  value,
  inputName,
  onChange,
  error,
  required = true,
  mb = "3",
}) => {
  return (
    <div className={`mb-${mb} ${customClass}`}>
      <label htmlFor={inputName} className="form-label fw-bold">
        {label}
      </label>
      <input
        type="date"
        className={`form-control ${error && "is-invalid"}`}
        name={inputName}
        id={inputName}
        value={value}
        onChange={onChange}
        required={required}
        autoComplete="off"
      />
      {error && <p className="mt-2 text-danger w-100 mb-0">{error}</p>}
    </div>
  );
};

export const DefaultInputHorizontal = ({
  colSize,
  label,
  type,
  value,
  inputName,
  onChange,
  placeholder,
  error,
  required = true,
  min = "5",
}) => {
  return (
    <div className={`row mb-3 align-items-center ${colSize}`}>
      <label htmlFor={inputName} className="col-sm-2 col-form-label fw-bold">
        {label}
      </label>
      <div className="col-sm-10">
        <input
          type={type}
          className={`form-control ${error && "is-invalid"}`}
          id={inputName}
          name={inputName}
          value={value}
          onChange={onChange}
          placeholder={placeholder}
          required={required}
          minLength={min}
        />
      </div>
      {error && (
        <p className="mt-2 text-danger w-100 col-sm-10 offset-2 mb-0">
          {error}
        </p>
      )}
    </div>
  );
};

export const DefaultTextarea = ({
  label,
  value,
  inputName,
  onChange,
  placeholder,
  error,
  rows = "5",
  required = true,
}) => {
  return (
    <div className="mb-3">
      <label htmlFor={inputName} className="form-label fw-bold">
        {label}
      </label>
      <textarea
        className={`form-control ${error && "is-invalid"}`}
        id={inputName}
        name={inputName}
        value={value}
        onChange={onChange}
        placeholder={placeholder}
        required={required}
        rows={rows}
        style={{ resize: "none" }}
      />
      {error && <p className="mt-2 text-danger w-100 mb-0">{error}</p>}
    </div>
  );
};

export const DefaultCheckbox = ({
  label,
  value,
  inputName,
  onChange,
  error,
}) => {
  return (
    <div className="form-check">
      <input
        className="form-check-input"
        type="checkbox"
        id={inputName}
        name={inputName}
        checked={value}
        onChange={onChange}
      />
      <label className="form-check-label" htmlFor={inputName}>
        {label}
      </label>
      {error && (
        <span className="text-danger d-block w-100 fw-bold">{error}</span>
      )}
    </div>
  );
};

export const DefaultSelect = ({
  customClass = "",
  label,
  inputName,
  defaultValue,
  onChange,
  error,
  required = true,
  options,
  placeholder,
}) => {
  return (
    <div className={`mb-3 ${customClass}`}>
      <label htmlFor={inputName} className="form-label fw-bold">
        {label}
      </label>
      {options.length > 0 && (
        <select
          required={required}
          className={`form-select ${error && "is-invalid"}`}
          onChange={onChange}
          name={inputName}
          aria-label="Select input"
          defaultValue={defaultValue}
        >
          {!defaultValue && <option value="0">{placeholder}</option>}
          {options.map((item) => (
            <option key={item.value} value={item.value}>
              {item.name}
            </option>
          ))}
        </select>
      )}
      {error && <p className="mt-2 text-danger w-100 mb-0">{error}</p>}
    </div>
  );
};

export const DefaultFile = ({
  customClass = "",
  label,
  inputName,
  extensions,
  error,
  onChange,
  mb = "3",
}) => {
  return (
    <div className={`mb-${mb} ${customClass}`}>
      <label htmlFor={inputName} className="form-label fw-bold">
        {label}
      </label>
      <input
        className={`form-control ${error && "is-invalid"}`}
        type="file"
        name={inputName}
        accept={extensions}
        onChange={onChange}
      />
      {error && <p className="mt-2 text-danger w-100 mb-0">{error}</p>}
    </div>
  );
};

/*
  Default INPUT component usage

  <DefaultInput
    label=""
    type=""
    value={}
    inputName=""
    onChange={}
    placeholder=""
    error={}
  />

*/

/*
  Default SELECT INPUT component usage

  <DefaultSelect
    label=""
    value={}
    inputName=""
    placeholder=""
    onChange={}
    error=""
    options={}
  />

*/
