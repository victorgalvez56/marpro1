<template>
    <el-dialog
        width="50%"
        :title="titleDialog"
        :visible="showDialog"
        :close-on-click-modal="false"
        @close="close"
        @open="create"
        append-to-body
        top="7vh"
    >
        <form autocomplete="off" @submit.prevent="submit">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.id }"
                        >
                            <label class="control-label">
                                Id
                                <span class="text-danger">*</span>
                            </label>
                            <el-input
                                v-model="form.id"
                                :maxlength="3"
                                dusk="id"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.id"
                                v-text="errors.id[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.description }"
                        >
                            <label class="control-label">
                                Descripción
                                <span class="text-danger">*</span>
                            </label>
                            <el-input
                                v-model="form.description"
                                dusk="description"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.description"
                                v-text="errors.description[0]"
                            ></small>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.charge }"
                        >
                            <label class="control-label">Cargo</label>
                            <el-input
                                v-model="form.charge"
                                :min="0.01"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.charge"
                                v-text="errors.charge[0]"
                            ></small>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.number_days }"
                        >
                            <label class="control-label">Número de días</label>
                            <el-input-number
                                v-model="form.number_days"
                            ></el-input-number>
                            <small
                                class="form-control-feedback"
                                v-if="errors.number_days"
                                v-text="errors.number_days[0]"
                            ></small>
                        </div>
                    </div>

                    <div class="col-md-2 center-el-checkbox">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.has_card }"
                        >
                            <el-checkbox v-model="form.has_card"
                                >Tiene tarjeta ?</el-checkbox
                            >
                            <br />
                            <small
                                class="form-control-feedback"
                                v-if="errors.has_card"
                                v-text="errors.has_card[0]"
                            ></small>
                        </div>
                    </div>

                    <div class="col-md-2 center-el-checkbox">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.is_sale }"
                        >
                            <el-checkbox v-model="form.is_sale"
                                >Es para Venta ?</el-checkbox
                            >
                            <br />
                            <small
                                class="form-control-feedback"
                                v-if="errors.is_sale"
                                v-text="errors.is_sale[0]"
                            ></small>
                        </div>
                    </div>

                    <div class="col-md-2 center-el-checkbox">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.is_purchase }"
                        >
                            <el-checkbox v-model="form.is_purchase"
                                >Es para compra ?</el-checkbox
                            >
                            <br />
                            <small
                                class="form-control-feedback"
                                v-if="errors.is_purchase"
                                v-text="errors.is_purchase[0]"
                            ></small>
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
</template>

<script>
export default {
    props: ["showDialog", "type", "recordId"],
    data() {
        return {
            loading_submit: false,
            titleDialog: null,
            resource: "payment_method_types_general",
            errors: {},
            form: {}
        };
    },
    async created() {
        await this.initForm();
    },
    methods: {
        initForm() {
            this.errors = {};
            this.form = {
                id: null,
                type: this.type,
                is_sale: this.type == "sale" ? true : false,
                is_purchase: this.type == "purchase" ? true : false,
                description: null,
                has_card: 0,
                charge: null,
                number_days: null
            };
        },
        create() {
            this.titleDialog = this.recordId
                ? "Editar condición de pago"
                : "Nueva condición de pago";
            if (this.recordId) {
                this.$http
                    .get(`/${this.resource}/record/${this.recordId}`)
                    .then(response => {
                        this.form = response.data.data;
                    });
            }
        },
        submit() {
            this.loading_submit = true;
            this.$http
                .post(`/${this.resource}`, this.form)
                .then(response => {
                    if (response.data.success) {
                        this.$message.success(response.data.message);
                        this.$eventHub.$emit("reloadData");
                        this.close();
                    } else {
                        this.$message.error(response.data.message);
                    }
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data;
                    } else {
                        console.log(error);
                    }
                })
                .then(() => {
                    this.loading_submit = false;
                });
        },
        close() {
            this.$emit("update:showDialog", false);
            this.initForm();
        }
    }
};
</script>
