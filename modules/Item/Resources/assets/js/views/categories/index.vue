<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">{{ title }}</h4>
          </template>
          <template v-slot:headerAction>
            <b-button variant="primary" @click.prevent="clickCreate()">Add User</b-button>
          </template>
          <template v-slot:body>
            <data-table :resource="resource">
                    <tr slot="heading">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Fecha creación</th>
                        <th class="text-right">Acciones</th>
                    <tr>
                    <tr slot-scope="{ index, row }">
                        <td>{{ index }}</td>
                        <td>{{ row.name }}</td>
                        <td>{{ row.created_at }}</td>
                        <td class="text-right">
                            <button type="button" class="btn waves-effect waves-light btn-xs btn-info" @click.prevent="clickCreate(row.id)">Editar</button>
                            <button type="button" class="btn waves-effect waves-light btn-xs btn-danger" @click.prevent="clickDelete(row.id)">Eliminar</button>
                        </td>
                    </tr>
                </data-table>
          </template>
          
            <category-form 
                :showDialog.sync="showDialog"
                :recordId="recordId"
                    ></category-form> 
        </iq-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import CategoryForm from './form.vue' 
    import DataTable from '../../../../../../../resources/js/components/DataTable.vue'
    import {deletable} from '../../../../../../../resources/js/mixins/deletable'

    export default {
        mixins: [deletable],
        components: {DataTable, CategoryForm},
        data() {
            return {
                title: null,
                showDialog: false, 
                resource: 'categories',
                recordId: null,
            }
        },
        created() {
            this.title = 'Categorías'
        },
        methods: { 
            clickCreate(recordId = null) {
                this.recordId = recordId
                this.showDialog = true
            }, 
            clickDelete(id) {
                this.destroy(`/${this.resource}/${id}`).then(() =>
                    this.$eventHub.$emit('reloadData')
                )
            }
        }
    }
</script>
