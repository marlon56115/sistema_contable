<template>
  <div>
    <div v-if="editMode">
      <div class="row">
        <div class="col col-3 col-md-2">
          <v-select
            dense
            v-model="transLocal.cuentaId"
            :items="cuentas"
            item-text="nombre"
            item-value="id"
            label="Cuenta"
            single-line
            @change="getSubcuentas"

          >
            <template v-slot:item="{ item }">
              {{ item.id }} {{ item.nombre }}
            </template>
            <template v-slot:selection="{ item }">
              {{ item.id }} {{ item.nombre }}
            </template>
          </v-select>
          <v-select
            dense
            v-model="transLocal.subcuentaId"
            :items="subcuentas"
            item-text="nombre"
            item-value="id"
            label="Subcuenta"
            single-line
          >
            <template v-slot:item="{ item }">
              {{ item.id }} {{ item.nombre }}
            </template>
            <template v-slot:selection="{ item }">
              {{ item.id }}
            </template>
          </v-select>
        </div>
        <div class="col col-3 col-md-4">
          <v-textarea
            rows="1"
            prepend-icon="mdi-playlist-check"
            name="input-7-1"
            label="concepto"
            v-model="transLocal.concepto"
            height="60"
          ></v-textarea>
        </div>
        <div class="col col-3 col-md-2 d-flex align-center justify-center">
          <v-text-field
            dense
            label="Debe"
            v-model="transLocal.debe"
            prefix="$"
          ></v-text-field>
        </div>
        <div class="col col-3 col-md-2 d-flex align-center justify-center">
          <v-text-field
            dense
            label="Haber"
            v-model="transLocal.haber"
            prefix="$"
          ></v-text-field>
        </div>
        <div class="col col-3 col-md-2 d-flex align-center justify-center">
            <v-switch
            v-model="transLocal.ajuste"
            label="ajuste"
            ></v-switch>
        </div>
        <div class="col col-12 ">
          <div class="row">
            <div class="col">
              <v-btn
                class="orange text-light"
                block
                @click="actualizarPartida(transLocal)"
              >
                Actualizar
              </v-btn>
            </div>
            <div class="col">
              <v-btn class="red text-light" block @click="cancelarEdicion">
                Cancelar
              </v-btn>
            </div>
          </div>
        </div>
      </div>
    </div>

    <form @submit.prevent="agregarPartida" v-else>
      <div class="row">
        <div class="col col-3 col-md-2">
          <v-select
            dense
            v-model="cuentaSelected"
            :items="cuentas"
            item-text="nombre"
            item-value="id"
            label="Cuenta"
            single-line
            @change="getSubcuentas"
          >
            <template v-slot:item="{ item }">
              {{ item.id }} {{ item.nombre }}
            </template>
            <template v-slot:selection="{ item }">
              {{ item.id }} {{ item.nombre }}
            </template>
          </v-select>

          <v-select
            dense
            v-model="selectedSubcuenta"
            :items="subcuentas"
            item-text="nombre"
            item-value="id"
            label="Subcuenta"
            single-line
            :disabled="cuentaSelected == undefined"
          >
            <template v-slot:item="{ item }">
              {{ item.id }} {{ item.nombre }}
            </template>
            <template v-slot:selection="{ item }">
              {{ item.id }}
            </template>
          </v-select>
        </div>
        <div class="col col-3 col-md-4">
          <v-textarea
            rows="1"
            prepend-icon="mdi-playlist-check"
            name="input-7-1"
            label="concepto"
            v-model="concepto"
            height="60"
          ></v-textarea>
        </div>
        <div class="col col-3 col-md-2 d-flex align-center justify-center">
          <v-text-field
            dense
            label="Debe"
            v-model="debe"
            prefix="$"
          ></v-text-field>
        </div>
        <div class="col col-3 col-md-2 d-flex align-center justify-center">
          <v-text-field
            dense
            label="Haber"
            v-model="haber"
            prefix="$"
          ></v-text-field>

        </div>
        <div class="col col-3 col-md-2 d-flex align-center justify-center">
            <v-switch
            v-model="ajuste"
            label="ajuste"
            ></v-switch>
        </div>
        <div class="col-12">
          <v-btn class="green text-light" type="submit" block
          :disabled="selectedSubcuenta==undefined || concepto==''"
          > Agregar </v-btn>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "formnuevapartida",
  props: {
    idLibro: undefined,
    transaccionEdit: { type: Object, required: true },
    editMode: Boolean,
  },
  data() {
    return {
      subcuentas: [],
      cuentas: [],
      cuentaSelected: undefined,
      concepto: "",
      debe: 0,
      haber: 0,
      ajuste:false,
      selectedSubcuenta: undefined,
      localTransaccion: {},
    };
  },
  beforeCreate() {
    axios.get("/cuenta").then((res) => {
      this.cuentas = res.data;
    });
  },
  methods: {
    getSubcuentas() {
      var id = null;
      if (this.editMode) {
        id = this.localTransaccion.cuentaId;
      } else {
        id = this.cuentaSelected;
      }
      axios.get(`/subcuentas/${id}`).then((res) => {
        this.subcuentas = res.data;
      });
    },
    agregarPartida() {
      const params = {
        subCuentaId: this.selectedSubcuenta,
        ldID: this.idLibro,
        debe: this.debe,
        haber: this.haber,
        concepto: this.concepto,
        ajuste:this.ajuste
      };
      this.concepto = "";
      this.debe = 0;
      this.haber = 0;
      this.selectedSubcuenta = undefined;
      this.cuentaSelected=undefined;
      this.ajuste=false;
      axios.post("/registrold", params).then((res) => {
        this.$emit("actualizarPartidas");
      }); //cuando agrego la partida, emito un evento hacia TablaLibroDiario
    },
    actualizarPartida(partida) {
      const params = {
        subcuenta: partida.subcuentaId,
        debe: partida.debe,
        haber: partida.haber,
        concepto: partida.concepto,
        ajuste:partida.ajuste
      };
      //vm.transLocal={};
      axios.put(`/registrold/${partida.transaccion}`, params).then((res) => {
        this.$emit("guardo");
      }); //se actualiza automaticamente por eso no se emite
    },
    cancelarEdicion() {
      this.$emit("guardo");
    },
  },
  computed: {
    transLocal() {
      this.localTransaccion.cuentaId = this.transaccionEdit.cuentaId;
      this.localTransaccion.subcuentaId = this.transaccionEdit.subcuentaId;
      this.localTransaccion.concepto = this.transaccionEdit.concepto;
      this.localTransaccion.debe = this.transaccionEdit.debe;
      this.localTransaccion.haber = this.transaccionEdit.haber;
      this.localTransaccion.ajuste=this.transaccionEdit.ajuste;
      this.localTransaccion.transaccion = this.transaccionEdit.transaccion;
      axios.get(`/subcuentas/${this.localTransaccion.cuentaId}`).then((res) => {
        this.subcuentas = res.data;
      });
      return this.localTransaccion;
    },
  },
};
</script>

