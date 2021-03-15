<template>
    <div>
        <div class="page-header pr-0">
            <h2>
                <a href="/dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                </a>
            </h2>
            <ol class="breadcrumbs">
                <li class="active"><span>Configuración</span></li>
                <li><span class="text-muted">Términos y condiciones</span></li>
            </ol>
        </div>
        <div class="card mb-0 pt-2 pt-md-0">
            <div class="tab-content">
                <div class="invoice">
                    <form autocomplete="off" @submit.prevent="submit">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label
                                            class="control-label label-size-terms_conditions"
                                            >Términos y condiciones</label
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-7"></div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <el-button
                                            type="primary"
                                            native-type="submit"
                                            @click.prevent="
                                                saveTermsAndConditions()
                                            "
                                            >Guardar</el-button
                                        >
                                    </div>
                                </div>
                            </div>
                            <el-divider class="color-divider"></el-divider>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <vue-editor
                                            v-loading="loading"
                                            id="editor1"
                                            :editorToolbar="customToolbar"
                                            v-model="content"
                                        ></vue-editor>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-actions text-right mt-4">
                            <el-button>Cancelar</el-button>
                            <el-button type="primary" native-type="submit"
                                >Generar</el-button
                            >
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
    components: {
        VueEditor
    },
    data() {
        return {
            resource: "terms_conditions",
            showDialog: false,
            recordId: null,
            content: "",
            loading: true,
            customToolbar: [
                [{ header: [false, 1, 2, 3, 4, 5, 6] }],
                ["bold", "italic", "underline", "strike"],
                [
                    { align: "" },
                    { align: "center" },
                    { align: "right" },
                    { align: "justify" }
                ],
                [{ header: 1 }, { header: 2 }],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ script: "sub" }, { script: "super" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ color: [] }, { background: [] }],
                ["link"],
                ["clean"],
                ["image", "code-block"]
            ]
        };
    },
    created() {
        this.getTermsAndConditions();
    },
    methods: {
        clickCreate(recordId = null) {
            this.recordId = recordId;
            this.showDialog = true;
        },
        getTermsAndConditions() {
            this.$http
                .get(`/${this.resource}/show`)
                .then(response => {
                    this.content = response.data.content;
                    this.loading = false;
                })
                .catch(error => {
                    // if (error.response.status === 422) {
                    //     this.errors = error.response.data
                    // } else {
                    this.$message.error(error.response.data.message);
                    this.loading = false;
                    // }
                });
        },
        saveTermsAndConditions() {
            this.loading = true;
            const modification = {
                content: this.content
            };
            this.$http
                .post(`/${this.resource}/write`, modification)
                .then(response => {
                    this.loading = false;
                    this.$message({
                        showClose: true,
                        message: `Terminos y condiciones actualizado`,
                        duration: 2 * 3000,
                        type: "success"
                    });
                })
                .catch(error => {
                    // if (error.response.status === 422) {
                    //     this.errors = error.response.data
                    // } else {
                    this.loading = false;
                    this.$message.error(error.response.data.message);
                    // }
                });
        }
    }
};
</script>

<style scoped>
/* @import "~vue2-editor/dist/vue2-editor.css"; */
@import "~vue2-editor/dist/vue2-editor.css";

/* Import the Quill styles you want */
@import "~quill/dist/quill.core.css";
@import "~quill/dist/quill.bubble.css";
@import "~quill/dist/quill.snow.css";
.label-size-terms_conditions {
    font-size: xx-large !important;
}
.color-divider {
    background-color: transparent !important;
}
</style>
