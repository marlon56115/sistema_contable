<template>
  <div>
    <h5 class="text-center">Libro#: {{ LibroDiario.id }}
         <v-btn
        color="blue-grey"
        class=" white--text float-right"
        fab
        small
        :href="libroImprimir"
        >
        <v-icon dark>
            mdi-file-pdf-outline
        </v-icon>
        </v-btn>
    </h5>
    <h5 class="text-center">Empresa: {{ LibroDiario.nombre }}</h5>
    <FormNuevaPartida
      :idLibro="LibroDiario.id"
      @actualizarPartidas="actualizarPartidas"
      :editMode="editMode"
      :transaccionEdit="transaccionEdit"
      @actualizarTabla="actualizarPartidas"
      @guardo="cambiarEstado"
    />
    <table class="table table-hover mt-3">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Subcuenta</th>
          <th scope="col">Fecha</th>
          <th scope="col">Debe</th>
          <th scope="col">Haber</th>
          <th scope="col">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="transaccion of transaccionesLibro"
          :key="transaccion.transaccion"
        >
          <th scope="row"> {{transaccion.cuentaId}} {{ transaccion.subcuenta }}</th>
          <td> {{transaccion.fecha}} </td>
          <td>${{ transaccion.debe }}</td>
          <td>${{ transaccion.haber }}</td>
          <td>
              <v-btn
              icon
              color="pink"
               @click="eliminarPartida(transaccion)"
            >
              <v-icon>mdi-delete</v-icon>
            </v-btn>

             <v-btn
              icon
              color="green"
              @click="actualizarTransaccion(transaccion)"
            >
              <v-icon>mdi-pencil</v-icon>
            </v-btn>

          </td>
        </tr>
      </tbody>
      <thead class="thead-dark">
        <tr>
          <th scope="col">Total</th>
          <th scope="col"></th>
          <th scope="col">${{ totalDebe }}</th>
          <th scope="col">${{ totalHaber }}</th>
          <th scope="col"></th>
        </tr>
      </thead>
    </table>
  </div>
</template>

<script>
import FormNuevaPartida from "./FormNuevaPartida";
export default {
  name: "tablalibrodiario",
  components: {
    FormNuevaPartida,
  },
  props: {
    transaccionesLibro: Array,
    LibroDiario: {},
    totalDebe: {
        type: Number,
        default:0
        },
    totalHaber:  {
        type: Number,
        default:0
        },
  },
  data() {
    return {
      editMode: false,
      transaccion: {},
      subcuentas: [],
      transaccionEdit: {},
    };
  },
  methods: {
    actualizarPartidas() {
      this.$emit("actualizarPartidas", this.LibroDiario); //recivo el evento de formNuevaPartida y lo emito a general junto con el libro diario actual para actualizar la tabla
    },
    actualizarTransaccion(transaccion) {
        console.log(transaccion);
      this.transaccionEdit = transaccion;
      this.editMode = true;
    },
    cambiarEstado() {//se ejecuta cuando actualizo un registro
      this.editMode = false; //cambio los valores de edicion
      this.transaccionEdit = {}; //vacio el objeto
      this.actualizarPartidas(); //relleno la tabla otra vez
    },
    eliminarPartida(registro){
        axios.delete(`/registrold/${registro.transaccion}`)
        .then(res=>{this.$emit("actualizarPartidas", this.LibroDiario)})
    }
  },
  computed: {
      libroImprimir(){
          return `/PDF/report1/${this.LibroDiario.id}`;
      }
    }
};
</script>


