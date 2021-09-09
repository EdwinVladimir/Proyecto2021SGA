<template>
  <div>
    <h1 class="text-center">Gestionar Calificaciones</h1>
    
    <!-- Button to Open the Modal -->
    <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">Registrar</button>
    
    <div class="my-4">
        <label for="buscar">Buscar: </label>
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
              <label for="dni">Alumno:</label>
              <input v-model="evaluacion.dni" type="text" class="form-control" id="dbi" placeholder="DNI del Estudiante">
            </div>

            <div class="my-4">
              <label for="tipoevalua">Periodo:</label>
              <input v-model="evaluacion.periodo" type="text" class="form-control" id="periodo" placeholder="Periodo del Estudiante">
            </div>

            <div class="my-4">
              <label for="tipoevalua">Materia</label>
              <input v-model="evaluacion.materia" type="text" class="form-control" id="materia" placeholder="Materia a registrar">
            </div>

              <!--  <div class="my-4">
              <label for="tipoevalua">Descripción</label>
              <input v-model="evaluacion.descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripción">
            </div> -->

            </v-col>
            <v-col cols="14" md="4">

            <div class="my-4">
              <label for="nota">Nota</label>
              <input v-model="evaluacion.nota" type="number" class="form-control" id="nota" placeholder="Nota del Estudiante">
            </div>
          
           
            <div class="my-4">
              <label for="fecplan">Fecha de Registro: </label>
              <input v-model="evaluacion.registro" type="date" class="form-control" id="fecent_registro" placeholder="fecent_registro">
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
          <th scope="col">Alumno</th>
          <th scope="col">Periodo</th>
          <th scope="col">Materia</th>
          <th scope="col">Nota</th>
          <th scope="col">Fecha de Registro</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="evalua in evaluacion.data" :key="evalua.id">
          <th scope="row">{{ evalua.id }}</th>
          <td>{{ evalua.dni_al }}</td>
          <td>{{ evalua.ano_per }}</td>
          <td>{{ evalua.materia_id }}</td>
          <td>{{ evalua.nota_deteva }}</td>
          <td>{{ evalua.fecreg_eval }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(evalua);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(evalua.id)" class="btn btn-danger">
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
      evaluacion:{   },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      evalua: [],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('/api/evaluac/');
      this.evaluacion = res.data;
    },
    async eliminar(id) {
      const res = await axios.delete('/api/evaluacion/' + id);
      this.listar();
    },

     async buscarci() {   

      const res = await axios.get('http://127.0.0.1:8000/api/alumno', {
      params: {
        name: this.alumno.dni
      }
      });
      this.alumnoci = res.data;
      if(Object.keys(this.alumnoci.data).length === 1){
        alert('El DNI existe');       
      }else{
        alert('Autorizado para registrar el Estudiante');       
      }
      //console.log(Object.keys(this.alumnoci.data).length);
    },

    async guardar() {
      if(this.modificar){
        const res = await axios.put('/api/evaluacion/' + this.id, { 

          'dni_al': this.evaluacion.dni,
          'ano_per': this.evaluacion.periodo,
          'materia_id': this.evaluacion.materia,    
          'nota_deteva': this.evaluacion.nota,   
          'fecreg_eval': this.evaluacion.registro,   
       });

      }else{
        const res = await axios.post('/api/evaluacion/', { 
         
          'id': this.update,
          'dni_al': this.evaluacion.dni,
          'ano_per': this.evaluacion.periodo,
          'materia_id': this.evaluacion.materia,    
          'nota_deteva': this.evaluacion.nota,   
          'fecreg_eval': this.evaluacion.registro,  
        });
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Evaluación";
        this.evaluacion.dni=data.dni_al;
        this.evaluacion.periodo=data.ano_per;
        this.evaluacion.materia=data.materia_id;
        this.evaluacion.nota=data.nota_deteva;
        this.evaluacion.registro=data.fecreg_eval;
      }else{
        this.id=0;
        this.tituloModal="Crear Evaluacion";
        this.evaluacion.dni_al='';
        this.evaluacion.periodo='';
        this.evaluacion.materia='';
        this.evaluacion.nota='';
        this.evaluacion.registro='';
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