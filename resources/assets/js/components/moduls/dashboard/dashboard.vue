<script>
import { translations } from '../../js/translations.js';

  export default {
    template: require('./dashboard.html'),
    mixins: [
      require('vue-i18n-mixin')
    ],
    translations: translations,
    data: function(){
      return {
        menu: []
      }
    },
    created: function(){
      this.menu=JSON.parse(sessionStorage.getItem('menu'));

    }
  }
</script>
