<template>
    <div class="projects">
        <div class="tableFilters">
            <div><h3>Cadastro de Propriedade</h3> </div>
            <div class="control">
                <div class="select">
                    <select v-model="tableData.length" @change="getData()">
                        <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                    </select>
                </div>
                <input class="input" type="text" style="width:60%"  v-model="tableData.search" placeholder="Buscar por Email ou Cidade"
                   @input="getData()">
                    <button type="button" class="btn btn-info" @click="create">
                Add Propriedade
                <i class="fas fa-plus"></i>
              </button>
            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
                <tr v-for="item in arr_prop" :key="item.id">
                    <td>{{item.email_prop}}</td>
                    <td>{{item.rua +','+item.numero+','+ item.cidade +','+ item.estado }}</td>
                    <td>{{ (item.status == 'n')?'N/Contratado':'Contratado' }}</td>
                    <td>
                        <button type="button" @click="show(item)"   class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button type="button" @click="edit(item)" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button  type="button"  @click="destroy(item)"   class="btn btn-danger btn-sm" >
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </td>
                </tr>
            </tbody>
        </datatable>
        <pagination :pagination="pagination"
                    @prev="getData(pagination.prevPageUrl)"
                    @next="getData(pagination.nextPageUrl)">
        </pagination>



<!-- Modal Edit -->
    <div
      class="modal fade"
      id="propriedadeModalLong"
      tabindex="-1"
      role="dialog"
      aria-labelledby="propriedadeModalLongTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="propriedadeModalLongTitle"
            >{{ editMode ? "Edit" : "Add New" }} Propriedade</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <alert-error :form="form"></alert-error>
               <div class="form-group">
                <label><b>Email</b> </label>
                <input
                  v-model="form.email_prop"
                  type="email"
                  name="email_prop"
                  class="form-control"
                  :required="true"
                  :class="{ 'is-invalid': form.errors.has('email_prop') }"
                >
                <has-error :form="form" field="email_prop"></has-error>
              </div>
             <div class="form-group">
                <label><b>Rua</b> </label>
                <input
                  v-model="form.rua"
                  type="text"
                  name="rua"
                  class="form-control"
                  :required="true"
                  :class="{ 'is-invalid': form.errors.has('rua') }"
                >
                <has-error :form="form" field="rua"></has-error>
              </div>
               <div class="form-group">
                <label><b>Numero</b> </label>
                <input
                  v-model="form.numero"
                  type="text"
                  name="numero"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('numero') }"
                >
                <has-error :form="form" field="numero"></has-error>
              </div>
                <div class="form-group">
                <label><b>Complemento</b> </label>
                <input
                  v-model="form.complemento"
                  type="text"
                  name="complemento"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('complemento') }"
                >
                <has-error :form="form" field="complemento"></has-error>
              </div>
                <div class="form-group">
                <label><b>Bairro</b> </label>
                <input
                  v-model="form.bairro"
                  type="text"
                  name="bairro"
                  class="form-control"
                  :required="true"
                  :class="{ 'is-invalid': form.errors.has('bairro') }"
                >
                <has-error :form="form" field="bairro"></has-error>
              </div>
                <div class="form-group">
                <label><b>Cidade</b> </label>
                <input
                  v-model="form.cidade"
                  type="text"
                  name="cidade"
                  class="form-control"
                  :required="true"
                  :class="{ 'is-invalid': form.errors.has('cidade') }"
                >
                <has-error :form="form" field="cidade"></has-error>
              </div>
                <div class="form-group">
                <label><b>Estado</b> </label>
                <input
                  v-model="form.estado"
                  type="text"
                  name="estado"
                  class="form-control"
                  :required="true"
                  :class="{ 'is-invalid': form.errors.has('estado') }"
                >
                <has-error :form="form" field="estado"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>

        </div>
      </div>
    </div>
    <!-- Modal -->



  <!-- Modal Show -->
    <div
      class="modal fade"
      id="showModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="showModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showModalLabel">{{ form.id }}</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <strong>Email : {{ form.email_prop }}</strong>
            <br>
            <strong>Rua : {{ form.rua }}</strong>
            <br>
             <strong>N˚ : {{ form.numero }}</strong>
            <br>
             <strong>Complemento : {{ form.complemento }}</strong>
            <br>
             <strong>Bairro : {{ form.bairro }}</strong>
            <br>
             <strong>Cidade : {{ form.cidade }}</strong>
            <br>
             <strong>Estado : {{ form.estado }}</strong>
            <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>



    <vue-progress-bar></vue-progress-bar>
    <vue-snotify></vue-snotify>


    </div>
</template>

<script>
import Datatable from './Datatable.vue';
import Pagination from './Pagination.vue';
export default {
    components: { datatable: Datatable, pagination: Pagination },
    created() {
        this.editMode = false;
        this.getData();
        this.form.reset();
        this.form.clear();
      $("#propriedadeModalLong").modal("show");
    },
    data() {
        let sortOrders = {};

        let columns = [
            {width: '25%', label: 'ˆEmailˇ', name: 'email_prop' },
            {width: '25%', label: 'ˆEndereçoˇ'},
            {width: '25%', label: 'ˆStatusˇ'},
            {width: '25%', label: 'Ações'}
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            editMode: false,
            arr_prop: [],
            columns: columns,
            sortKey: 'email_prop',
            sortOrders: sortOrders,
            perPage: ['5', '20', '30'],
            tableData: {
                draw: 0,
                length: 5,
                search: '',
                column: 0,
                dir: 'desc',
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },
            form: new Form({
                id: "",
                email_prop: "",
                rua: "",
                numero: "",
                complemento: "",
                bairro: "",
                cidade: "",
                estado: ""
            }),
        }
    },
    methods: {
        getData(url = '/propriedades') {
            this.$Progress.start();
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.arr_prop = data.data.data;
                        this.configPagination(data.data);
                        this.$Progress.finish();
                    }
                })
                .catch(errors => {
                    console.log(errors);
                    this.$Progress.fail();
                });
        },
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getData();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
          update() {
      this.$Progress.start();
      this.form.busy = true;
      this.form
        .put("/propriedades/" + this.form.id)
        .then(response => {
          this.getData();
          $("#propriedadeModalLong").modal("hide");
          if (this.form.successful) {
            this.$Progress.finish();
            this.$snotify.success("Dados Atualizados com Sucesso", "Success");
          } else {
            this.$Progress.fail();
            this.$snotify.error(
              "Algo deu errado, tente mais tarde!",
              "Error"
            );
          }
        })
        .catch(e => {
          this.$Progress.fail();
          console.log(e);
        });
    },
    store() {
      this.$Progress.start();
      this.form.busy = true;
      this.form
        .post("/propriedades")
        .then(response => {
          this.getData();
          $("#propriedadeModalLong").modal("hide");
          if (this.form.successful) {
            this.$Progress.finish();
            this.$snotify.success("Data Successfully Saved", "Success");
          } else {
            this.$Progress.fail();
            this.$snotify.error(
               "Algo deu errado, tente mais tarde!",
              "Error"
            );
          }
        })
        .catch(e => {
          this.$Progress.fail();
          console.log(e);
        });
    },
     destroy(item) {
      this.$snotify.confirm(
        "Voce irá excluir os dados!",
        "tem certeza?",
        {
          showProgressBar: false,
          closeOnClick: false,
          pauseOnHover: true,
          buttons: [
            {
              text: "Yes",
              action: toast => {
                this.$snotify.remove(toast.id);
                this.$Progress.start();
                axios
                  .delete("/propriedades/" + item.id)
                  .then(response => {
                    this.getData();
                    this.$Progress.finish();
                    this.$snotify.success(
                      "Item deletado com sucesso",
                      "Success"
                    );
                  })
                  .catch(e => {
                    this.$Progress.fail();
                    console.log(e);
                  });
              },
              bold: true
            },
            {
              text: "No",
              action: toast => {
                this.$snotify.remove(toast.id);
              },
              bold: true
            }
          ]
        }
      );
    },
       show(item) {
      this.form.reset();
      this.form.fill(item);
      $("#showModal").modal("show");
      console.log(item);
    },
    edit(item) {
        this.editMode = true;
        this.form.reset();
        this.form.clear();
        this.form.fill(item);
        $("#propriedadeModalLong").modal("show");
        },
    create() {
      this.editMode = false;
      this.form.reset();
      this.form.clear();
      $("#propriedadeModalLong").modal("show");
    },
    }
 
};
</script>
