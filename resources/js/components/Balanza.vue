<template>
    <div id="balanza">
        <v-container>
            <v-row>
                <v-col cols="3">
                    <p>Empresa:</p>
                    <v-select
                        v-model="empresaSelect"
                        :items="empresas"
                        placeholder="Selecione una empresa"
                        solo
                        return-object
                        item-text="nombre"
                    >
                    </v-select>
                    <p>Mes:</p>
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
                    <div v-if="empresaSelect != null">
                        <h5 class="text-center">{{ empresaSelect.nombre }}</h5>
                        <h5 class="text-center">
                            Balanzce de Comprobacion de {{ fecha }}
                        </h5>
                        <h5 class="text-center">
                            Expresado en dolares de los Estados Unidos de
                            America
                        </h5>
                        <table class="table table-hover mt-3">
                            <thead class="thead-dark">
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
                                    <td>$ {{ cuenta.debe }}</td>
                                    <td>$ {{ cuenta.haber }}</td>
                                </tr>
                            </tbody>
                            <tfoot
                                class="grey darken-2 text-white font-weight-black"
                            >
                                <tr>
                                    <td class="text-center" colspan="2">
                                        Total
                                    </td>
                                    <td>$ {{ totalDebe }}</td>
                                    <td>$ {{ totalHaber }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <v-alert
                            dense
                            icon="mdi-alert"
                            type="warning"
                            v-if="totalDebe != totalHaber"
                        >
                            El <strong>Debe</strong> no es igual a
                            <strong>Haber</strong>; verificar las partidas en el
                            <strong>Libro Diario</strong>.
                        </v-alert>
                    </div>
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
            fecha: new Date().toISOString().substr(0, 7),
            empresas: [],
            empresaSelect: null,
            totalDebe: 0,
            totalHaber: 0
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
            this.totalDebe = 0;
            this.totalHaber = 0;
            var registros = [];
            const params = {
                month: this.fecha.substring(5, this.fecha.length),
                year: this.fecha.substring(0, 4),
                id: this.empresaSelect.id
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
                this.cuentas.forEach((registro, index) => {
                    if (registro.debe > registro.haber) {
                        registro.debe = registro.debe - registro.haber;
                        registro.haber = 0;
                        this.totalDebe = this.totalDebe + registro.debe;
                    } else if (registro.debe < registro.haber) {
                        registro.haber = registro.haber - registro.debe;
                        registro.debe = 0;
                        this.totalHaber = this.totalHaber + registro.haber;
                    } else {
                        this.cuentas.splice(index, 1);
                    }
                });
            });
        }
    }
};
</script>
