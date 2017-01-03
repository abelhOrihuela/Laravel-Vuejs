<script>
import { translations } from '../../js/translate/table.js';
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
      pagination: 10,
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
        })
      }
      if (sortKey) {
        data = data.slice().sort(function (a, b) {
          a = a[sortKey]
          b = b[sortKey]
          return (a === b ? 0 : a > b ? 1 : -1) * order
        })
      }
      return data.slice(0,this.pagination);
      //return data;
    }
  },
  filters: {
    capitalize: function (str) {
      return str.charAt(0).toUpperCase() + str.slice(1)
    },
    translateTable: function(column){
      var text='';
      return text;
    },
    trueOrFalse: function(value){
      return filter.trueOrFalse(this,value);
    }

  },
  methods: {
    sortBy: function (key) {
      this.sortKey = key
      this.sortOrders[key] = this.sortOrders[key] * -1
    },
    paginate: function(direction) {

      if(direction === 'next') {
        this.start += parseInt(this.pagination);
        this.limit += parseInt(this.pagination);
      }
      else if(direction === 'previous') {
        this.limit -= parseInt(this.pagination);
        this.start -= parseInt(this.pagination);
      }
    },

    selectElement: function(entry){
      this.select(entry);
    }
  }
}
</script>
