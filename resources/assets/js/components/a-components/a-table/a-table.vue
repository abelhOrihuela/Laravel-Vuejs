<script>
import { translations } from '../../js/translations.js';
import  filter  from '../../js/utilities/filters.js';


export default{
  template: require('./a-table.html'),
  mixins: [
    require('vue-i18n-mixin')
  ],
  props: {
    data: Array,
    columns: Array,
    total: Number,
    select: Function,
    showSearch:{
      type: Boolean,
      default: true
    }

  },
  translations: translations,

  data: function () {
    var sortOrders = {}
    this.columns.forEach(function (key) {
      sortOrders[key] = 1
    })
    return {
      sortKey: '',
      sortOrders: sortOrders,
      pagination: 5,
      page: 1,
      totalPages: 0,
      init: 0,
      end: 5,
      filterKey: '',
      start: 0,
      limit: 5,
      locale: 'es'
    }
  },
  computed: {
    filteredData: function () {
      var sortKey = this.sortKey
      var filterKey = this.filterKey && this.filterKey.toLowerCase()
      var order = this.sortOrders[sortKey] || 1
      var data = this.data
      if (filterKey) {
        data = data.filter(function (row) {
          return Object.keys(row).some(function (key) {
            return String(row[key]).toLowerCase().indexOf(filterKey) > -1
          })
        });
      }
      if (sortKey) {
        data = data.slice().sort(function (a, b) {
          a = a[sortKey]
          b = b[sortKey]
          return (a === b ? 0 : a > b ? 1 : -1) * order
        });
      }
      this.totalPages=parseInt(data.length/this.pagination)+1;

      return data.slice(this.init,this.end);
    }
  },
  filters: {
    capitalize: function (str) {
      return str.charAt(0).toUpperCase() + str.slice(1)
    },
    trueOrFalse: function(value){
      return filter.trueOrFalse(this,value);
    },
    shortDate: function(value){
      return filter.shortDate(this,value);
    },
    customers: function(value){
      return filter.customers(this,value);
    },
    admins: function(value){
      return filter.admins(this,value);

    }

  },
  methods: {
    sortBy: function (key) {
      this.sortKey = key
      this.sortOrders[key] = this.sortOrders[key] * -1
    },
    paginate: function(direction) {

      if(direction === 'next' && this.end<this.data.length) {
        this.init += parseInt(this.pagination);
        this.end += parseInt(this.pagination);
        this.page+=1;
      }
      else if(direction === 'previous' && this.init!=0) {
        this.init -= parseInt(this.pagination);
        this.end -= parseInt(this.pagination);
        this.page-=1;
      }
      else if(direction==='no'){
        this.end=parseInt(this.init+this.pagination);
      }
    },

    selectElement: function(entry){
      this.select(entry);
    }
  }
}
</script>
