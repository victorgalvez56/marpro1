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
                    <span>Descartes</span>
                </li>
            </ol>
            <div class="right-wrapper pull-right">
                <button
                    type="button"
                    class="btn btn-custom btn-sm mt-2 mr-2"
                    @click.prevent="addItem()"
                >
                    <i class="fa fa-plus-circle"></i> Nuevo
                </button>
            </div>
        </div>
        <div class="card mb-0">
            <div class="card-header bg-info">
                <h3 class="my-0">Listado de descartes</h3>
                <div class="card-actions">
                    <a
                        href="#"
                        class="card-action card-action-toggle text-white"
                        data-card-toggle=""
                    ></a>
                    <a
                        href="#"
                        class="card-action card-action-dismiss text-white"
                        data-card-dismiss=""
                    ></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Documento</th>
                                <th class="text-center">
                                    Fecha límite (desde)
                                </th>
                                <th class="text-center">Número de días</th>
                                <th class="text-center">
                                    Orden de compra (desde)
                                </th>
                                <th class="text-center">Número de días</th>
                                <th class="text-center">Automático</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(row, index) in records"
                                v-bind:key="index"
                            >
                                <td>{{ index + 1 }}</td>
                                <td class="text-right">
                                    {{ row.document.description }}
                                </td>
                                <td class="text-right">
                                    {{ row.date_from.description }}
                                </td>
                                <td class="text-center">
                                    {{ row.number_days }}
                                </td>
                                <td class="text-right">
                                    {{
                                        row.purchase_order_date_from.description
                                    }}
                                </td>
                                <td class="text-center">
                                    {{ row.purchase_order_number_days }}
                                </td>
                                <td class="text-center">
                                    {{ row.is_automatic ? "Si" : "No" }}
                                </td>
                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="btn waves-effect waves-light btn-xs btn-info"
                                        @click.prevent="editItem(row)"
                                    >
                                        Editar
                                    </button>
                                    <template>
                                        <button
                                            type="button"
                                            class="btn waves-effect waves-light btn-xs btn-danger"
                                            @click.prevent="deleteItem(index)"
                                        >
                                            Eliminar
                                        </button>
                                    </template>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <el-dialog
                :title="titleDialog"
                :visible.sync="showDialog"
                width="40%"
                @close="close"
            >
                <form autocomplete="off" @submit.prevent="submit">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div
                                            class="form-group"
                                            :class="{
                                                'has-danger': errors.document
                                            }"
                                        >
                                            <label class="control-label"
                                                >Documento</label
                                            >
                                            <el-select v-model="form.document">
                                                <el-option
                                                    v-for="(option,
                                                    index) in documents"
                                                    :key="index"
                                                    :value="option"
                                                    :label="option.description"
                                                ></el-option>
                                            </el-select>
                                            <small
                                                class="form-control-feedback"
                                                v-if="errors.document"
                                                v-text="errors.document[0]"
                                            ></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 center-el-checkbox">
                                        <div class="form-group">
                                            <el-checkbox
                                                v-model="form.is_automatic"
                                                >Descartar
                                                automaticamente</el-checkbox
                                            ><br />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div
                                            class="form-group"
                                            :class="{
                                                'has-danger': errors.date_from
                                            }"
                                        >
                                            <label class="control-label"
                                                >Fecha límite: desde</label
                                            >
                                            <el-select
                                                :disabled="!form.is_automatic"
                                                v-model="form.date_from"
                                            >
                                                <el-option
                                                    v-for="option in purchase_quote_dates"
                                                    :key="option.id"
                                                    :value="option"
                                                    :label="option.description"
                                                ></el-option>
                                            </el-select>
                                            <small
                                                class="form-control-feedback"
                                                v-if="errors.date_from"
                                                v-text="errors.date_from[0]"
                                            ></small>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div
                                            class="form-group"
                                            :class="{
                                                'has-danger': errors.number_days
                                            }"
                                        >
                                            <label class="control-label"
                                                >Número de días</label
                                            >
                                            <el-input-number
                                                :disabled="!form.is_automatic"
                                                v-model="form.number_days"
                                                :step="1"
                                                :min="1"
                                            ></el-input-number>
                                            <small
                                                class="form-control-feedback"
                                                v-if="errors.number_days"
                                                v-text="errors.number_days[0]"
                                            ></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div
                                            class="form-group"
                                            :class="{
                                                'has-danger':
                                                    errors.purchase_order_date_from
                                            }"
                                        >
                                            <label class="control-label"
                                                >Orden de compra: desde</label
                                            >
                                            <el-select
                                                :disabled="!form.is_automatic"
                                                v-model="
                                                    form.purchase_order_date_from
                                                "
                                            >
                                                <el-option
                                                    v-for="(option,
                                                    index) in purchase_order_dates"
                                                    :key="index"
                                                    :value="option"
                                                    :label="option.description"
                                                ></el-option>
                                            </el-select>
                                            <small
                                                class="form-control-feedback"
                                                v-if="
                                                    errors.purchase_order_date_from
                                                "
                                                v-text="
                                                    errors
                                                        .purchase_order_date_from[0]
                                                "
                                            ></small>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div
                                            class="form-group"
                                            :class="{
                                                'has-danger':
                                                    errors.purchase_order_number_days
                                            }"
                                        >
                                            <label class="control-label"
                                                >Número de días</label
                                            >
                                            <el-input-number
                                                :disabled="!form.is_automatic"
                                                v-model="
                                                    form.purchase_order_number_days
                                                "
                                                :step="1"
                                                :min="1"
                                            ></el-input-number>
                                            <small
                                                class="form-control-feedback"
                                                v-if="
                                                    errors.purchase_order_number_days
                                                "
                                                v-text="
                                                    errors
                                                        .purchase_order_number_days[0]
                                                "
                                            ></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions text-right mt-4">
                        <el-button @click.prevent="close()">Cancelar</el-button>
                        <el-button
                            type="primary"
                            native-type="submit"
                            :loading="loading_submit"
                            >Guardar</el-button
                        >
                    </div>
                </form>
            </el-dialog>
        </div>
    </div>
</template>

<script>
import DataTable from "../../../components/DataTable.vue";
import { deletable } from "../../../mixins/deletable";

export default {
    mixins: [deletable],
    components: { DataTable },
    data() {
        return {
            headers: headers_token,
            showDialog: false,
            titleDialog: null,
            loading_submit: false,
            resource: "discards",
            errors: {},
            form: {},
            editedIndex: -1,
            records: [],
            records_tmp: [],
            documents: [],
            purchase_quote_dates: [],
            purchase_order_dates: []
        };
    },
    async created() {
        await this.getTables();
        await this.getRecords();
        this.initForm();
    },
    methods: {
        initForm() {
            this.errors = {};
            this.form = {
                document: null,
                date_from: null,
                number_days: null,
                purchase_order_date_from: null,
                purchase_order_number_days: 1,
                is_automatic: false
            };
            this.editedIndex = -1;
        },
        getTables() {
            return this.$http.get(`/${this.resource}/tables`).then(response => {
                this.documents = response.data.documents;
                this.purchase_quote_dates = response.data.purchase_quote_dates;
                this.purchase_order_dates = response.data.purchase_order_dates;
            });
        },
        async getRecords() {
            return this.$http
                .get(`/${this.resource}/records`)
                .then(response => {
                    this.records = response.data;
                });
        },
        close() {
            this.showDialog = false;
            this.initForm();
        },
        validate() {
            const is_valid = true;
            if (!this.form.document) {
                this.$set(this.errors, "document", [
                    "El documento es obligatorio"
                ]);
                is_valid = false;
            }
            if (!this.form.date_from) {
                this.$set(this.errors, "date_from", [
                    "La fecha desde es obligatorio"
                ]);
                is_valid = false;
            }
            if (!this.form.number_days) {
                this.$set(this.errors, "number_days", [
                    "El número de días es obligatorio"
                ]);
                is_valid = false;
            }
            if (!this.form.purchase_order_date_from) {
                this.$set(this.errors, "purchase_order_date_from", [
                    "La fecha desde es obligatorio"
                ]);
                is_valid = false;
            }
            if (!this.form.purchase_order_number_days) {
                this.$set(this.errors, "purchase_order_number_days", [
                    "El número de días es obligatorio"
                ]);
                is_valid = false;
            }
            return is_valid;
        },
        addItem() {
            this.initForm();
            this.titleDialog = "Agregar descarte ";
            this.showDialog = true;
        },
        editItem(item) {
            this.titleDialog = "Editar descarte ";
            this.editedIndex = this.records.indexOf(item);
            this.form = _.cloneDeep(item);
            this.showDialog = true;
        },
        async deleteItem(index) {
            try {
                const isAccept = confirm(
                    "¿Esta seguro de eliminar esta configuración?"
                );
                if (isAccept) {
                    this.records_tmp = [...this.records];
                    this.records_tmp.splice(index, 1);
                    const send = {};
                    send.status = "deleted";
                    send.records = this.records_tmp;
                    const { data } = await this.$http.post(
                        `/${this.resource}`,
                        send
                    );
                    if (data.success) {
                        await this.getRecords();
                        this.$message.success(data.message);
                    } else {
                        this.$message.error(data.message);
                    }
                }
            } catch (e) {
                console.log(e);
            }
        },
        async submit() {
            try {
                if (this.validate()) {
                    const send = {};
                    if (this.editedIndex > -1) {
                        this.records_tmp = [...this.records];
                        this.records_tmp[this.editedIndex] = Object.assign(
                            {},
                            this.form
                        );
                        send.status = "updated";
                    } else {
                        this.records_tmp = [...this.records];
                        this.records_tmp.push(this.form);
                        send.status = "created";
                    }
                    send.records = this.records_tmp;
                    this.loading_submit = true;
                    const { data } = await this.$http.post(
                        `/${this.resource}`,
                        send
                    );
                    this.loading_submit = false;
                    if (data.success) {
                        this.showDialog = false;
                        this.initForm();
                        this.$message.success(data.message);
                        await this.getRecords();
                    } else {
                        this.$message.error(data.message);
                    }
                }
            } catch (e) {
                this.loading_submit = false;
            }
        }
    }
};
</script>
<style scoped></style>
