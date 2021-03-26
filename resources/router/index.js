import Vue from 'vue'
import Router from 'vue-router'
import MapPage from '../components/MapPage'
import AuthPage from '../components/AuthPage'
import CalculatorPage from '../components/CalculatorPage'
import Footer from '../components/Footer'

Vue.use(Router)

export default new Router({
  routes: [
  	{
      path: '/',
      name: 'AuthPage',
      component: AuthPage
    },
    {
      path: '/MapPage',
      name: 'MapPage',
      component: MapPage
    },
    {
      path: '/CalculatorPage',
      name: 'CalculatorPage',
      component: CalculatorPage
    },
    {
      path: '/Footer',
      name: 'Footer',
      component: Footer
    }
  ]
})
