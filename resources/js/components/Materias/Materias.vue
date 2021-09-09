<template>
  <div>
    <h1 class="text-center">Gestionar Materias</h1>

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
              <label for="nombre">Nombre</label>
              <input v-model="mmaterias.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del Matería">
            </div>
            
            <div class="my-4">
              <label for="nhora">Número de Horas</label>
              <input v-model="mmaterias.nhora" type="number" class="form-control" id="nhora" placeholder="Número de Horas">
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
          <th scope="col">Nombre</th>
          <th scope="col">Número de Horas</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="mat in mmaterias.data" :key="mat.id">
          <th scope="row">{{ mat.id }}</th>
          <td>{{ mat.nom_mat }}</td>
          <td>{{ mat.nhor_mat }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(mat);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(mat.id)" class="btn btn-danger">
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
      mmaterias:{  },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      mat: [ ],
      mate: [ ],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('http://127.0.0.1:8000/api/materia/');
      this.mmaterias = res.data;

    },

    async eliminar(id) {

      const res = await axios.delete('http://127.0.0.1:8000/api/materia/' + id);

      this.listar();
    },
    async guardar() {
      if(this.modificar){

        const res = await axios.put('http://127.0.0.1:8000/api/materia/' + this.id, { 
          'nom_mat':  this.mmaterias.nombre,
          'nhor_mat': this.mmaterias.nhora,

        });

      }else{
        const res = await axios.post('http://127.0.0.1:8000/api/materia/', { 
         
          //'id': this.update,
          'nom_mat':  this.mmaterias.nombre,
          'nhor_mat': this.mmaterias.nhora,
         
         });
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Materia";
        this.mmaterias.nombre=data.nom_mat;
        this.mmaterias.nhora=data.nhor_mat;
      }else{
        this.id=0;
        this.tituloModal="Crear Materia";
        this.mmaterias.nombre='';
        this.mmaterias.nhora='';
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