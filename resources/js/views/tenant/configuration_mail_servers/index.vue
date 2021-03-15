<template>
    <div>
        <div class="page-header pr-0">
            <h2>
                <a href="/dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                </a>
            </h2>
            <ol class="breadcrumbs">
                <li class="active">
                    <span>Servidores de correo</span>
                </li>
            </ol>
            <div class="right-wrapper pull-right">
                <button
                    type="button"
                    class="btn btn-custom btn-sm mt-2 mr-2"
                    @click.prevent="clickCreate()"
                >
                    <i class="fa fa-plus-circle"></i> Nuevo
                </button>
            </div>
        </div>
        <div class="card mb-0">
            <div class="card-header bg-info">
                <h3 class="my-0">Listado de servidores de correos</h3>
            </div>
            <div class="card-body">
                <data-table :resource="resource">
                    <tr slot="heading">
                        <th>#</th>
                        <th>Nombre</th>
                        <th class="text-right">Host</th>
                        <th class="text-right">Port</th>
                        <th class="text-right">Usuario</th>
                        <th class="text-right">Cifrado</th>
                        <th class="text-right">Driver</th>
                        <th class="text-right">Protocolo</th>
                        <th class="text-right">Cuenta predeterminada</th>
                        <th class="text-right">Validar cert</th>
                        <th class="text-right">Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                    <tr></tr>
                    <tr slot-scope="{ index, row }">
                        <td>{{ index }}</td>
                        <td>{{ row.name }}</td>
                        <td class="text-right">{{ row.host }}</td>
                        <td class="text-right">{{ row.port }}</td>
                        <td class="text-right">{{ row.username }}</td>
                        <td class="text-right">{{ row.encryption }}</td>
                        <td class="text-right">{{ row.driver }}</td>
                        <td class="text-right">{{ row.protocol }}</td>
                        <td class="text-right">{{ row.default_account }}</td>
                        <td class="text-right">{{ row.validate_cert }}</td>
                        <td class="text-right">
                            {{ getIsActive(row.is_active) }}
                        </td>
                        <td class="text-right">
                            <template>
                                <button
                                    type="button"
                                    class="btn waves-effect waves-light btn-xs btn-info"
                                    @click.prevent="clickCreate(row.id)"
                                >
                                    Editar
                                </button>
                            </template>

                            <template>
                                <button
                                    type="button"
                                    class="btn waves-effect waves-light btn-xs btn-danger"
                                    @click.prevent="clickDelete(row.id)"
                                >
                                    Eliminar
                                </button>
                            </template>
                        </td>
                    </tr>
                </data-table>
            </div>
        </div>
        <configuration-mail-servers-form
            :showDialog.sync="showDialog"
            :recordId="recordId"
        ></configuration-mail-servers-form>
    </div>
</template>

<script>
import DataTable from "../../../components/DataTable.vue";
import ConfigurationMailServersForm from "./form.vue";
import { deletable } from "../../../mixins/deletable";

export default {
    mixins: [deletable],
    components: { DataTable, ConfigurationMailServersForm },
    data() {
        return {
            resource: "configuration_mail_servers",
            showDialog: false,
            recordId: null
        };
    },
    methods: {
        clickCreate(recordId = null) {
            this.recordId = recordId;
            this.showDialog = true;
        },
        clickDelete(id) {
            this.destroy(`/${this.resource}/${id}`).then(() =>
                this.$eventHub.$emit("reloadData")
            );
        },
        getIsActive(is_active) {
            if (is_active) {
                return "Activo";
            }
            return "Inactivo";
        }
    }
};
</script>
