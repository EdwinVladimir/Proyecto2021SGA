<template>
  <div>
    <h1 class="text-center">Gestionar Periodos</h1>
 
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
              <label for="ano">Año</label>
              <input v-model="periodo.ano" type="text" class="form-control" id="ano" placeholder="Año">
            </div>

            <div class="my-4">
              <label for="periodo">Periodo</label>
              <input v-model="periodo.periodo" type="tePt" class="form-control" id="periodo" placeholder="Periodo">
            </div>

        
            <div class="my-4">
              <label for="stock">Inicio del Periodo</label> 
               <input v-model="periodo.inicia" type="date" class="form-control" id="inicioperiodo" placeholder="Inicio del Periodo">
            </div>

            <div class="my-4">
              <label for="stock">Fin del Periodo</label>
              <input v-model="periodo.final" type="date" class="form-control" id="finperiodo" placeholder="Fin del Periodo">
  
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
          <th scope="col">Año</th>
          <th scope="col">Periodo</th>
          <th scope="col">Inicio</th>
          <th scope="col">Cul mina</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="per in periodo.data" :key="per.id">
          <th scope="row">{{ per.id }}</th>
          <td>{{ per.ano_per }}</td>
          <td>{{ per.peri_per }}</td>
          <td>{{ per.finic_per }}</td>
          <td>{{ per.ffin_per }}</td> 
          <td>
            <button  @click="modificar=true; abrirModal(per);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(per.id)" class="btn btn-danger">
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
      periodo:{   },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      per: [],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('http://127.0.0.1:8000/api/periodo');
      this.periodo = res.data;
    },
    async eliminar(id) {
      const res = await axios.delete('http://127.0.0.1:8000/api/periodo/' + id);
      this.listar();
    },
    async guardar() {
      if(this.modificar){
        const res = await axios.put('http://127.0.0.1:8000/api/periodo/' + this.id, { 
          
          'ano_per': this.periodo.ano,
          'peri_per': this.periodo.periodo,
          'finic_per': this.periodo.inicia,
          'ffin_per': this.periodo.final,



         });

      }else{
        const res = await axios.post('http://127.0.0.1:8000/api/periodo/', { 
         
          'id': this.update,
          'ano_per': this.periodo.ano,
          'peri_per': this.periodo.periodo,
          'finic_per': this.periodo.inicia,
          'ffin_per': this.periodo.final,
         
         });
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Periodo";
        this.periodo.ano=data.ano_per;
        this.periodo.periodo=data.peri_per;
        this.periodo.inicia=data.finic_per
        this.periodo.final=data.ffin_per
      }else{
        this.id=0;
        this.tituloModal="Crear Periodo";
        this.periodo.ano='';
        this.periodo.periodo='';
        this.periodo.inicia='';
        this.periodo.final='';
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