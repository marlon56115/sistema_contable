<template>
    <div id="balanza">
        <v-row justify="center">
            <v-date-picker v-model="fecha" type="month"></v-date-picker>
        </v-row>
        {{ fecha }}
    </div>
</template>

<script>
export default {
    name: "balanza",
    date: function() {
        return {
            cuentas: [],
            cuenta: { id: "", cuentaMayor: "", debe: "", haber: "" },
            fecha: ""
        };
    },
    methods: {
        balanza() {
            registros = [];
            axios
                .get("/balanza", { mes: this.mes, anio: this.anio })
                .then(res => {
                    registros = res.data;
                });
        }
    }
};
</script>
