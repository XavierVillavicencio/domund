/*

  ----- Explicación -----

  - Para que sea más fácil listar todas las rutas esta este archivo, que será listado por la navegación lateral
  y solo requerirá que se modifique aquí las rutas haciendolo más fácil de usar.

  - Cada grupo o "[]" dentro de RouterData creada un grupo separado y marcado dentro de la navegación lateral.
  - Dentro de cada grupo, para crear un link o ruta, basta con crear un objeto con su ruta en la key "link" y su
  nombre en "name".
  -Para crear una lista de rutas, se creará un objeto con el key "link", solo el nombre de la lista, y en la pro-
  piedad "childrens" se listara dentro de un "[]" las rutas de la misma forma que antes.

*/

const RouterData = [
  //grupo 1
  [
    {
      link: "/datos",
      name: "Condominios",
    },
    {
      link: "/datos",
      name: "Unidades Habitacionales",
    },
    {
      link: "/datos",
      name: "Residentes",
    },
    {
      link: "/datos",
      name: "Configuración",
    },
    {
      link: "/datos",
      name: "Mis Datos",
    },
  ],
];

export default RouterData;
