<template>
  <div>
    <h1 class="text-center">Gestionar Secciones</h1>
    
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

            <div class="my-4">
              <label for="codigo">Codigo</label>
              <input v-model="seccion.codigo" type="text" class="form-control" id="codigo" placeholder="Codigo de la Sección">
            </div>
            
            <div class="my-4">
              <label for="nombre">Nombre</label>
              <input v-model="seccion.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre de la Seccion">
            </div>
            
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
          <th scope="col">Código</th>
          <th scope="col">Nombre</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="sec in seccion.data" :key="sec.id">
          <th scope="row">{{ sec.id }}</th>
          <td>{{ sec.cod_sec }}</td>
          <td>{{ sec.nom_sec }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(sec);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(sec.id)" class="btn btn-danger">
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
      seccion:{   },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      seccions: [],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('http://127.0.0.1:8000/api/seccion/');
      this.seccion = res.data;
    },
    async eliminar(id) {
      const res = await axios.delete('http://127.0.0.1:8000/api/seccion/' + id);
      this.listar();
    },
    async guardar() {
      if(this.modificar){
        const res = await axios.put('http://127.0.0.1:8000/api/seccion/'+ this.id, { 
          
          'cod_sec': this.seccion.codigo,
          'nom_sec': this.seccion.nombre,

         });
      }else{
        const res = await axios.post('http://127.0.0.1:8000/api/seccion/', { 
         
          'id': this.update,
          'cod_sec': this.seccion.codigo,
          'nom_sec': this.seccion.nombre,
         
         });
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Seccion";
        this.seccion.codigo=data.cod_sec;
        this.seccion.nombre=data.nom_sec;
      }else{
        this.id=0;
        this.tituloModal="Crear Seccion";
        this.seccion.codigo='';
        this.seccion.nombre='';
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