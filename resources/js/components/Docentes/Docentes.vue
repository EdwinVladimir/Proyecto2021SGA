<template>
  <div>
    <h1 class="text-center">Gestionar Docentes</h1>

    <div class="my-4">
        <label for="buscar">Buscar:</label>
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
              <label for="dni">DNI</label>
              <input v-model="docentes.dni" type="text" v-on:keyup.enter="buscarcedula();" class="form-control" id="dni" placeholder="DNI del Docente">
              <button v-on:keyup.enter="buscarcedula();" @click="buscarcedula();" type="button" class="btn btn-info" data-dismiss="modal">Buscar</button>
            </div>

            <div class="my-4">
              <label for="nombre">Nombre</label>
              <input v-model="docentes.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del Docente">
            </div>

            <div class="my-4">
              <label for="apellidos">Apellidos</label>
              <input v-model="docentes.apellido" type="text" class="form-control" id="apellido" placeholder="Apellido del Docente">
            </div>

            <div class="my-4">
              <label for="especialidad">Especialidad</label>
              <v-select v-model="docentes.especialidad" :items= "espe" item-text="nom_especialidad" item-value="id" dense solo id="especialidad" ></v-select>
            </div>
          
                  <div class="my-4">
              <label for="reparto">Reparto</label>
              <v-select v-model="docentes.reparto" :items= "repa" item-text="nom_reparto" item-value="id" dense solo id="reparto" ></v-select>
            </div>

            <div class="my-4">
              <label for="tipogrado">Grado</label>
              <v-select v-model="docentes.grado" :items= "grad" item-text="nom_grado" item-value="id" dense solo id="grado" ></v-select>
            </div>
    
     </v-col>
          
          <v-col cols="14" md="4">
           <div class="my-4">
              <label for="tiposangre">Tipo de Sangre</label>
              <v-select v-model="docentes.sangre" :items= "sang" item-text="nom_sangre" item-value="id" dense solo id="sangre" ></v-select>
            </div>
            
            <div class="my-4">
              <label for="lnacimiento">Lugar de Nacimiento</label>
              <input v-model="docentes.lnacimiento" type="text" class="form-control" id="lnacimiento" placeholder="Lugar de Nacimiento del Docente">
            </div>         
            
            <div class="my-4">
              <label for="grado">Fecha de Nacimiento</label>
              <input v-model="docentes.fnacimiento" type="date" class="form-control" id="fnacimiento" placeholder="Fecha del Docente">
            </div>

            <div class="my-4">
              <label for="instituto">Instituciòn Educativa</label>
              <input v-model="docentes.instituto" type="text" class="form-control" id="instituto" placeholder="Instituto Educativo">
            </div>
          
            <div class="my-4">
              <label for="certificado">Certificación Obtenida</label>
              <input v-model="docentes.certificado" type="text" class="form-control" id="certificado" placeholder="Certificación Obtenida">
            </div>
          </v-col>
          </v-row>
          </div>  
          <!-- Modal footer -->
          <div class="modal-footer">
            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

            <button  @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>

          </div>
        </div>
      </div>
    </div>


    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">DNI</th>
          <th scope="col">Grado</th>          
          <th scope="col">Nombre</th>
          <th scope="col">Apellidos</th>
          <th scope="col">Especialidad</th>
          <th scope="col">Reparto</th>
          <th scope="col">Tipo de Sangre</th>
          <th scope="col">Lugar de Nacimiento</th>     
          <th scope="col">Fecha de Nacimiento</th>       
          <th scope="col">Instituciòn Educativa</th>
          <th scope="col">Certificación Obtenida</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="doc in docentes.data" :key="doc.id">
          <th scope="row">{{ doc.id }}</th>
          <td>{{ doc.dni_doc }}</td>
          <td>
              <span v-for="(n,indice) in doc.tipogrado_nom" :key="indice">
                  {{n.nom_grado}}
              </span> 
          </td>          
          <td>{{ doc.nom_doc }}</td>
          <td>{{ doc.ape_doc }}</td>
          <td>
              <span v-for="(n,indice) in doc.especialidad_nom" :key="indice">
                  {{n.nom_especialidad}}
              </span> 
          </td>
          <td>
              <span v-for="(n,indice) in doc.reparto_nom" :key="indice">
                  {{n.nom_reparto}}
              </span> 
          </td>
          <td>
              <span v-for="(n,indice) in doc.tiposangre_nom" :key="indice">
                  {{n.nom_sangre}}
              </span> 
          </td>
          <td>{{ doc.lnac_doc }}</td>    
          <td>{{ doc.fnac_doc }}</td>                        
          <td>{{ doc.instt_docp }}</td>
          <td>{{ doc.cobt_doc }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(doc);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(doc.id)" class="btn btn-danger">Eliminar</button>
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
      docentes:{ },
      docentesci:{ },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      buscar:'',
      doc: [],
      espe: [ ],
      repa: [ ],
      grad: [ ],
      sang: [ ],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('http://127.0.0.1:8000/api/docente', {
      params: {
        name: this.buscar
      }
    });

      this.docentes = res.data;

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
      const res = await axios.delete('http://127.0.0.1:8000/api/docente/' + id);
      this.listar();
    },

    async buscarci() {   
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
        const res = await axios.put('http://127.0.0.1:8000/api/docente/'+ this.id, { 
          
          'dni_doc'   : this.docentes.dni,
          'nom_doc'   : this.docentes.nombre,
          'ape_doc'   : this.docentes.apellido,
          'especialidad_id': this.docentes.especialidad,
          'reparto_id': this.docentes.reparto,
          'tipogrado_id': this.docentes.grado,
          'tiposangre_id': this.docentes.sangre,
          'lnac_doc': this.docentes.lnacimiento,
          'fnac_doc': this.docentes.fnacimiento,
          'instt_docp': this.docentes.instituto,
          'cobt_doc': this.docentes.certificado,

         });

      }else{
        //console.log(this.docentes.especialidad);
        const res = await axios.post('http://127.0.0.1:8000/api/docente/', { 
          
          'id': this.update,
          'dni_doc'   : this.docentes.dni,
          'nom_doc'   : this.docentes.nombre,
          'ape_doc'   : this.docentes.apellido,
          'especialidad_id': this.docentes.especialidad,
          'reparto_id': this.docentes.reparto,
          'tipogrado_id': this.docentes.grado,
          'tiposangre_id': this.docentes.sangre,
          'lnac_doc': this.docentes.lnacimiento,
          'fnac_doc': this.docentes.fnacimiento,
          'instt_docp': this.docentes.instituto,
          'cobt_doc': this.docentes.certificado,
         
         });
      }
    this.cerrarModal();
      this.listar();
    },

    abrirModal(data={}){
      this.modal=1;
     if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Docentes";
        this.docentes.dni=data.dni_doc;
        this.docentes.nombre=data.nom_doc;
        this.docentes.apellido=data.ape_doc;
        this.docentes.especialidad=data.especialidad_id;
        this.docentes.reparto=data.reparto_id;
        this.docentes.grado=data.tipogrado_id;
        this.docentes.sangre=data.tiposangre_id;
        this.docentes.lnacimiento=data.lnac_doc;
        this.docentes.fnacimiento=data.fnac_doc;
        this.docentes.instituto=data.instt_docp;
        this.docentes.certificado=data.cobt_doc;

      }else{
        this.id=0;
        this.tituloModal="Crear Docentes";
        this.docentes.dni_doc=' ';
        this.docentes.nom_doc=' ';
        this.docentes.ape_doc=' ';
        this.docentes.especialidad=' ';
        this.docentes.reparto=' ';
        this.docentes.grado=' ';
        this.docentes.sangre=' ';
        this.docentes.lnacimiento=' ';
        this.docentes.fnacimiento=' ';
        this.docentes.instituto=' ';
        this.docentes.certificado=' ';
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