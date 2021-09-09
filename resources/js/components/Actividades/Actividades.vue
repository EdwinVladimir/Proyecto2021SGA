<template>
  <div>
    <h1 class="text-center">Gestionar Actividades de Evaluación</h1>

    <!-- Button to Open the Modal -->
    <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">Planificar</button>
    
    <div class="my-4">
        <label for="buscar">Buscar:</label>
        <input v-model="buscar" type="text" v-on:keyup.enter="buscardata();" class="form-control" id="buscar" placeholder="Buscar Nombre y Apellido">
        <button v-on:keyup.enter="buscardata();" @click="buscardata();" type="button" class="btn btn-success" data-dismiss="modal">Buscar</button>
    </div>

    <!-- The Modal -->
    <div class="modal" :class="{mostrar: modal}">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">{{tituloModal}}</h4>
            <button @click="cerrarModal();"  type="button" class="close" data-dismiss="modal">
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">

        <v-row>
          <v-col cols="14" md="6">

            <div class="my-4">
              <label for="dni">Docente</label>
              <input v-model="actividadeva.docente" type="text" class="form-control" id="id" placeholder="Docente">
            </div>
            
            <div class="my-4">
              <label for="periodo">Periodo</label>
              <v-select v-model="actividadeva.periodo" :items= "peri" item-text="peri_per" item-value="id" dense solo id="id" ></v-select>
            </div>

             <div class="my-4">
                <label for="materia">Materia</label>
                <v-select v-model="actividadeva.materia" :items= "mate" item-text="nom_mat" item-value="id" dense solo id="id" ></v-select>                
            </div>

             <div class="my-4">
              <label for="fecplan">Fecha del Plan</label>
              <input v-model="actividadeva.fecent_plaeva" type="date" class="form-control" id="fecent_plaeva" placeholder="fecent_plaeva">
            </div>

            </v-col>
            <v-col cols="14" md="4">

             <div class="my-4">
              <label for="tipactividad">Tipo de Actividad:</label>
              <v-select v-model="actividadeva.tipoactividad" :items= "tipact" item-text="nom_actividad" item-value="id" dense solo id="id" ></v-select>                
            </div>

             <div class="my-4">
              <label for="descripcion">Descripción</label>
              <input v-model="actividadeva.descripcion" type="text" class="form-control" id="descripcion" placeholder="descripcion">
            </div>

             <div class="my-4">
              <label for="porevalua">% de Evaluación</label>
              <input v-model="actividadeva.porcevaluacion" type="text" class="form-control" id="porcevaluacion" placeholder="porcevaluacion">
            </div>

            </v-col>
          </v-row>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancelar
            </button>
            <button  @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">
              Guardar
            </button>

          </div>
        </div>
      </div>
    </div>
  </div>
  
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Docente</th>
          <th scope="col">Periodo</th>
          <th scope="col">Materia</th>
          <th scope="col">Fecha del Plan</th>
          <th scope="col">Tipo de Actividad</th>
          <th scope="col">Descripción</th>
          <th scope="col">% Evaluación</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aceva in actividadeva.data" :key="aceva.id">
          <th scope="row">{{ aceva.id }}</th>
          <td>{{ aceva.docente }}</td>
          <td>{{ aceva.periodo }}</td>
          <td>{{ aceva.materia }}</td>
          <td>{{ aceva.fecent_plaeva }}</td>
          <td>{{ aceva.tipoactividad }}</td>
          <td>{{ aceva.descripcion }}</td>
          <td>{{ aceva.porcevaluacion }}</td>

          <td>
            <button  @click="modificar=true; abrirModal(aceva);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(aceva.id)" class="btn btn-danger">
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      actividadeva:{ },
      docentesci:{ },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      aceva: [],
      //evalua: ['APORTE INDIVIDUAL ! Evaluaciones unidades', 'APORTE INDIVIDUAL ! Evaluación final', 'APORTE GRUPAL ! APE. Trabajos grupales', 'APORTE GRUPAL ! APE. Practica Exposiciones ', 'ACTITUD ANDRAGOGICA ! APE. Trabajos grupales'],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('http://127.0.0.1:8000/api/planeva/');
      this.actividadeva = res.data;
    },

    async eliminar(id) {
      const res = await axios.delete('http://127.0.0.1:8000/api/planeva/' + id);
      this.listar();
    },
    
    async buscarci() {   
      console.log(this.docentes.dni);  
      const res = await axios.get('http://127.0.0.1:8000/api/docente', {
      params: {
        name: this.docentes.dni
      }
      });
      this.docentesci = res.data;
      if(Object.keys(this.docentesci.data).length === 1){
        alert('El DNI existe');       
      }else{
        alert('Autorizado para registrar al Docente');       
      }
    },

    async guardar() {
      if(this.modificar){
        const res = await axios.put('http://127.0.0.1:8000/api/planeva/' + this.id, { 
          
          'docente_id': this.actividadeva.docente,
          'periodo_id': this.actividadeva.periodo,
          'materia_id': this.actividadeva.materia,    
          'fecent_plaeva': this.actividadeva.fecent_plaeva,   
          'tipoact_acti': this.actividadeva.tipoactividad,   
          'descrip_detal': this.actividadeva.descripcion,   
          'poeva_detal': this.actividadeva.porcevaluacion,   
         });


      }else{
        const res = await axios.post('http://127.0.0.1:8000/api/planeva/', { 
         
          'id': this.update,
          'docente_id': this.actividadeva.docente,
          'periodo_id': this.actividadeva.periodo,
          'materia_id': this.actividadeva.materia,    
          'fecent_plaeva': this.actividadeva.fecent_plaeva,   
          'tipoact_acti': this.actividadeva.tipoactividad,   
          'descrip_detal': this.actividadeva.descripcion,   
          'poreva_detal': this.actividadeva.porcevaluacion,     

         
         });
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Plan de Actividades";
        this.actividadeva.docente=data.docente_id;
        this.actividadeva.periodo=data.periodo_id;
        this.actividadeva.materia=data.materia_id;
        this.actividadeva.fecent_plaeva=data.fecent_plaeva;
        this.actividadeva.tipoactividad=data.tipoact_acti;
        this.actividadeva.descripcion=data.descrip_detal;
        this.actividadeva.porcevaluacion=data.poreva_detal;

      }else{
        this.id=0;
        this.tituloModal="Crear Plan de Actividades";
        this.actividadeva.docente_id='';
        this.actividadeva.periodo_id='';
        this.actividadeva.materia_id='';
        this.actividadeva.fecent_plaeva='';
        this.actividadeva.tipoact_acti='';
        this.actividadeva.descrip_detal='';
        this.actividadeva.poreva_detal='';

      }
    },
    cerrarModal(){
      this.modal=0;
    },
  },
  created() {
    this.listar();
  },
};
</script>

<style>
  .mostrar{
    display: list-item;
    opacity: 1;
    background: rgba(75, 56, 143, 0.705);
  }
</style>