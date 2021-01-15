<template>
  <div>
    <form @submit.prevent="guardar">
      <h6>Agregar Nuevo Libro</h6>
      <v-select
            dense
            v-model="empresaSelect"
            :items="empresas"
            item-text="nombre"
            item-value="id"
            label="Seleccione una empresa"
            single-line
          >
            <template v-slot:item="{ item }">
              {{ item.id }} {{ item.nombre }}
            </template>
            <template v-slot:selection="{ item }">
              {{ item.id }} {{ item.nombre }}
            </template>
        </v-select>

      <v-btn
      class="green"
        block
        type="submit"
        :disabled="empresaSelect == undefined"
      >
        Agregar
      </v-btn>
    </form>
  </div>
</template>

<script>
export default {
  name: "formnuevolibro",
  data() {
    return {
      empresas: [],
      empresaSelect: undefined,
      empresaResponde: {},
    };
  },

  beforeCreate() {
    axios.get("/empresa").then((res) => {
      this.empresas = res.data;
    });
  },

  methods: {
    guardar() {
      const params = { id: this.empresaSelect };
      axios.post("/librod", params).then((res) => {
        this.$emit("mandarLibro", res.data);
        this.empresaSelect=undefined;
      });
    },
  },
};
</script>

<style>
</style>
