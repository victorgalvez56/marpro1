<template>
    <div>
        <div class="row ">
            <div class="col-md-12 col-lg-12 col-xl-12 ">
                <div class="row">
                    <div class="col-lg-8 col-md-8 mb-2">
                        <div class="form-group">
                            <label class="control-label font-custom"
                                ><strong>Filtros de busqueda</strong></label
                            >
                            <template v-if="!see_more">
                                <a
                                    class="control-label font-weight-bold text-info font-custom"
                                    href="#"
                                    @click="clickSeeMore"
                                    ><strong> [+ Ver más]</strong></a
                                >
                            </template>
                            <template v-else>
                                <a
                                    class="control-label font-weight-bold text-info font-custom"
                                    href="#"
                                    @click="clickSeeMore"
                                    ><strong> [- Ver menos]</strong></a
                                >
                            </template>
                        </div>
                    </div>
                </div>
                <div class="row mt-2" v-if="see_more">
                    <div class="col-lg-3 col-md-2 ">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <el-input
                                placeholder="Ingresé el email"
                                v-model="search.email"
                            >
                            </el-input>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2 ">
                        <div class="form-group">
                            <label class="control-label">Nombre</label>
                            <el-input
                                placeholder="Ingresé el nombre"
                                v-model="search.name"
                            >
                            </el-input>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="control-label">Perfil</label>
                            <el-select v-model="search.type">
                                <el-option
                                    v-for="option in types"
                                    :key="option.type"
                                    :value="option.type"
                                    :label="option.description"
                                ></el-option>
                            </el-select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="control-label">Perfil</label>
                            <el-select v-model="search.establishment_id">
                                <el-option
                                    v-for="option in establishments"
                                    :key="option.id"
                                    :value="option.id"
                                    :label="option.description"
                                ></el-option>
                            </el-select>
                        </div>
                    </div>

                    <div
                        class="col-lg-4 col-md-4 col-md-4 col-sm-12"
                        style="margin-top:29px"
                    >
                        <el-button
                            class="submit"
                            type="primary"
                            @click.prevent="getRecordsByFilter"
                            :loading="loading_submit"
                            icon="el-icon-search"
                            >Buscar</el-button
                        >
                        <el-button
                            class="submit"
                            type="info"
                            @click.prevent="cleanInputs"
                            icon="el-icon-delete"
                            >Limpiar
                        </el-button>
                    </div>
                </div>
                <div class="row mt-1 mb-3"></div>
            </div>

            <div class="col-md-12">
                <div id="scroll1" style="overflow-x:auto;">
                    <div style="height: 20px;"></div>
                </div>
                <div
                    class="table-responsive"
                    id="scroll2"
                    style="overflow-x:auto;"
                >
                    <table class="table">
                        <thead>
                            <slot name="heading"></slot>
                        </thead>
                        <tbody>
                            <slot
                                v-for="(row, index) in records"
                                :row="row"
                                :index="customIndex(index)"
                            ></slot>
                        </tbody>
                    </table>
                    <div>
                        <el-pagination
                            @current-change="getRecords"
                            layout="total, prev, pager, next"
                            :total="pagination.total"
                            :current-page.sync="pagination.current_page"
                            :page-size="pagination.per_page"
                        >
                        </el-pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.font-custom {
    font-size: 15px !important;
}
</style>
<script>
import moment from "moment";
import queryString from "query-string";
import $ from "jquery";

export default {
    props: {
        resource: String
    },
    data() {
        return {
            loading_submit: false,
            see_more: false,
            records: [],
            pagination: {},
            search: {},
            types: [],
            establishments: []
        };
    },
    computed: {},
    created() {
        this.initForm();
        this.$eventHub.$on("reloadData", () => {
            this.getRecords();
        });
    },
    async mounted() {
        await this.$http.get(`/${this.resource}/data_table`).then(response => {
            this.types = response.data.types;
            this.establishments = response.data.establishments;
        });

        await this.getRecords();
        await this.cargalo();
    },
    methods: {
        clickSeeMore() {
            this.see_more = this.see_more ? false : true;
        },
        initForm() {
            this.search = {
                email: null,
                name: null,
                type: null,
                establishment_id: null
            };
        },
        customIndex(index) {
            return (
                this.pagination.per_page * (this.pagination.current_page - 1) +
                index +
                1
            );
        },
        async getRecordsByFilter() {
            this.loading_submit = await true;
            await this.getRecords();
            this.loading_submit = await false;
        },
        getRecords() {
            return this.$http
                .get(`/${this.resource}/records?${this.getQueryParameters()}`)
                .then(response => {
                    this.records = response.data.data;
                    this.pagination = response.data.meta;
                    this.pagination.per_page = parseInt(
                        response.data.meta.per_page
                    );
                    this.loading_submit = false;
                });
        },
        getQueryParameters() {
            return queryString.stringify({
                page: this.pagination.current_page,
                limit: this.limit,
                ...this.search
            });
        },
        changeClearInput() {
            this.search.value = "";
        },
        cleanInputs() {
            this.initForm();
        },
        cargalo() {
            $("#scroll1 div").width($(".table").width());
            $("#scroll1").on("scroll", function() {
                $("#scroll2").scrollLeft($(this).scrollLeft());
            });
            $("#scroll2").on("scroll", function() {
                $("#scroll1").scrollLeft($(this).scrollLeft());
            });
        }
    }
};
</script>
