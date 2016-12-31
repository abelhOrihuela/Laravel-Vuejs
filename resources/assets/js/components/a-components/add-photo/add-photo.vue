<script>
import { translations } from '../../js/translations.js';


export default{
  template: require('./add-photo.html'),
  props:{
    getphoto: Function,
    candidate: Number
  },

    translations: translations,
    mixins: [require('vue-i18n-mixin')],
  data: function(){
    return {
      image: '',
      locale: 'es'
    }
  },
  http: {
    root: '/api',
    headers: {
      'X-CSRF-TOKEN' : document.querySelector('#token').getAttribute('value')
    }
  },
  methods: {
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length)
      return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage: function (e) {
      this.image = '';
    },
    newPhoto: function(){
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.image = e.target.result;
      };

      this.$http.post('image/profile', {'profile': vm.image , 'candidate': this.candidate })
      .then(function(response){
        this.getphoto(response.body, true);
      }, function (error){


      });
    }
  }
}
</script>
