<template>
       <div>
           <div class="row">
               <div class="col col-12 col-md-3">
                   <FormNuevoLibro class="mb-3" @mandarLibro="actualizarLibros"/>
                   <LibroDiario class="mb-2" :librosUsuario="librosUsuario" @realizarAccion="traerPartidas" @eliminarLibro="actualizarLibros"/>
               </div>
               <div class="col col-12 col-md-9">
                   <TablaLibroDiario :LibroDiario="LibroSelected" v-if="detalles" :transaccionesLibro="transaccionesLibro" :totalDebe="totalDebe" :totalHaber="totalHaber"  @actualizarPartidas="traerPartidas"/>
               </div>
           </div>
       </div>
</template>

<script>
import LibroDiario from '../components/LibroDiario';
import TablaLibroDiario from '../components/TablaLibroDiario';
import FormNuevoLibro from '../components/FormNuevoLibro';


export default {
    components: {
        LibroDiario,
        TablaLibroDiario,
        FormNuevoLibro
    },
    name: 'librodiarioview',
    data(){
        return{
            librosUsuario:[],
            transaccionesLibro:[],
            detalles:false,
            LibroSelected:{}

        }
    },
    beforeCreate(){ //aqui llamamos a las notas del backend y las guardamos en el array
      axios.get('/librod').then(res=>{this.librosUsuario = res.data;})
    },
    methods: {
        traerPartidas(libro){
            this.detalles =true;
            this.LibroSelected=libro; //recibo el libro desde LibroDiario, y se lo mando a TablaLibroDiario
            axios.get(`/registrosporlibro/${libro.id}`).then(res=>{this.transaccionesLibro = res.data;})
        },
        actualizarLibros(libro){
            console.log(libro);
          this.detalles =false;
          axios.get('/librod').then(res=>{this.librosUsuario = res.data;})
        }
    },
    computed: {
        totalDebe(){
            var totalDebe=0;
            for (let index = 0; index < this.transaccionesLibro.length; index++) {
                totalDebe+=parseFloat(this.transaccionesLibro[index].debe);
            }
            return parseFloat(totalDebe);
        },
        totalHaber(){
            let totalHaber=0;
            for (let index = 0; index < this.transaccionesLibro.length; index++) {
                totalHaber+=parseFloat(this.transaccionesLibro[index].haber);
            }
            return parseFloat(totalHaber);
        }
    }
}
</script>
