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
                    <span>Banners</span>
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
                <h3 class="my-0">Listado de banners</h3>
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
                                <th width="70%">Imagen</th>
                                <th class="text-center">Links</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(row, index) in records"
                                v-bind:key="index"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>
                                    <img
                                        :src="row.src_image"
                                        class="table__banner"
                                    />
                                </td>
                                <td class="text-center">
                                    <el-button
                                        v-if="row.links.length > 0"
                                        @click.prevent="showLinks(row.links)"
                                    >
                                        <i class="fa fa-eye"></i>
                                    </el-button>
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
                width="70%"
                @close="close"
                @opened="initElement"
            >
                <form autocomplete="off" @submit.prevent="submit">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label"
                                                >Imagen
                                                <span class="text-danger"></span
                                            ></label>
                                            <el-upload
                                                class="avatar-uploader"
                                                :data="{ type: 'banners' }"
                                                :headers="headers"
                                                :action="`/${resource}/uploads`"
                                                :show-file-list="false"
                                                :on-success="onSuccess"
                                                accept="image/png,image/jpeg"
                                            >
                                                <div class="container__img">
                                                    <img
                                                        v-if="form.src_image"
                                                        :src="form.src_image"
                                                        id="banner"
                                                        class="banner"
                                                    />
                                                    <i
                                                        v-else
                                                        class="el-icon-plus avatar-uploader-icon"
                                                    ></i>
                                                </div>
                                            </el-upload>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12 text-center mb-2">
                                            <el-button
                                                size="mini"
                                                icon="el-icon-plus"
                                                @click.prevent="addLink()"
                                                >Agregar link</el-button
                                            >
                                        </div>

                                        <div class="col-md-12">
                                            <div
                                                class="row m-t-10"
                                                v-for="(row,
                                                index) in form.links"
                                                :key="index"
                                            >
                                                <div class="col-md-12 mt-4">
                                                    <label
                                                        class="control-label"
                                                    >
                                                        # {{ index + 1 }}
                                                        <el-button
                                                            size="mini"
                                                            icon="el-icon-minus"
                                                            @click.prevent="
                                                                removeLink(
                                                                    index
                                                                )
                                                            "
                                                            class="btn-default-danger"
                                                            >Eliminar
                                                        </el-button>
                                                    </label>
                                                    <!-- <el-button
                                                        size="mini"
                                                        icon="el-icon-view"
                                                        @click.prevent="
                                                            addCss(index, row)
                                                        "
                                                        class="btn-default-danger"
                                                        >Previsualizar</el-button
                                                    > -->
                                                </div>
                                                <hr />
                                                <div class="col-md-4">
                                                    <div
                                                        class="form-group"
                                                        :class="{
                                                            'has-danger':
                                                                errors.href
                                                        }"
                                                    >
                                                        <label
                                                            class="control-label"
                                                            >Link</label
                                                        >
                                                        <el-input
                                                            v-model="row.href"
                                                        ></el-input>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label
                                                            class="control-label"
                                                            >Superior</label
                                                        >
                                                        <el-input-number
                                                            v-model="row.top"
                                                            :min="0.01"
                                                            @change="
                                                                previewIndicator(
                                                                    index,
                                                                    row
                                                                )
                                                            "
                                                        ></el-input-number>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label
                                                            class="control-label"
                                                            >Derecha</label
                                                        >
                                                        <el-input-number
                                                            v-model="row.right"
                                                            :min="0.01"
                                                            @change="
                                                                previewIndicator(
                                                                    index,
                                                                    row
                                                                )
                                                            "
                                                        ></el-input-number>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label
                                                            class="control-label"
                                                            >Alto</label
                                                        >
                                                        <el-input-number
                                                            v-model="row.height"
                                                            :min="0.01"
                                                            @change="
                                                                previewIndicator(
                                                                    index,
                                                                    row
                                                                )
                                                            "
                                                        ></el-input-number>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label
                                                            class="control-label"
                                                            >Ancho</label
                                                        >
                                                        <el-input-number
                                                            v-model="row.width"
                                                            :min="0.01"
                                                            @change="
                                                                previewIndicator(
                                                                    index,
                                                                    row
                                                                )
                                                            "
                                                        ></el-input-number>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label
                                                            class="control-label"
                                                            >CSS</label
                                                        >
                                                        <el-input
                                                            v-model="row.css"
                                                        ></el-input>
                                                    </div>
                                                    <el-button
                                                        size="mini"
                                                        icon="el-icon-plus"
                                                        @click.prevent="
                                                            addCss(index, row)
                                                        "
                                                        >Agregar css</el-button
                                                    >
                                                </div>
                                            </div>
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
            <link-index
                :showDialog.sync="showDialogLink"
                :links="links"
            ></link-index>
        </div>
    </div>
</template>

<script>
import DataTable from "../../../components/DataTable.vue";
import LinkIndex from "./partials/link.vue";
import { deletable } from "../../../mixins/deletable";

export default {
    mixins: [deletable],
    components: { DataTable, LinkIndex },
    data() {
        return {
            headers: headers_token,
            showDialog: false,
            showDialogLink: false,
            titleDialog: null,
            loading_submit: false,
            resource: "banners",
            errors: {},
            form: {},
            editedIndex: -1,
            records: [],
            tmp_records: [],
            links: [],
            count_links: 0,
            style_element:
                " background-color: #ffffff;border: 4px solid red;opacity: 0.7; font-size:14px; font-weight: bold;"
        };
    },
    async created() {
        await this.getRecords();
        this.initForm();
    },
    methods: {
        initForm() {
            this.errors = {};
            this.form = {
                src_image: null,
                links: [],
                is_new: true,
                is_update: false
            };
            this.editedIndex = -1;
        },
        calculateCountLink() {
            let max = 0;
            for (let i = 0; i < this.records.length; i++) {
                const record = this.records[i];
                const link_length = record.links.length;
                if (link_length > max) {
                    max = link_length;
                }
            }
            this.count_links = max;
        },
        async getRecords() {
            return this.$http
                .get(`/${this.resource}/records`)
                .then(response => {
                    this.records = response.data;
                    this.calculateCountLink();
                });
        },
        onSuccess(response, file, fileList) {
            if (response.success) {
                this.form.is_update_image = true;
                this.form.image = response.data.filename;
                this.form.src_image = response.data.temp_image;
                this.form.temp_path = response.data.temp_path;
            } else {
                this.$message.error(response.message);
            }
        },
        close() {
            this.showDialog = false;
            this.initForm();
        },
        validate() {
            let cont_href = 0;
            let cont_style = 0;
            if (!this.form.src_image) {
                this.$message.error("El campo imagen es requerido");
                return false;
            }
            this.form.links.forEach(element => {
                if (!element.href) {
                    cont_href++;
                }
                if (!element.style) {
                    cont_style++;
                }
            });
            if (cont_href > 0 && cont_style > 0) {
                this.$message.error("El campo link y style es requerido");
                return false;
            }
            if (cont_href > 0) {
                this.$message.error("El campo link es requerido");
                return false;
            }
            if (cont_style > 0) {
                this.$message.error("El campo style es requerido");
                return false;
            }
            return true;
        },
        addItem() {
            this.initForm();
            this.titleDialog = "Agregar banner";
            this.showDialog = true;
        },
        editItem(item) {
            this.titleDialog = "Editar bannner";
            this.editedIndex = this.records.indexOf(item);
            // this.form = Object.assign({}, item);
            this.form = _.cloneDeep(item);
            this.form.is_update = true;
            this.showDialog = true;
        },
        getStyleTransform(row) {
            return `position: absolute; top: ${row.top}%; right: ${row.right}%; height:${row.height}%; width: ${row.width}%; `;
        },
        addElement(index, row) {
            let container_img = document.getElementsByClassName(
                "container__img"
            )[0];
            let a = document.createElement("a");
            a.id = `link-${index}`;
            a.textContent = `${index + 1}`;
            a.style.cssText = this.style_element;
            a.style.cssText += row.style;
            container_img.appendChild(a);
            return a;
        },
        initElement() {
            //init show elements
            for (let index = 0; index < this.count_links; index++) {
                let link = document.getElementById(`link-${index}`);
                if (link) {
                    link.remove();
                }
            }
            if (this.form.is_update) {
                for (let index = 0; index < this.form.links.length; index++) {
                    const row = this.form.links[index];
                    this.addElement(index, row);
                }
            }
        },
        async deleteItem(index) {
            try {
                const isAccept = confirm(
                    "¿Esta seguro de eliminar este banner?"
                );
                if (isAccept) {
                    this.tmp_records = [...this.records];
                    this.tmp_records.splice(index, 1);
                    const send = {};
                    send.status = "deleted";
                    send.records = this.tmp_records;
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
        addLink() {
            const row = {
                href: null,
                style: "",
                top: 50,
                right: 50,
                height: 10,
                width: 10,
                css: ""
            };

            row.style = this.getStyleTransform(row);
            this.form.links.push(row);
            this.addElement(this.form.links.length - 1, row);
        },
        removeLink(index) {
            this.form.links.splice(index, 1);
            let link = document.getElementById(`link-${index}`);
            this.initElement();
        },
        showLinks(links) {
            this.links = links;
            this.showDialogLink = true;
        },
        addCss(index, row) {
            const a = document.getElementById(`link-${index}`);
            const array_style = row.style.split(";");
            let style = "";
            for (let i = 0; i < 5; i++) {
                let item = array_style[i];
                style += array_style.length === i + 1 ? item : item + ";";
            }
            row.style = style + row.css;
            a.style.cssText = row.style + this.style_element + row.css;
        },
        previewIndicator(index, row) {
            let a = document.getElementById(`link-${index}`);
            row.style = this.getStyleTransform(row) + row.css;
            a.style.cssText =
                this.style_element + this.getStyleTransform(row) + row.css;
        },
        async submit() {
            try {
                if (this.validate()) {
                    const send = {};
                    if (this.editedIndex > -1) {
                        this.tmp_records = [...this.records];
                        this.tmp_records[this.editedIndex] = Object.assign(
                            {},
                            this.form
                        );
                        send.status = "updated";
                    } else {
                        this.tmp_records = [...this.records];
                        this.tmp_records.push(this.form);
                        send.status = "created";
                    }
                    send.records = this.tmp_records;
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
<style scoped>
.table__banner {
    width: 60%;
    height: auto;
    display: block;
}
.banner {
    width: 100%;
    height: auto;
    display: block;
}

.link__button {
    position: absolute;
    top: 78.3%;
    right: 42.5%;
    height: 12.2%;
    width: 13%;
}

.container__img {
    position: relative;
}
</style>
