<template>
    <div id="balanza">
        <v-row>
            <v-col>
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
                <v-date-picker v-model="fecha" type="month"></v-date-picker>
                <v-btn @click="balanza">Obtener</v-btn>
            </v-col>
            <v-col>
                {{ fecha }}
                {{ empresaSelect }}
                {{ cuentas }}
            </v-col>
        </v-row>
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
                registros.forEach(registro => {
                    if (
                        this.cuentas.some(
                            cuenta => cuenta.id == registro.subcuenta.id
                        )
                    ) {
                        this.cuentas[this.cuentas.length - 1].debe =
                            registro.debe +
                            this.cuentas[this.cuentas.length - 1].debe;
                        this.cuentas[this.cuentas.length - 1].haber =
                            registro.haber +
                            this.cuentas[this.cuentas.length - 1].haber;
                    } else {
                        this.cuentas.push({
                            id: registro.subcuenta.id,
                            cuenta: registro.subcuenta.nombre,
                            debe: registro.debe,
                            haber: registro.haber
                        });
                    }
                });
            });
        }
    }
};
</script>
