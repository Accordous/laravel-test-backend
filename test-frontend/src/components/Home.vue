<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <b-tabs content-class="mt-3">
          <b-tab title="Propriedades" active>
            <button class="spacing btn btn-success">
              Adicionar Nova Propriedade
            </button>
            <table
              id="dtOrderExample"
              class="table table-striped table-bordered table-sm"
              cellspacing="0"
              width="100%"
            >
              <thead>
                <tr>
                  <th class="th-sm">E-mail do Proprietário</th>
                  <th class="th-sm">Rua</th>
                  <th class="th-sm">Número</th>
                  <th class="th-sm">Bairro</th>
                  <th class="th-sm">Cidade</th>
                  <th class="th-sm">UF</th>
                  <th class="th-sm">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="property in properties" :key="property.id">
                  <td>{{ property.email_owner }}</td>
                  <td>{{ property.street }}</td>
                  <td>{{ property.number }}</td>
                  <td>{{ property.neighborhood }}</td>
                  <td>{{ property.city }}</td>
                  <td>{{ property.state }}</td>
                  <td class="statusC" v-if="property.status === 'C'">Contrato Gerado</td>
                  <td class="statusSC" v-else>Sem contrato</td>
                </tr>
              </tbody>
            </table>
          </b-tab>
          <b-tab title="Contratos">
            <button class="spacing btn btn-success">Gerar novo Contrato</button>
            <table
              id="dtOrderExample"
              class="table table-striped table-bordered table-sm"
              cellspacing="0"
              width="100%"
            >
              <thead>
                <tr>
                  <th class="th-sm">Nome</th>
                  <th class="th-sm">E-mail do Contratante</th>
                  <th class="th-sm">Tipo de pessoa</th>
                  <th class="th-sm">Documento</th>
                  <th class="th-sm">Propriedade</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="contract in contracts" :key="contract.id">
                  <td>{{ contract.name }}</td>
                  <td>{{ contract.contractor_email }}</td>
                  <td v-if="contract.person === 'PF'">Pessoa Fisíca</td>
                  <td v-else>Pessoa Jurídica</td>
                  <td>{{ contract.document }}</td>
                  <td>
                    {{
                      contract.property.street +
                      ", " +
                      contract.property.number +
                      ", " +
                      contract.property.neighborhood +
                      ", " +
                      contract.property.city +
                      "-" +
                      contract.property.state
                    }}
                  </td>
                </tr>
              </tbody>
            </table>
          </b-tab>
        </b-tabs>
      </div>
    </div>
  </div>
</template>
<script>
const baseURI = "http://127.0.0.1:8000/api/";
export default {
  name: "Home",
  data() {
    return {
      properties: [],
      contracts: [],
    };
  },
  mounted() {
    this.$http.get(baseURI + "propriedades").then((result) => {
      this.properties = result.data;
    });
    this.$http.get(baseURI + "contratos").then((result) => {
      this.contracts = result.data;
    });
  },
};
</script>
<style lang="css">
.spacing {
  margin-bottom: 10px;
}
.statusC {
    color: blue;
}
.statusSC {
    color: red;
}
</style>