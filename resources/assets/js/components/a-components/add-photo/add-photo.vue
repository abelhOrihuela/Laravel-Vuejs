<script>
import { translations } from '../../js/translations.js';
import { HTTP, IMAGE_PROFILE,USER_PERMISSIONS } from '../../js/constants_restful.js';
import  service  from '../../js/utilities/service.js';

export default{
  template: require('./add-photo.html'),
  props:{
    getphoto: Function,
    candidate: Object
  },

    translations: translations,
    mixins: [require('vue-i18n-mixin')],
  data: function(){
    return {
      image: '',
      locale: 'es'
    }
  },
  http: HTTP,
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

      this.$http.post(IMAGE_PROFILE, {'profile': vm.image , 'candidate': this.candidate.id })
      .then(function(response){
        this.getphoto();

        this.candidate.name_photo=response.body.name_photo;

        service.showSuccess(this, 'Operacion Exitosa');


      }, function (error){


      });
    }
  }
}
</script>
