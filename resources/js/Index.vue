<template>

  <v-app id="inspire" >

    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
      dark
      
    >
      <v-list dense>
        <v-list-item link>
          <v-list-item-action>
           <i class="far fa-file-alt"></i>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title><router-link :to="{name: 'propriedade'}">PROPRIEDADE</router-link></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link>
          <v-list-item-action>
           <i class="fas fa-exclamation-circle"></i>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title><router-link :to="{name: 'contrato'}">CONTRATO</router-link></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      clipped-left
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title>Sistema</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <v-container
        class=""
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >

          <v-col class="">

                <!-- CONTEUDO CENTRAL -->
              <router-view></router-view>
          </v-col>

        </v-row>
      </v-container>
    </v-main>

    <v-footer app><br/>
      <span>&copy; 2020</span>
    </v-footer>
  </v-app>
</template>

<script>
 
  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
    }),
    created () {
      this.$vuetify.theme.root = false
    },
    methods:{
        navigateTo(where){
            this.$router.push({name: where})
        }
    },
    components: {
  
    }
  }
</script>
