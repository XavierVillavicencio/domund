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
  [
    {
      link: "/datos",
      name: "Dashboard",
      icon:"fas fa-tachometer-alt" // <i class="fas fa-tachometer-alt"></i>
    },
    {
      link: "/condos",
      name: "Condominios",
      icon:"fas fa-building" // <i class="fas fa-building"></i>
    },
    {
      link: "/datos",
      name: "Unidades Habitacionales", // <i class="fas fa-person-booth"></i>
      icon:"fas fa-person-booth"
    },
    {
      link: "/datos",
      name: "Contactos",
      icon:"fas fa-address-book" // <i class="far fa-address-book"></i>
    },
    {
      link: "/datos",
      name: "Servicios Básicos",
      icon:"fas fa-tint"
    },
    {
      link: "/datos",
      name: "Proveedores", // <i class="fas fa-people-arrows"></i>
      icon:"fas fa-people-arrows"
    },
    {
      link: "/datos",
      name: "Guardianía", // <i class="fas fa-people-arrows"></i> <i class="fas fa-sitemap"></i>
      icon:"fas fa-user-tie"
    },
    {
      link: "/datos",
      name: "Áreas comunales", // <i class="fas fa-people-arrows"></i>
      icon:"fas fa-futbol"
    },
    {
      link: "/datos",
      name: "Directiva", // <i class="fas fa-people-arrows"></i>
      icon:"fas fas fa-sitemap"
    },
    {
      link: "/datos",
      name: "Biblioteca Virtual",
      icon:"fas fa-book"
    },
    {
      link: "/datos",
      name: "Configuración",
      icon:"fas fa-wrench"
    },
    {
      link: "/datos",
      name: "Mis Datos", 
      icon:"fas fa-sign-out-alt" // <i class="fas fa-sign-out-alt"></i>
    },
  ],
];

export default RouterData;
