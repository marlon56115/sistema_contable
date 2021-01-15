<template>
  <div >
      <h3 class="mt-5">Libros diarios</h3>
    <div v-for="libro of librosUsuario" :key="libro.id">
      <div class="card my-2">
        <div class="card-body">
          <h5 class="card-title">Empresa: {{ libro.nombre }}</h5>
          <h6 class="card-subtitle mb-2 text-muted">
            Libro #{{ libro.id }}
          </h6>
          <v-btn
              icon
              color="green"
              @click="lanzarEvento(libro)"
            >
              <v-icon>mdi-book</v-icon>
            </v-btn>

            <v-btn
              icon
              color="pink"
              @click="eliminar(libro.id)"
            >
              <v-icon>mdi-delete</v-icon>
            </v-btn>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    librosUsuario: Array,
  },
  name: "librodiario",

  methods: {
      lanzarEvento(libro){
             this.$emit('realizarAccion',libro)
        },
        eliminar(id){
            axios.delete(`/librod/${id}`).then(res=>{this.$emit('eliminarLibro')})

        }
  }
};
</script>

<style>
</style>
