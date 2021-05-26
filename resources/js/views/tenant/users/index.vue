<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Listado de usuarios</h4>
          </template>

          <template v-slot:headerAction v-if="typeUser === 'admin'">
                <button type="button" class="btn btn-custom btn-sm  mt-2 mr-2" v-if="typeUser != 'integrator'" @click.prevent="clickCreate()"><i class="fa fa-plus-circle"></i> Nuevo</button>
          </template>

            <div class="card-body">
                <data-table :resource="resource">
                    <tr slot="heading">
                        <th>#</th>
                        <th>Email</th>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Api Token</th>
                        <th>Establecimiento</th>
                    </tr>
                    <tr slot-scope="{ index, row }">
                        <td>{{ index + 1 }}</td>
                        <td>{{ row.email }}</td>
                        <td>{{ row.name }}</td>
                        <td>{{ row.type }}</td>
                        <td>{{ row.api_token }}</td>
                        <td>{{ row.establishment_description }}</td>
                        <td class="text-right">
                            <button
                                v-if="row.locked"
                                type="button"
                                class="btn waves-effect waves-light btn-xs btn-success"
                                @click.prevent="clickSendConfirmation(row.id)"
                            >
                                Confirmación de cuenta
                            </button>
                            <button
                                type="button"
                                class="btn waves-effect waves-light btn-xs btn-info"
                                @click.prevent="clickCreate(row.id)"
                            >
                                Editar
                            </button>
                            <button
                                type="button"
                                class="btn waves-effect waves-light btn-xs btn-danger"
                                @click.prevent="clickDelete(row.id)"
                                v-if="row.id != 1"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </data-table>
            </div>
            <users-form
                :showDialog.sync="showDialog"
                :typeUser="typeUser"
                :recordId="recordId"
            ></users-form>
    </iq-card>
      </b-col>
    </b-row>
  </b-container>
  </template>

<script>
import DataTable from "../../../components/DataTableUser.vue";
import UsersForm from "./form1.vue";
import { deletable } from "../../../mixins/deletable";

export default {
    props: ["typeUser"],
    mixins: [deletable],
    components: { DataTable, UsersForm },
    data() {
        return {
            showDialog: false,
            resource: "users",
            recordId: null,
            records: []
        };
    },
    created() {
        this.$eventHub.$on("reloadData", () => {
            this.getData();
        });
        this.getData();
    },
    methods: {
        getData() {
            this.$http.get(`/${this.resource}/records`).then(response => {
                this.records = response.data.data;
            });
        },
        clickCreate(recordId = null) {
            this.recordId = recordId;
            this.showDialog = true;
        },
        clickDelete(id) {
            this.destroy(`/${this.resource}/${id}`).then(() =>
                this.$eventHub.$emit("reloadData")
            );
        },
        clickSendConfirmation(id) {
            this.$http
                .get(`/${this.resource}/send_confirmation/${id}`)
                .then(response => {
                    if (response.data.success == true) {
                        this.$eventHub.$emit("reloadData");
                        this.$message.success(response.data.message);
                    } else {
                        this.$message.error(response.data.message);
                    }
                });
        }
    }
};
</script>
