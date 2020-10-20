<template>
    <div class="projects">
        <div class="tableFilters">
          <h3>Contratos</h3> 
            <div class="control">
                   <button type="button"  class="btn btn-info" @click="create">
                Add Contrato
                <i class="fas fa-plus"></i>
              </button>
            </div>
        </div>
        <div>
            <table  class="table table-hover table-bordered table-striped ">
                <thead>
                  <tr>
                    <th scope="col">Propriedade</th>
                    <th scope="col">Tipo Pessoa</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nome</th>
                  </tr>
                </thead>
            <tbody>
                <tr v-for="item in arr_contrato" :key="item.id">
                    <td>{{item.email_contrat}}</td><!-- rel -->
                    <td>{{item.tp_pessoa }}</td>
                    <td>{{ item.documento }}</td>
                    <td>{{ item.email_contrat }}</td>
                    <td>{{ item.nome_contrat }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        <pagination :pagination="pagination"
                    @prev="getData(pagination.prevPageUrl)"
                    @next="getData(pagination.nextPageUrl)">
        </pagination>



<!-- Modal Add -->
    <div
      class="modal fade"
      id="contratoModalLong"
      tabindex="-1"
      role="dialog"
      aria-labelledby="contratoModalLongTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="contratoModalLongTitle">{{ editMode = "Add New" }} Contratos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editMode = store()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <alert-error :form="form"></alert-error>
               <div class="form-group">
                <label><b>Propriedade</b> </label>
                       <select name="propriedade_id" v-model="form.propriedade_id" class="form-control" :required="true">
                            <option :selected="true">Selecione</option>
                        <option v-for="(p,index) in arr_prop" :key="index" :value="p.id" >{{ p.rua+','+p.numero+','+p.complemento+','+p.bairro }}</option>
                </select>
                <has-error :form="form" field="propriedade_id"></has-error>
              </div>
             <div class="form-group">
                <label><b>Tipo Pessoa</b> </label>
                        <select name="tp_pessoa"  v-model="form.tp_pessoa"  class="form-control" :required="true" >
                                <option :selected="true">Selecione</option>
                                <option value="f" >P.Física</option>
                                <option value="j" >P.Jurídica</option>
                        </select>
                <has-error :form="form" field="tp_pessoa"></has-error>
              </div>
               <div class="form-group">
                <label><b>Documento</b> </label>
                <input
                  v-model="form.documento"
                  type="text"
                  name="documento"
                  class="form-control"
                  v-mask="maskf"
                  :required="true"
                  v-if="form.tp_pessoa == 'f'"
                >
                   <input
                  v-model="form.documento"
                  type="text"
                  name="documento"
                  class="form-control"
                  v-mask="maskj"
                  :required="true"
                  v-if="form.tp_pessoa == 'j'"
                >
                <has-error :form="form" field="documento"></has-error>
              </div>
                <div class="form-group">
                <label><b>Email</b><i style="font-size:11px">Apos efetuar cadastro utilize o comando: "docker-compose exec app php artisan queue:work",para enviar msg para esse email</i> </label>
                <input
                  v-model="form.email_contrat"
                  type="email"
                  name="email_contrat"
                  class="form-control"
                  :required="true"
                  :class="{ 'is-invalid': form.errors.has('email_contrat') }"
                >
                <has-error :form="form" field="email_contrat"></has-error>
              </div>
                <div class="form-group">
                <label><b>Nome</b> </label>
                <input
                  v-model="form.nome_contrat"
                  type="text"
                  name="nome_contrat"
                  class="form-control"
                  :required="true"
                  :class="{ 'is-invalid': form.errors.has('nome_contrat') }"
                >
                <has-error :form="form" field="nome_contrat"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button :disabled="form.busy" type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>

        </div>
      </div>
    </div>
    <!-- Modal add-->

    <vue-progress-bar></vue-progress-bar>
    <vue-snotify></vue-snotify>


    </div>
</template>

<script>

import Pagination from './Pagination.vue';
export default {
    components: { pagination: Pagination },
    created() {
        this.editMode = false;
        this.getData();
        this.getDataProp();
        this.form.reset();
        this.form.clear();
      $("#contratoModalLong").modal("show");
    },
    data() {
        let sortOrders = {};
/*
        let columns = [
            {width: '33%', label: 'ˆEmailˇ', name: 'email_prop' },
            {width: '33%', label: 'ˆEndereçoˇ'},
            {width: '33%', label: 'ˆStatusˇ'},
            {width: '33%', label: 'Ações'}
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        */
        return {
            val_unico:"",
            maskf: "###.###.###-##",
            maskj: "##.###.###/####-##",
            editMode: false,
            arr_contrato: [],
            arr_prop:[],
          //  columns: columns,
            sortKey: 'email_contrat',
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
                propriedade_id: "",
                tp_pessoa: "",
                documento: "",
                email_contrat: "",
                nome_contrat: ""
            }),
        }
    },
    methods: {
        getData(url = '/contratos') {
            this.$Progress.start();
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                      //  console.log(data);
                    if (this.tableData.draw == data.draw) {
                        this.arr_contrato = data.data.data;
                        this.configPagination(data.data);
                        this.$Progress.finish();
                    }
                })
                .catch(errors => {
                    console.log(errors);
                    this.$Progress.fail();
                });
        },
            getDataProp(url = '/propriedades') {
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
        /*
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getData();
        },
        */
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    store() {
      this.$Progress.start();
      this.form.busy = true;
      this.form
        .post("/contratos")
        .then(response => {
          this.getData();
         // console.log(response.data);
          $("#contratoModalLong").modal("hide");
          if (this.form.successful) {
              
              if(response.data == "invalido"){
            this.$Progress.finish();
            this.$snotify.error(
               "Esta Propriedade ja esta associada a um contrato, escolha outra opcao!"
            );
              }else{
            this.$Progress.finish();
            this.$snotify.success("Data Successfully Saved", "Success");
              }
            
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
        $("#contratoModalLong").modal("show");
        },
    create() {
      this.editMode = false;
      this.form.reset();
      this.form.clear();
      $("#contratoModalLong").modal("show");
    },
    }
 
};
</script>
