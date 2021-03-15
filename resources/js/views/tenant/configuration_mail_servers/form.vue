<template>
    <el-dialog
        :title="titleDialog"
        :visible="showDialog"
        @close="close"
        @open="create"
        :close-on-click-modal="false"
        append-to-body
    >
        <form autocomplete="off" @submit.prevent="submit">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.name }"
                        >
                            <label class="control-label">
                                Nombre
                                <span class="text-danger">*</span>
                            </label>
                            <el-input
                                :readonly="recordId !== null"
                                :disabled="recordId !== null"
                                v-model="form.name"
                                dusk="name"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.name"
                                v-text="errors.name[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.host }"
                        >
                            <label class="control-label">
                                Host
                                <span class="text-danger">*</span>
                            </label>
                            <el-input
                                v-model="form.host"
                                dusk="host"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.host"
                                v-text="errors.host[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.port }"
                        >
                            <label class="control-label">
                                Puerto
                                <span class="text-danger">*</span>
                            </label>
                            <el-input
                                v-model="form.port"
                                dusk="port"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.port"
                                v-text="errors.port[0]"
                            ></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.username }"
                        >
                            <label class="control-label">
                                Usuario
                                <span class="text-danger">*</span>
                            </label>
                            <el-input
                                v-model="form.username"
                                dusk="username"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.username"
                                v-text="errors.username[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.password }"
                        >
                            <label class="control-label">
                                Contraseña
                                <span class="text-danger">*</span>
                            </label>
                            <el-input
                                v-model="form.password"
                                dusk="password"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.password"
                                v-text="errors.password[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.encryption }"
                        >
                            <label class="control-label">
                                Cifrado
                            </label>
                            <el-input
                                v-model="form.encryption"
                                dusk="encryption"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.encryption"
                                v-text="errors.encryption[0]"
                            ></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.driver }"
                        >
                            <label class="control-label">Driver</label>
                            <el-input
                                v-model="form.driver"
                                dusk="driver"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.driver"
                                v-text="errors.driver[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.protocol }"
                        >
                            <label class="control-label">Protocolo</label>
                            <el-input
                                v-model="form.protocol"
                                dusk="protocol"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.protocol"
                                v-text="errors.protocol[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.default_account }"
                        >
                            <label class="control-label"
                                >Cuenta predeterminada</label
                            >
                            <el-input
                                v-model="form.default_account"
                                dusk="default_account"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.default_account"
                                v-text="errors.default_account[0]"
                            ></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.from_address }"
                        >
                            <label class="control-label">From address</label>
                            <el-input
                                v-model="form.from_address"
                                dusk="from_address"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.from_address"
                                v-text="errors.from_address[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.from_name }"
                        >
                            <label class="control-label">From name</label>
                            <el-input
                                v-model="form.from_name"
                                dusk="from_name"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.from_name"
                                v-text="errors.from_name[0]"
                            ></small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" style="padding-top: 32px">
                            <el-checkbox v-model="form.validate_cert"
                                >Validar cert</el-checkbox
                            >
                            <el-checkbox v-model="form.is_active"
                                >Activo</el-checkbox
                            >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.reply_address }"
                        >
                            <label class="control-label"
                                >Correo de respuesta</label
                            >
                            <el-input
                                v-model="form.reply_address"
                                dusk="reply_address"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.reply_address"
                                v-text="errors.reply_address[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.reply_name }"
                        >
                            <label class="control-label"
                                >Nombre de respuesta</label
                            >
                            <el-input
                                v-model="form.reply_name"
                                dusk="reply_name"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.reply_name"
                                v-text="errors.reply_name[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.cc_address }"
                        >
                            <label class="control-label">CC</label>
                            <el-input
                                v-model="form.cc_address"
                                dusk="cc_address"
                            ></el-input>
                            <small
                                class="form-control-feedback"
                                v-if="errors.cc_address"
                                v-text="errors.cc_address[0]"
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
    props: ["showDialog", "recordId"],
    data() {
        return {
            loading_submit: false,
            titleDialog: null,
            resource: "configuration_mail_servers",
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
                name: null,
                host: null,
                port: null,
                username: null,
                password: null,
                encryption: null,
                driver: null,
                protocol: null,
                default_account: null,
                from_address: null,
                from_name: null,
                reply_address: null,
                reply_name: null,
                cc_address: null,
                validate_cert: false,
                is_active: false
            };
        },
        create() {
            this.titleDialog = this.recordId
                ? "Editar servidor de correo"
                : "Nuevo servidor de correo";
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
            // this.form.encryption = this.form.encryption
            //     ? this.form.encryption
            //     : "tls";
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
