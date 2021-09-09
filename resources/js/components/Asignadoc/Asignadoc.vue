<template>
  <div>
    <h1 class="text-center">Gestionar Asisnación Docente</h1>
    <!-- Button to Open the Modal -->
    <div>
      <label for="buscando">Buscar:</label>
      <input v-model="buscar" type="text" v-on:keyup.enter="buscardata();" class="form-control" id="buscar" placeholder="Buscar Nombre y Apellido">
      <button v-on:keyup.enter="buscardata();" @click="buscardata();" type="button" class="btn btn-success" data-dismiss="modal">Buscar</button>

      <table class="table table-secondary">
        <thead class="thead-light">
          <tr>
           <th scope="col">#</th>
            <th scope="col">DNI</th>          
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col" class="text-center">Accion</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="doc in docentes.data" :key="doc.id">
            <td>{{ doc.dni_doc }}</td>
            <td>{{ doc.nom_doc }}</td>
            <td>{{ doc.ape_doc }}</td>     
            <th class="text-center">
              <button @click="modificar=false; abrirModal(doc);" type="button" class="btn btn-primary my-4">Asignar</button> 
            </th>
          </tr>
        </tbody>
        </table>
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

          <!-- Modal body v-on:keyup.enter="buscarcedula();" @click="buscarcedula();" -->
          <div class="modal-body">
          <v-row>
         
          <v-col cols="12" md="6">

            <div class="my-4">
                <label for="bus">DNI: {{ asignadoc.dni }}</label>
            </div>

            <div class="my-4">
              <label for="periodo">Periodo</label>
              <v-select v-model="asignadoc.periodo" :items= "peri" item-text="peri_per" item-value="id" dense solo id="id" ></v-select>
            </div>
                       
            <div class="my-4">
                <label for="seccion">Sección</label>
                <v-select v-model="asignadoc.seccion" :items= "sec" item-text="nom_sec" item-value="id" dense solo id="id" ></v-select>                
            </div>
          
            <div class="my-4">
                <label for="materia">Curso</label>
                <v-select @change="changedValue" v-model="asignadoc.curso" :items= "curso" item-text="nom_cur" item-value="id" dense solo id="id" ></v-select>                
            </div>

          </v-col>
          <v-col cols="12" md="6">

            <div class="my-4">
                <label for="dni">Docente: {{ asignadoc.nomape }}</label>
            </div>            

            <div class="my-4">
                <label for="materia">Materia</label>
                <v-select v-model="asignadoc.materia" :items= "mate2" item-text="nom_mat" item-value="id" dense solo id="id" ></v-select>                
            </div>
           
            <div class="my-4">
                <label for="seccion">Aula</label>
                <v-select v-model="asignadoc.aula" :items= "aula" item-text="num_aul" item-value="id" dense solo id="ida" ></v-select>                
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
           
          <th scope="col">Docente</th>     
          <th scope="col">Periodo</th>
          <th scope="col">Sección</th>
          <th scope="col">Materia</th>
          <th scope="col">Aula</th>                    
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="asidoc in asignadoc.data" :key="asidoc.id">
          <td >
            <span v-for="(n,indice) in asidoc.docente" :key="indice">
                {{n.nom_doc}} {{n.ape_doc}}
            </span>  
          </td>
          <td >
            <span v-for="(n,indice) in asidoc.periodo" :key="indice">
                {{n.ano_per}}
            </span>  
          </td> 
          <td >
            <span v-for="(n,indice) in asidoc.seccion" :key="indice">
                {{n.cod_sec}}
            </span>  
          </td>
          <td >
            <span v-for="(n,indice) in asidoc.materia" :key="indice">
                {{n.nom_mat}}
            </span>  
          </td>   
          <td >
            <span v-for="(n,indice) in asidoc.aula" :key="indice">
                {{n.num_aul}}
            </span>  
          </td>
          <td>
            <button  @click="modificar=true; abrirModal(asidoc);" class="btn btn-warning">Cambiar</button>
          </td>
          <td>
            <button @click="eliminar(asidoc.id)" class="btn btn-danger">
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
      asignadoc:{   },
      docentes: [],
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      asidoc: [],
      doc: [],
      peri: [ ],
      cur: [ ],
      aula: [ ],
      sec: [ ],
      mate: [ ],
      mate2: [ ],
      curso: [ ],
      dni: [ ],
      buscar:'',
      buscarmate:'',
      dnidoc:'',
      dninomape:'',

    };
  },
  methods: {
    async listar() {

      const res = await axios.get('http://127.0.0.1:8000/api/asignadoc');
      this.asignadoc = res.data;
      
      const resperi = await axios.get('http://127.0.0.1:8000/api/periodo');
      this.peri = resperi.data.data;

      const rescur = await axios.get('http://127.0.0.1:8000/api/curso');
      this.cur = rescur.data.data;

      const resaula = await axios.get('http://127.0.0.1:8000/api/aula');
      this.aula = resaula.data.data;

      const ressec = await axios.get('http://127.0.0.1:8000/api/seccion');
      this.sec = ressec.data.data;

      const rescurso = await axios.get('http://127.0.0.1:8000/api/curso');
      this.curso = rescurso.data.data;

    },

     async listarmateria(id) {

      const resmate = await axios.get('http://127.0.0.1:8000/api/curso/' + id);
      this.mate = resmate.data.data;
       this.mate2 = this.mate.materia;
     },
    async eliminar(id) {
      const res = await axios.delete('http://127.0.0.1:8000/api/asignadoc/' + id);
      this.listar();
    },

    async guardar() {
      if(this.modificar){
        const res = await axios.put('http://127.0.0.1:8000/api/asignadoc/'+ this.id, { 
          
          'docente_id': this.asignadoc.id,
          'periodo_id': this.asignadoc.periodo,
          'seccion_id': this.asignadoc.seccion,
          'materia_id': this.asignadoc.materia,
          'curso_id': this.asignadoc.curso,
          'aula_id': this.asignadoc.aula,
          
         });

      }else{
        const res = await axios.post('http://127.0.0.1:8000/api/asignadoc/', { 
         
          'id': this.update,
          'docente_id': this.asignadoc.id,
          'periodo_id': this.asignadoc.periodo,
          'seccion_id': this.asignadoc.seccion,
          'materia_id': this.asignadoc.materia,
          'curso_id': this.asignadoc.curso,
          'aula_id': this.asignadoc.aula,

         });
      }

    this.cerrarModal();
      this.listar();
    },
    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Asignación";
        this.dnidoc = data.docente.map(function(docente) {    
        return docente.dni_doc
        });
        this.asignadoc.dni=this.dnidoc.toString();
        this.dninomape=data.docente.map(function(docente) {    
        return docente.nom_doc + " " + docente.ape_doc
        });
        this.asignadoc.nomape=this.dninomape.toString();
        this.asignadoc.id=data.docente_id;
        this.asignadoc.periodo=data.periodo_id;
        this.asignadoc.seccion=data.seccion_id;
        this.asignadoc.materia=data.materia_id;
        this.asignadoc.curso=data.curso_id;
        console.log(this.asignadoc.curso);
        this.asignadoc.aula=data.aula_id;
        
      }else{
        this.id=0;
        this.tituloModal="Crear Asignación";
        this.asignadoc.id=data.id;
        this.asignadoc.dni= data.dni_doc;   
        this.asignadoc.nomape=data.nom_doc + " " + data.ape_doc;
        this.asignadoc.periodo='';
        this.asignadoc.seccion='';
        this.asignadoc.materia='';
        this.asignadoc.curso='';
        this.asignadoc.aula='';

      }
    },

    async buscardata(){

      const resdoc = await axios.get('http://127.0.0.1:8000/api/docente', {
      params: {
        name: this.buscar
      }
    });

      this.docentes = resdoc.data;   
      if(Object.keys(this.docentes.data).length === 0){
        alert('El DOCENTE NO EXISTE');           
      }
    },
    changedValue: function(value) {
     
      this.listarmateria(this.asignadoc.curso);

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