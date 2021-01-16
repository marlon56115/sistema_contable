<template>
    <div id="balanza">
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
        <v-row justify="center">
            <v-date-picker v-model="fecha" type="month"></v-date-picker>
        </v-row>
        <button @click="balanza">Obtener</button>
        {{ fecha }}
        {{ empresaSelect }}
        {{ cuentas }}
    </div>
</template>

<script>
export default {
    name: "balanza",
    data: function() {
        return {
            cuentas: [],
            cuenta: { id: "", cuentaMayor: "", debe: "", haber: "" },
            fecha: "",
            empresas: [],
            empresaSelect: null
        };
    },
    created() {
        axios
            .get("/empresa")
            .then(res => {
                this.empresas = res.data;
            })
            .catch(e => {
                console.log(e);
            });
    },
    methods: {
        balanza() {
            var registros = [];
            const params = {
                month: this.fecha.substring(5, this.fecha.length),
                year: this.fecha.substring(0, 4),
                id: this.empresaSelect
            };
            axios.get("/balanza", { params: params }).then(res => {
                registros = res.data;
                this.cuentas = registros;
            });
        }
    }
};
</script>
