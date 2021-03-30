import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    username: ''
  },
  mutations: {
    getusername (state) {
      axios
      .get('http://service.auto.xsph.ru/init')
      .then(response => {
        console.log(response)
        this.username = response.data.user.name
      })
    }
  }
})