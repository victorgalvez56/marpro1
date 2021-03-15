<template>
  <el-dialog :title="`USUARIOS DE ${personName} ` " :visible="showDialog" @close="close" @open="getData">
    <div class="form-body">
      <div class="row">
        <div class="col-md-12" v-if="records.length > 0">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(row, index) in records" :key="index">
                  <template v-if="row.id">
                    <td>{{ row.email }}</td>
                    <td class="series-table-actions text-right">
                      <button
                        type="button"
                        class="btn waves-effect waves-light btn-xs btn-danger"
                        @click.prevent="clickDelete(row.id)"
                      >Eliminar</button>
                    </td>
                  </template>
                  <template v-else>
                    <td>
                      <div class="form-group mb-0" :class="{'has-danger': row.errors.user_id}">
                        <el-select v-model="row.user_id"  :clearable="false" filterable  >
                          <el-option
                            v-for="option in users"
                            :key="option.id"
                            :value="option.id"
                            :label="option.email"
                          ></el-option>
                        </el-select>
                        <small
                          class="form-control-feedback"
                          v-if="row.errors.user_id"
                          v-text="row.errors.user_id[0]"
                        ></small>
                      </div>
                    </td>

                    <td class="series-table-actions text-right">
                      <button
                        type="button"
                        class="btn waves-effect waves-light btn-xs btn-info"
                        @click.prevent="clickSubmit(index)"
                      >
                        <i class="fa fa-check"></i>
                      </button>
                      <button
                        type="button"
                        class="btn waves-effect waves-light btn-xs btn-danger"
                        @click.prevent="clickCancel(index)"
                      >
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </template>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12 text-center pt-2" v-if="showAddButton">
          <el-button type="primary" icon="el-icon-plus" @click="clickAddRow">Nuevo</el-button>
        </div>
      </div>
    </div>
  </el-dialog>
</template>

<script>
import { deletable } from "../../../../mixins/deletable";

export default {
  props: ["showDialog","personName",  "personId"],
  mixins: [deletable],
  data() {
    return {
      resource: "person-users",
      records: [],
      users: [],
      all_users: [],
      showAddButton: true
    };
  },
  async created() {
    await this.initForm();
    await this.tables();
  },
  methods: {
    async tables(){
      await this.$http.get(`/${this.resource}/tables`).then(response => {
          this.all_users = response.data.users;
          this.initUsers();
      });
    },
    initForm() {
      this.records = [];
      this.showAddButton = true;
    },
    async getData() {
      if (this.personId) {
        await this.$http
          .get(`/${this.resource}/records/${this.personId}`)
          .then(response => {
            if (response.data !== "") {
              this.records = response.data.data;
            }
          });
      }
    },
    clickAddRow() {
      this.records.push({
        id: null,
        user_id: null,
        errors: {},
        loading: false
      });
      this.showAddButton = false;
    },
    clickCancel(index) {
      this.records.splice(index, 1);
      this.initUsers();
      this.showAddButton = true;
    },
    clickSubmit(index) {
      let form = {
        id: this.records[index].id,
        person_id: this.personId,
        user_id: this.records[index].user_id
      };
      this.$http
        .post(`/${this.resource}`, form)
        .then(response => {
          if (response.data.success) {
            this.$message.success(response.data.message);
            this.tables();
            this.getData();
            this.initUsers();
            this.showAddButton = true;
            this.$eventHub.$emit('reloadData');
          } else {
            this.$message.error(response.data.message);
          }
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.records[index].errors = error.response.data;
          } else {
            console.log(error);
          }
        });
    },

    initUsers() {
      this.users = this.all_users.length > 0 ? this.all_users : [];
    },
    close() {
      this.$emit("update:showDialog", false);
      this.initUsers();
      this.initForm();
    },
    clickDelete(id) {
      this.destroy(`/${this.resource}/${id}`)
          .then(() => {this.getData(),
                      this.initUsers()
                      this.$eventHub.$emit('reloadData');
          });
    }
  }
};
</script>
