<template>
  <div>
    <h1 class="text-center">Gestionar Matriculación</h1>
   
    <!-- Button to Open the Modal -->
    <button @click="modificar=false; vperiodo=true; abrirModal();" type="button" class="btn btn-primary my-4">Nuevo</button>
    <div>
      <label for="buscando">Buscar:</label>
      <input v-model="buscar" type="text" v-on:keyup.enter="buscardata();" class="form-control" id="buscar" placeholder="Buscar Nombre y Apellido">
      <button v-on:keyup.enter="buscardata();" @click="buscardata();" type="button" class="btn btn-success" data-dismiss="modal">Buscar</button>

      <table class="table table-secondary">
        <thead class="thead-light">
          <tr>
            <th scope="col">DNI</th>          
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col" class="text-center">Accion</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="alm in alumnos.data" :key="alm.id">
            <td>{{ alm.dni_al }}</td>
            <td>{{ alm.nom_al }}</td>
            <td>{{ alm.ape_al }}</td>     
            <th scope="col" class="text-center">
              <button @click="modificar=false; abrirModal(alm);" type="button" class="btn btn-primary my-4">Asignar</button> 
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

          <!-- Modal body -->
          <div class="modal-body">
          <div v-if="vperiodo">
          <v-row>
         
          <v-col cols="12" md="6">        

           <div class="my-4">
                <label for="bus">DNI: {{ matricula.dni }}</label>
            </div>

            <div class="my-4">
              <label for="dni">Periodo</label>
              <v-select v-model="matricula.periodo" :items= "per" item-text="peri_per" item-value="id" dense solo id="periodo_id" ></v-select>
            </div>  
            
            <div class="my-4">
              <label for="curso">Curso</label>
              <v-select v-model="matricula.curso" :items= "cur" item-text="nom_cur" item-value="id" dense solo id="curso_id" ></v-select>
            </div>

            </v-col>
            
            <v-col cols="12" md="6">      
            
            <div class="my-4">
                <label for="dni">Alumno: {{ matricula.nomape }}</label>
            </div>   

            <div class="my-4">
              <label for="seccion">Seccion</label>
              <v-select v-model="matricula.seccion" :items= "secc" item-text="nom_sec" item-value="id" dense solo id="seccion_id" ></v-select>
            </div>

            <div class="my-4">
              <label for="materia">Fecha de Inscripción</label>
              <input v-model="matricula.feins_matri" type="date" class="form-control" id="feins_matri" placeholder="feins_matri">
            </div>
            
        </v-col>
       </v-row>
          </div>  
      <div v-else>
        <table class="table table-striped">
      <thead class="thead-light">
        <tr>
          <th scope="col">Alumno</th>
          <th scope="col">Periodo</th>
          <th scope="col">Curso</th>
          </tr>
      </thead>
      <tbody>
        <tr v-for="vper in verperi.data" :key="vper.id">
          <td >
            <span v-for="(n,indice) in vper.alumno" :key="indice">
                {{n.nom_al}} {{n.ape_al}}
            </span>  
          </td>
          <td >
            <span v-for="(n,indice) in vper.periodo" :key="indice">
                {{n.ano_per}}
            </span>  
          </td>
          <td >
            <span v-for="(n,indice) in vper.curso" :key="indice">
                {{n.nom_cur}}
            </span>  
          </td>
        </tr>
      </tbody>
    </table>
      </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancelar
            </button>
            <button  v-if="vperiodo" @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">
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
          <th scope="col">Alumno</th>
          <th scope="col">Periodo</th>
          <th scope="col">Curso</th>
          <th scope="col">Sección</th>
          <th scope="col">Fecha de Inscripción</th>
          <th scope="col" colspan="3" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="matr in matricula.data" :key="matr.id">
          <td >
            <span v-for="(n,indice) in matr.alumno" :key="indice">
                {{n.nom_al}} {{n.ape_al}}
            </span>  
          </td>
          <td >
            <span v-for="(n,indice) in matr.periodo" :key="indice">
                {{n.ano_per}}
            </span>  
          </td>
          <td >
            <span v-for="(n,indice) in matr.curso" :key="indice">
                {{n.nom_cur}}
            </span>  
          </td>
          <td >
            <span v-for="(n,indice) in matr.seccion" :key="indice">
                {{n.cod_sec}}
            </span>  
          </td>
          <td>{{ matr.feins_matri }}</td>    
          <td>
            <button  @click="modificar=true; vperiodo=true; abrirModal(matr);" class="btn btn-warning">Cambiar</button>
          </td>
          <td>
            <button  @click="vperiodo=false; abrirModal(matr);" class="btn btn-primary">Ver Periodos</button>
          </td>
          <td>
            <button @click="eliminar(matr.id)" class="btn btn-danger">
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
      matricula:{   },
      verperi:{   },
      alumnos: [ ],
      id:0,
      modificar:true,
      vperiodo:true,
      modal:0,
      tituloModal:'',
      matr: [ ],
      alm: [ ],
      per: [ ],
      vper: [ ],
      cur: [ ],
      secc: [ ],
      dni: [ ],
      buscar:'',
      dnialu:'',
      dninomape:'',    

    };
  },
  methods: {
    async listar() {

      const res = await axios.get('http://127.0.0.1:8000/api/matricula/');
      this.matricula = res.data;

      const resper = await axios.get('http://127.0.0.1:8000/api/periodo/');
      this.per = resper.data.data;

      const rescur = await axios.get('http://127.0.0.1:8000/api/curso/');
      this.cur = rescur.data.data;

      const ressecc = await axios.get('http://127.0.0.1:8000/api/seccion/');
      this.secc = ressecc.data.data;

    },
    
    async eliminar(id) {
      const res = await axios.delete('http://127.0.0.1:8000/api/matricula/' + id);
      this.listar();
    },

     async verperiodo() {

      const resmatr = await axios.get('http://127.0.0.1:8000/api/matricula' , {
      params: {
        name: this.buscar
      }
    
    });

      this.verperi = resmatr.data;
      console.log(this.verperi);
    },

    async guardar() {
      if(this.modificar){
        const res = await axios.put('http://127.0.0.1:8000/api/matricula/' + this.id, { 
          
          'alumno_id': this.matricula.id,
          'periodo_id': this.matricula.periodo,
          'curso_id': this.matricula.curso,
          'seccion_id': this.matricula.seccion,
          'feins_matri': this.matricula.feins_matri,

         });

      }else{
        const res = await axios.post('http://127.0.0.1:8000/api/matricula/', { 
         
          'id': this.update,
          'alumno_id': this.matricula.id,
          'periodo_id': this.matricula.periodo,
          'curso_id': this.matricula.curso,
          'seccion_id': this.matricula.seccion,
          'feins_matri': this.matricula.feins_matri,
         
         });
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data={}){
      this.modal=1;

      if(this.vperiodo){

        if(this.modificar){
          this.id=data.id;
          this.tituloModal="Modificar Matricula";
          this.dnialu = data.alumno.map(function(alumno) {    
          return alumno.dni_al
          });
          this.matricula.dni=this.dnialu.toString();
          this.dninomape=data.alumno.map(function(alumno) {    
          return alumno.nom_al + " " + alumno.ape_al
          });
          this.matricula.nomape=this.dninomape.toString();
          this.matricula.periodo=data.periodo_id;
          this.matricula.id=data.alumno_id;
          this.matricula.curso=data.curso_id;
          this.matricula.seccion=data.seccion_id;
          this.matricula.feins_matri=data.feins_matri;
          
        }else{
          this.id=0;
          this.tituloModal="Crear Matricula";
          this.matricula.id=data.id;
          this.matricula.dni=data.dni_al;
          this.matricula.nomape=data.nom_al + " " + data.ape_al;
          this.matricula.periodo='';
          this.matricula.curso='';
          this.matricula.seccion='';
          this.matricula.feins_matri=now();
                
        }

      }else{
        this.tituloModal="Periodos";
        this.buscar = data.alumno_id
        this.verperiodo()
        console.log(this.buscar);
      }
    },

   async buscardata(){

      const resal = await axios.get('http://127.0.0.1:8000/api/alumno', {
      params: {
        name: this.buscar
      }

    });

      this.alumnos = resal.data;   
      if(Object.keys(this.alumnos.data).length === 0){
        alert('El ALUMNO NO EXISTE');           
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