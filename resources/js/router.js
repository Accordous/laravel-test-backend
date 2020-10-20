import VueRouter from 'vue-router'
// Pages
import Propriedade from './pages/Propriedade'
import Contrato from './pages/Contrato'


// Routes
const routes = [
/*
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  */


  {
    path: '/',
    name: 'propriedade',
    component: Propriedade,
    meta: {
      auth: true
    }
  },


  {
    path: '/contrato',
    name: 'contrato',
    component: Contrato,
    meta: {
      auth: true
    }
  },
 


]
const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})
export default router