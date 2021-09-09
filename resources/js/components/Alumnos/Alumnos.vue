<template>

  <div>
    <h1 class="text-center">Gestionar Estudiantes</h1>
  
    <div class="my-4">
        <label for="buscar">Buscar: </label>
        <input v-model="buscar" type="text" v-on:keyup.enter="buscardata();" class="form-control" id="buscar" placeholder="Buscar Nombre y Apellido">
        <button v-on:keyup.enter="buscardata();" @click="buscardata();" type="button" class="btn btn-success" data-dismiss="modal">Buscar</button>
    </div>
    <!-- Button to Open the Modal -->
    <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">Nuevo</button>

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
              <label for="dni">DNI: </label>
              <input v-model="alumno.dni" type="text" v-on:keyup.enter="buscarcedula();" class="form-control" id="dni" placeholder="Dni del alumno">
               <button v-on:keyup.enter="buscarcedula();" @click="buscarcedula();" type="button" class="btn btn-info" data-dismiss="modal">Buscar</button>
            </div>           

            <div class="my-4">
              <label for="nombre">Nombre: </label>
              <input v-model="alumno.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del Alumno">
            </div>

            <div class="my-4">
              <label for="descripcion">Apellido: </label>
              <input v-model="alumno.apellido" type="text" class="form-control" id="apellido" placeholder="Apellido del Alumno">
            </div>

          <div class="my-4">
              <label for="especialidad">Especialidad</label>
              <v-select v-model="alumno.especialidad" :items= "espe" item-text="nom_especialidad" item-value="id" dense solo id="especialidad" ></v-select>
            </div>
          
            <div class="my-4">
              <label for="reparto">Reparto</label>
              <v-select v-model="alumno.reparto" :items= "repa" item-text="nom_reparto" item-value="id" dense solo id="reparto" ></v-select>
            </div>

            </v-col>
            <v-col cols="14" md="4">

            <div class="my-4">
              <label for="tipogrado">Grado</label>
              <v-select v-model="alumno.grado" :items= "grad" item-text="nom_grado" item-value="id" dense solo id="grado" ></v-select>
            </div>
 
           <div class="my-4">
              <label for="tiposangre">Tipo de Sangre</label>
              <v-select v-model="alumno.sangre" :items= "sang" item-text="nom_sangre" item-value="id" dense solo id="sangre" ></v-select>
            </div>
            
            <div class="my-4">
              <label for="lnacimiento">Lugar de Nacimiento</label>
              <input v-model="alumno.lnacimiento" type="text" class="form-control" id="lnacimiento" placeholder="Lugar de Nacimiento del Alumno">
            </div>         
            
            <div class="my-4">
              <label for="fnacimiento">Fecha de Nacimiento</label>
              <input v-model="alumno.fnacimiento" type="date" class="form-control" id="fnacimiento" placeholder="Fecha de Nacimiento del Alumno">
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
        <thead>
            <tr>
            <th scope="col">#</th>
      
            <th scope="col">DNI</th>
            <th scope="col">Grado</th>
            <th scope="col">Nombre</th>          
            <th scope="col">Apellido</th>
            <th scope="col">Especialidad</th>
            <th scope="col">Reparto</th> 
            <th scope="col">Tipo de Sangre</th>
            <th scope="col">Lugar de Nacimiento</th>     
            <th scope="col">Fecha de Nacimiento</th>       
            <th scope="col" colspan="2" class="text-center">Accion</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="alm in alumno.data" :key="alm.id">
            <th scope="row">{{ alm.id }}</th>
        
            <td>{{ alm.dni_al }}</td>
            <td>
                <span v-for="(n,indice) in alm.tipogrado_nom" :key="indice">
                    {{n.nom_grado}}
                </span> 
            </td>
            <td>{{ alm.nom_al }}</td>
            <td>{{ alm.ape_al }}</td>
            <td>
                <span v-for="(n,indice) in alm.especialidad_nom" :key="indice">
                    {{n.nom_especialidad}}
                </span> 
            </td>
            <td>
                <span v-for="(n,indice) in alm.reparto_nom" :key="indice">
                    {{n.nom_reparto}}
                </span> 
            </td>
            <td>
                <span v-for="(n,indice) in alm.tiposangre_nom" :key="indice">
                    {{n.nom_sangre}}
                </span> 
            </td>
            <td>{{ alm.lnac_al }}</td>    
            <td>{{ alm.fnac_al }}</td>   
        <td>
            <button  @click="modificar=true; abrirModal(alm);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(alm.id)" class="btn btn-danger">
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
  data(){
    return{
      alumno: { },
      alumnoci: { },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      buscar:'',
      alm: [ ],
      aul: [ ],
      repart: [ ],
      espe: [ ],
      repa: [ ],
      grad: [ ],
      sang: [ ],
    
    };
    
  },

  methods: {
    async listar() {
      const res = await axios.get('http://127.0.0.1:8000/api/alumno', {
      params: {
        name: this.buscar
      }
    });
      this.alumno = res.data;

      const resespe = await axios.get('http://127.0.0.1:8000/api/especialidad');
      this.espe = resespe.data.data;

      const resrepa = await axios.get('http://127.0.0.1:8000/api/reparto');
      this.repa = resrepa.data.data;

      const resgrad = await axios.get('http://127.0.0.1:8000/api/tipogrado');
      this.grad = resgrad.data.data;

      const ressang = await axios.get('http://127.0.0.1:8000/api/tiposangre');
      this.sang = ressang.data.data;
    },
    async eliminar(id) {
      const res = await axios.delete('http://127.0.0.1:8000/api/alumno/' + id);
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

    async eliminar(id) {
      const res = await axios.delete('http://127.0.0.1:8000/api/alumno/' + id);
      this.listar();
    },
    async guardar() {
      if(this.modificar){
        const res = await axios.put('http://127.0.0.1:8000/api/alumno/'+ this.id, { 
          
          'dni_al': this.alumno.dni,
          'nom_al': this.alumno.nombre,
          'ape_al': this.alumno.apellido,
          'especialidad_id': this.alumno.especialidad,
          'reparto_id': this.alumno.reparto,
          'tipogrado_id': this.alumno.grado,
          'tiposangre_id': this.alumno.sangre,
          'lnac_al': this.alumno.lnacimiento,
          'fnac_al': this.alumno.fnacimiento, 

         });

      }else{
        const res = await axios.post('http://127.0.0.1:8000/api/alumno/', { 
         
          'id': this.update,
          'dni_al': this.alumno.dni,
          'nom_al': this.alumno.nombre,
          'ape_al': this.alumno.apellido,
          'especialidad_id': this.alumno.especialidad,
          'reparto_id': this.alumno.reparto,
          'tipogrado_id': this.alumno.grado,
          'tiposangre_id': this.alumno.sangre,
          'lnac_al': this.alumno.lnacimiento,
          'fnac_al': this.alumno.fnacimiento, 
         
         });
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Alumno";
        this.alumno.dni=data.dni_al;
        this.alumno.nombre=data.nom_al;
        this.alumno.apellido=data.ape_al;
        this.alumno.especialidad=data.especialidad_id;
        this.alumno.reparto=data.reparto_id;
        this.alumno.grado=data.tipogrado_id;
        this.alumno.sangre=data.tiposangre_id;
        this.alumno.lnacimiento=data.lnac_al;
        this.alumno.fnacimiento=data.fnac_al;

      }else{
        this.id=0;
        this.tituloModal="Crear Alumno";
        this.alumno.dni='';
        this.alumno.nommbre='';
        this.alumno.apellido='';
        this.alumno.especialidad='';
        this.alumno.reparto='';
        this.alumno.grado='';
        this.alumno.sangre='';
        this.alumno.lnacimiento='';
        this.alumno.fnacimiento=' ';
      }
    },
    
    buscardata(){
      this.listar();
    },

    buscarcedula(){
      this.buscarci();
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



