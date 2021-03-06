/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
Vue.use(VueRouter);

import Vuetify from 'vuetify'
Vue.use(Vuetify);

import Datepicker from 'vuejs-datepicker';

import vuetify from './vuetify'
import GeneralGeneral from './components/General/General.vue'
import CalificacionesCalificaciones from './components/Calificaciones/Calificaciones.vue'
//  import AnasisdatosAnasisdatos from './components/Anasisdatos/Anasisdatos.vue'
import AlumnosAlumnos from './components/Alumnos/Alumnos.vue'
import AulasAulas from './components/Aulas/Aulas.vue'
import DocentesDocentes from './components/Docentes/Docentes.vue'
import MatriculacionMatriculacion from './components/Matriculacion/Matriculacion.vue'
import ActividadesActividades from './components/Actividades/Actividades.vue'
import EvaluacionesEvaluaciones from './components/Evaluaciones/Evaluaciones.vue'
import CursosCursos from './components/Cursos/Cursos.vue'
import SeccionSeccion from './components/Seccion/Seccion.vue'
import MateriasMaterias from './components/Materias/Materias.vue'
import PeriodosPeriodos from './components/Periodos/Periodos.vue'
import PlanesPlanes from './components/Planesestudios/Planesestudios.vue'
import AsignadocAsignadoc from './components/Asignadoc/Asignadoc.vue'
import ModalidadModalidad from './components/Modalidad/Modalidad.vue'
import RepartoReparto from './components/Reparto/Reparto.vue'
import EspecialidadEspecialidad from './components/Especialidad/Especialidad.vue'
import TipogradoTipogrado from './components/Tipogrado/Tipogrado.vue'
import TipocursoTipocurso from './components/Tipocurso/Tipocurso.vue'
import TiposangreTiposangre from './components/Tiposangre/Tiposangre.vue'
import EjecursoEjecurso from './components/Ejecurso/Ejecurso.vue'
import UsuarioUsuario from './components/Usuario/Usuario.vue'
import RolesRoles from './components/Roles/Roles.vue'
import PasswordPassword from './components/Password/Password.vue'
import SalirSalir from './components/Salir/Salir.vue'
    
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('Reparto-component', require('./components/Reparto/Reparto.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


 
 const app = new Vue({
   el: '#app',
   vuetify: new Vuetify(),
   Datepicker,
   
   components: { 
       AlumnosAlumnos,
       AulasAulas,
       CursosCursos,
       MateriasMaterias,
       PeriodosPeriodos,
       PlanesPlanes,
       AsignadocAsignadoc,
       ModalidadModalidad,
       SeccionSeccion,
       RepartoReparto,
       EspecialidadEspecialidad,
       TipogradoTipogrado,
       TipocursoTipocurso,
       TiposangreTiposangre,
       MatriculacionMatriculacion,
       ActividadesActividades,
       EvaluacionesEvaluaciones,
       GeneralGeneral,
       CalificacionesCalificaciones,
       EjecursoEjecurso,
       DocentesDocentes,
       UsuarioUsuario,
       RolesRoles,
       PasswordPassword,
       SalirSalir

    }
    
});

