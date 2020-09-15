

import Vue from 'vue'
import App from './App.vue'
window.Vue = require('vue')
import VueUploadMultipleImage from './components/VueUploadMultipleImage.vue'



  Vue.component('VueUploadMultipleImage', require('./components/VueUploadMultipleImage.vue').default)

  Vue.use(VueUploadMultipleImage);
  import VueUploadMultipleImage from 'vue-upload-multiple-image'

export default {
  components: {
    VueUploadMultipleImage,
  },
}


  new Vue({
    el: '#my-strictly-unique-vue-upload-multiple-image',
    render: h => h(App)
  })


export default VueUploadMultipleImage
