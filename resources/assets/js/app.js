var Vue = require('vue/dist/vue.js')


new Vue({
  el: '#app',
  data: {
    input: '# hello'
  },
  computed: {
    compiledMarkdown: function () {
      return marked(this.input, { sanitize: true })
    }
  },
  methods: {
    
  }
})
