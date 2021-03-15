<template>
    <div v-if="typeUser == 'admin'">
        <header
            class="page-header"
            style="display: flex; justify-content: space-between; align-items: center"
        >
            <div>
                <h2>Dashboard</h2>
            </div>
        </header>
        <div class="row">
            <div class="col-xl-6">
                <section
                    class="card card-featured-left card-featured-secondary"
                >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"
                                        >Establecimiento</label
                                    >
                                    <el-select
                                        v-model="form.establishment_id"
                                        @change="loadAll"
                                    >
                                        <el-option
                                            v-for="option in establishments"
                                            :key="option.id"
                                            :value="option.id"
                                            :label="option.name"
                                        ></el-option>
                                    </el-select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Periodo</label>
                                <el-select
                                    v-model="form.period"
                                    @change="changePeriod"
                                >
                                    <el-option
                                        key="all"
                                        value="all"
                                        label="Todos"
                                    ></el-option>
                                    <el-option
                                        key="month"
                                        value="month"
                                        label="Por mes"
                                    ></el-option>
                                    <el-option
                                        key="between_months"
                                        value="between_months"
                                        label="Entre meses"
                                    ></el-option>
                                    <el-option
                                        key="date"
                                        value="date"
                                        label="Por fecha"
                                    ></el-option>
                                    <el-option
                                        key="between_dates"
                                        value="between_dates"
                                        label="Entre fechas"
                                    ></el-option>
                                </el-select>
                            </div>
                            <template
                                v-if="
                                    form.period === 'month' ||
                                        form.period === 'between_months'
                                "
                            >
                                <div class="col-md-6">
                                    <label class="control-label">Mes de</label>
                                    <el-date-picker
                                        v-model="form.month_start"
                                        type="month"
                                        @change="changeDisabledMonths"
                                        value-format="yyyy-MM"
                                        format="MM/yyyy"
                                        :clearable="false"
                                    ></el-date-picker>
                                </div>
                            </template>
                            <template v-if="form.period === 'between_months'">
                                <div class="col-md-6">
                                    <label class="control-label">Mes al</label>
                                    <el-date-picker
                                        v-model="form.month_end"
                                        type="month"
                                        :picker-options="pickerOptionsMonths"
                                        @change="loadAll"
                                        value-format="yyyy-MM"
                                        format="MM/yyyy"
                                        :clearable="false"
                                    ></el-date-picker>
                                </div>
                            </template>
                            <template
                                v-if="
                                    form.period === 'date' ||
                                        form.period === 'between_dates'
                                "
                            >
                                <div class="col-md-6">
                                    <label class="control-label"
                                        >Fecha del</label
                                    >
                                    <el-date-picker
                                        v-model="form.date_start"
                                        type="date"
                                        @change="changeDisabledDates"
                                        value-format="yyyy-MM-dd"
                                        format="dd/MM/yyyy"
                                        :clearable="false"
                                    ></el-date-picker>
                                </div>
                            </template>
                            <template v-if="form.period === 'between_dates'">
                                <div class="col-md-6">
                                    <label class="control-label"
                                        >Fecha al</label
                                    >
                                    <el-date-picker
                                        v-model="form.date_end"
                                        type="date"
                                        :picker-options="pickerOptionsDates"
                                        @change="loadAll"
                                        value-format="yyyy-MM-dd"
                                        format="dd/MM/yyyy"
                                        :clearable="false"
                                    ></el-date-picker>
                                </div>
                            </template>
                        </div>
                    </div>
                </section>
            </div>
            <div
                v-bind:class="[
                    company.certificate_due != null ? 'col-xl-4' : 'col-xl-6'
                ]"
                v-if="!disc.error"
            >
                <section
                    class="card card-featured-left card-featured-secondary"
                >
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col">
                                <div class="row no-gutters">
                                    <div class="col-md-12 m-b-10">
                                        <h4 class="card-title">
                                            Disco Duro
                                            <small>Porcentaje de uso</small>
                                        </h4>
                                    </div>
                                    <div class="col-lg-12 py-2">
                                        <div class="summary">
                                            <el-progress
                                                :percentage="disc.pcent"
                                            ></el-progress>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-xl-2" v-if="company.certificate_due">
                <section
                    class="card card-featured-left card-featured-secondary"
                >
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col">
                                <div class="row no-gutters">
                                    <div class="col-md-12 m-b-10">
                                        <h4 class="card-title">Certificado</h4>
                                    </div>
                                    <div class="col-lg-12 py-1">
                                        <div class="summary">
                                            Vence: {{ company.certificate_due }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-6 col-md-12 col-lg-12">
                        <dashboard-stock></dashboard-stock>
                    </div>
                </div>
            </div>
            <div class="col-xl-4"></div>
        </div>
    </div>
</template>
<style>
.widget-summary .summary {
    min-height: inherit;
}

.custom-badge {
    font-size: 15px;
    font-weight: bold;
}
</style>
<script>
import DashboardStock from "./partials/dashboard_stock.vue";
import LoaderGraph from "../components/loaders/l-graph.vue";

export default {
    props: ["typeUser", "soapCompany"],
    components: { DashboardStock, LoaderGraph },
    data() {
        return {
            resource: "dashboard",
            establishments: [],
            disc: [],
            form: {},
            pickerOptionsDates: {
                disabledDate: time => {
                    time = moment(time).format("YYYY-MM-DD");
                    return this.form.date_start > time;
                }
            },
            pickerOptionsMonths: {
                disabledDate: time => {
                    time = moment(time).format("YYYY-MM");
                    return this.form.month_start > time;
                }
            },
            items: [],
            company: {}
        };
    },
    async created() {
        this.initForm();
        await this.$http.get(`/${this.resource}/filter`).then(response => {
            this.establishments = response.data.establishments;
            this.form.establishment_id =
                this.establishments.length > 0
                    ? this.establishments[0].id
                    : null;
        });
        await this.loadAll();
    },

    methods: {
        initForm() {
            this.form = {
                establishment_id: null,
                period: "month",
                date_start: moment().format("YYYY-MM-DD"),
                date_end: moment().format("YYYY-MM-DD"),
                month_start: moment().format("YYYY-MM"),
                month_end: moment().format("YYYY-MM")
            };
        },
        changeDisabledDates() {
            if (this.form.date_end < this.form.date_start) {
                this.form.date_end = this.form.date_start;
            }
            this.loadAll();
        },
        changeDisabledMonths() {
            if (this.form.month_end < this.form.month_start) {
                this.form.month_end = this.form.month_start;
            }
            this.loadAll();
        },
        changePeriod() {
            if (this.form.period === "month") {
                this.form.month_start = moment().format("YYYY-MM");
                this.form.month_end = moment().format("YYYY-MM");
            }
            if (this.form.period === "between_months") {
                this.form.month_start = moment()
                    .startOf("year")
                    .format("YYYY-MM"); //'2019-01';
                this.form.month_end = moment()
                    .endOf("year")
                    .format("YYYY-MM");
            }
            if (this.form.period === "date") {
                this.form.date_start = moment().format("YYYY-MM-DD");
                this.form.date_end = moment().format("YYYY-MM-DD");
            }
            if (this.form.period === "between_dates") {
                this.form.date_start = moment()
                    .startOf("month")
                    .format("YYYY-MM-DD");
                this.form.date_end = moment()
                    .endOf("month")
                    .format("YYYY-MM-DD");
            }
            this.loadAll();
        },
        loadAll() {
            this.loadData();
            this.loadCompany();
            this.changeStock();
        },
        changeStock() {
            this.$eventHub.$emit("changeStock", this.form.establishment_id);
        },
        loadCompany() {
            this.$http.get(`/companies/record`).then(response => {
                this.company = response.data.data;
            });
        },
        loadData() {
            this.$http.get(`/command/df`).then(response => {
                if (response.data[0] != "error") {
                    this.disc.used = Number(
                        response.data[0].replace(/[^0-9\.]+/g, "")
                    );
                    this.disc.avail = Number(
                        response.data[1].match(/\d/g).join("")
                    );
                    this.disc.pcent = Number(
                        response.data[2].match(/\d/g).join("")
                    );
                } else {
                    this.disc.error = true;
                }
            });
        }
    }
};
</script>
