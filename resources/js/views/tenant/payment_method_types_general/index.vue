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
                    <span>Condiciones de pago</span>
                </li>
            </ol>
            <div class="right-wrapper pull-right">
                <template>
                    <!-- <div class="btn-group flex-wrap">
            <button
              type="button"
              class="btn btn-custom btn-sm mt-2 mr-2 dropdown-toggle"
              data-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="fa fa-download"></i> Exportar
              <span class="caret"></span>
            </button>
            <div
              class="dropdown-menu"
              role="menu"
              x-placement="bottom-start"
              style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 42px, 0px);"
            >
              <a class="dropdown-item text-1" href="#" @click.prevent="clickExport()">Listado</a>
              <a class="dropdown-item text-1" href="#" @click.prevent="clickExportWp()">Woocommerce</a>
            </div>
          </div>
          <div class="btn-group flex-wrap">
            <button
              type="button"
              class="btn btn-custom btn-sm mt-2 mr-2 dropdown-toggle"
              data-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="fa fa-upload"></i> Importar
              <span class="caret"></span>
            </button>
            <div
              class="dropdown-menu"
              role="menu"
              x-placement="bottom-start"
              style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 42px, 0px);"
            >
              <a class="dropdown-item text-1" href="#" @click.prevent="clickImport()">Productos</a>
              <a
                class="dropdown-item text-1"
                href="#"
                @click.prevent="clickImportListPrice()"
              >L. Precios</a>
            </div>
          </div>-->
                    <button
                        type="button"
                        class="btn btn-custom btn-sm mt-2 mr-2"
                        @click.prevent="clickCreate()"
                    >
                        <i class="fa fa-plus-circle"></i> Nuevo
                    </button>
                </template>
            </div>
        </div>
        <div class="card mb-0">
            <div class="card-header bg-info">
                <h3 class="my-0">Listado de condiciones de pago</h3>
            </div>
            <div class="card-body">
                <data-table :resource="resource + `/${this.type}`">
                    <tr slot="heading" width="100%">
                        <th>#</th>
                        <th>Id</th>
                        <th class="text-left">Descripción</th>
                        <th class="text-center">Tiene tarjeta</th>
                        <th class="text-right">Cargo</th>
                        <th class="text-center">Número dias</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                    <tr></tr>
                    <tr
                        slot-scope="{ index, row }"
                        :class="{ disable_color: false }"
                    >
                        <td>{{ index }}</td>
                        <td>{{ row.id }}</td>
                        <td class="text-left">{{ row.description }}</td>
                        <td class="text-center">
                            {{ row.has_card ? "Sí" : "No" }}
                        </td>
                        <td class="text-right">{{ row.charge }}</td>
                        <td class="text-center">{{ row.number_days }}</td>
                        <td class="text-right">
                            <template>
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
                                >
                                    Eliminar
                                </button>
                            </template>
                        </td>
                    </tr>
                </data-table>
            </div>

            <items-form
                :showDialog.sync="showDialog"
                :type="type"
                :recordId="recordId"
            ></items-form>

            <!-- <items-import :showDialog.sync="showImportDialog"></items-import>
      <items-import-list-price :showDialog.sync="showImportListPriceDialog"></items-import-list-price>
      <items-export :showDialog.sync="showExportDialog"></items-export>
      <items-export-wp :showDialog.sync="showExportWpDialog"></items-export-wp>
      <warehouses-detail :showDialog.sync="showWarehousesDetail" :warehouses="warehousesDetail"></warehouses-detail>-->
        </div>
    </div>
</template>
<script>
import ItemsForm from "./form.vue";
// import ItemsImport from "./import.vue";
// import ItemsImportListPrice from "./partials/import_list_price.vue";
// import ItemsExport from "./partials/export.vue";
// import ItemsExportWp from "./partials/export_wp.vue";
// import WarehousesDetail from "./partials/warehouses.vue";
import DataTable from "../../../components/DataTable.vue";
import { deletable } from "../../../mixins/deletable";

export default {
    mixins: [deletable],
    props: ["type"],
    components: {
        ItemsForm,
        // ItemsImportListPrice,
        // ItemsImport,
        // ItemsExport,
        // ItemsExportWp,
        // WarehousesDetail,
        DataTable
    },
    data() {
        return {
            showDialog: false,
            showImportDialog: false,
            showExportDialog: false,
            showExportWpDialog: false,
            showImportListPriceDialog: false,
            showWarehousesDetail: false,
            warehousesDetail: [],
            resource: "payment_method_types_general",
            recordId: null
        };
    },
    created() {},
    methods: {
        clickImport() {
            this.showImportDialog = true;
        },
        clickImportListPrice() {
            this.showImportListPriceDialog = true;
        },
        clickExport() {
            this.showExportDialog = true;
        },
        clickExportWp() {
            this.showExportWpDialog = true;
        },
        clickWarehouseDetail(warehouses) {
            this.warehousesDetail = warehouses;
            this.showWarehousesDetail = true;
        },
        clickCreate(recordId = null) {
            this.recordId = recordId;
            this.showDialog = true;
        },
        clickDelete(id) {
            this.destroy(`/${this.resource}/${id}`).then(() =>
                this.$eventHub.$emit("reloadData")
            );
        }
    }
};
</script>
