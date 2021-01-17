<template>
    <div id="balanza">
        <v-container>
            <v-row>
                <v-col cols="3">
                    <p>Empresa:</p>
                    <v-select
                        v-model="empresaSelect"
                        :items="empresas"
                        item-text="nombre"
                        item-value="id"
                        solo
                        label="Seleccione una empresa"
                    >
                        <template v-slot:item="{ item }">
                            {{ item.id }} {{ item.nombre }}
                        </template>
                        <template v-slot:selection="{ item }">
                            {{ item.id }} {{ item.nombre }}
                        </template>
                    </v-select>
                    <p>Fecha:</p>
                    <v-date-picker
                        v-model="fecha"
                        full-width
                        type="month"
                        locale="es"
                    ></v-date-picker>
                    <v-btn @click="balanza" color="blue" dark block
                        >Obtener</v-btn
                    >
                </v-col>
                <v-col>
                    <v-simple-table>
                        <template v-slot:default>
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="4">
                                        Balanzce de Comprobacion de {{ fecha }}
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center">
                                        ID
                                    </th>
                                    <th class="text-center">
                                        Cuenta
                                    </th>
                                    <th class="text-center">
                                        Debe
                                    </th>
                                    <th class="text-center">
                                        Haber
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="cuenta in cuentas"
                                    :key="cuenta.name"
                                >
                                    <td>{{ cuenta.id }}</td>
                                    <td>{{ cuenta.cuenta }}</td>
                                    <td>{{ cuenta.debe }}</td>
                                    <td>{{ cuenta.haber }}</td>
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    name: "balanza",
    data: function() {
        return {
            cuentas: [],
            cuenta: { id: "", cuentaMayor: "", debe: "", haber: "" },
            fecha: new Date().toISOString().substr(0, 7),
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
            this.cuentas = [];
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
