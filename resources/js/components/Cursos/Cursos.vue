<template>
  <div>
    <h1 class="text-center">Gestionar Cursos</h1>
 
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
              <label for="codigo">Codigo</label>
              <input v-model="curso.codigo" type="text" class="form-control" id="codigo" placeholder="Codigo del Curso">
            </div>
             <div class="my-4">
              <label for="nombre">Nombre</label>
              <input v-model="curso.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del Curso">
            </div>

            <div class="my-4">
              <label for="ejecurso">Eje Curso</label>
              <v-select v-model="curso.ejecurso" :items= "eje" item-text="nom_ejecurso" item-value="id" dense solo id="ejecurso" ></v-select>
            </div>
          
          
          <div class="my-4">
              <label for="stock">Tipo de Curso</label>
              <v-select v-model="curso.tipocurso" :items= "tipo" item-text="nom_curso" item-value="id" dense solo id="tipocurso" ></v-select>
          </div>
          
          </v-col>
          <v-col cols="14" md="6">

            <div class="my-4">
              <label for="ejecurso">Area del Curso</label>
              <v-select v-model="curso.areacurso" :items= "area" dense solo id="narea_cur" ></v-select>
            </div>

            <div class="my-4">
              <label for="materia">Materias</label>
              <v-select  v-model="vectormaterias" :items=mate :menu-props="{ maxHeight: '400' }" item-text="nom_mat" item-value="id" id="materia" multiple chips ></v-select>
            </div>
            
            <div class="my-4">
              <label for="horacurso">Horas del Curso</label>
              <input v-model="curso.horacurso" type="number" class="form-control" id="horacurso" placeholder="Hora del Curso">
            </div>
          </v-col>
          </v-row>

          <!-- Modal footer -->
          <div class="modal-footer" >
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
          <th scope="col">Codigo</th>
          <th scope="col">Nombre</th>
          <th scope="col">Eje</th>
          <th scope="col">Area</th>
          <th scope="col">Tipo</th>
          <th scope="col">Materias</th>
          <th scope="col">Número de Horas</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="curs in curso.data" :key="curs.id">
          <th scope="row">{{ curs.id }}</th>
          <td>{{ curs.cod_cur }}</td>
          <td>{{ curs.nom_cur }}</td>

          <td >
            <span v-for="(n,indice) in curs.ejecursos" :key="indice">
                {{n.nom_ejecurso}}
            </span>  
          </td>
          <td>{{ curs.narea_cur }}</td>
          <td >
            <span v-for="(m,indice) in curs.tipocursos" :key="indice">
                {{m.nom_curso}}
            </span>  
          </td> 

          <td >
            <ul >
           <li v-for="(n,indice) in curs.materia" :key="indice">
              {{n.nom_mat}}
            </li>
           </ul>  
          </td>
          <td>{{ curs.nhor_cur }}</td>                       
          <td>
            <button  @click="modificar=true; abrirModal(curs);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(curs.id)" class="btn btn-danger">
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
      curso:{  },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      curs: [ ],
      eje: [ ],
      tipo: [ ],
      area: ['Sociales', 'Humana', 'Tecnología', 'Industrial'],
      mate: [ ],
      vectormaterias: [ ],

    };
},


//******************************* */
   

  methods: {

    async listar() {
      const res = await axios.get('http://127.0.0.1:8000/api/curso');
      this.curso = res.data;

      const resej = await axios.get('http://127.0.0.1:8000/api/ejecurso');
      this.eje = resej.data.data;

      const restip = await axios.get('http://127.0.0.1:8000/api/tipocurso');
      this.tipo = restip.data.data;

      //Carga las Materias
      const resmateria = await axios.get('http://127.0.0.1:8000/api/materia');
      this.mate = resmateria.data.data;   

    },
    async eliminar(id) {
      const res = await axios.delete('http://127.0.0.1:8000/api/curso/' + id);
      this.listar();
    },
    async guardar() {
      if(this.modificar){
        const res = await axios.put('http://127.0.0.1:8000/api/curso/'+ this.id, { 
          
          'cod_cur'   : this.curso.codigo,
          'nom_cur'   : this.curso.nombre,
          'ejecurso_id'   : this.curso.ejecurso,
          'tipocurso_id'  : this.curso.tipocurso,
          'narea_cur' : this.curso.areacurso,
          'nhor_cur'  : this.curso.horacurso,
          'materia_id': this.vectormaterias,

         });
      }else{
        const res = await axios.post('http://127.0.0.1:8000/api/curso/', { 
         
          'id'        : this.update,
          'cod_cur'   : this.curso.codigo,
          'nom_cur'   : this.curso.nombre,
          'ejecurso_id'   : this.curso.ejecurso,
          'tipocurso_id'  : this.curso.tipocurso,
          'narea_cur' : this.curso.areacurso,
          'nhor_cur'  : this.curso.horacurso,
          'materia_id': this.vectormaterias,
         
         });
         
      }
      this.cerrarModal();
      this.listar();

    },

    abrirModal(data=null){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Curso";
        this.curso.codigo=data.cod_cur;
        this.curso.nombre=data.nom_cur;
        this.curso.areacurso=data.narea_cur;
        this.curso.horacurso=data.nhor_cur;
        this.curso.ejecurso=data.ejecurso_id;
        this.curso.tipocurso=data.tipocurso_id;
        this.vectormaterias=data.materia.map(function(materia) {    
       return materia.id
       });
       }else{
        this.id=0;
        this.id=data.id;
        this.tituloModal="Nuevo Curso";
        this.curso.codigo='';
        this.curso.nombre='';
        this.curso.areacurso='';
        this.curso.horacurso='';
        this.curso.ejecurso='';
        this.curso.tipocurso='';
        this.vectormaterias='';

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