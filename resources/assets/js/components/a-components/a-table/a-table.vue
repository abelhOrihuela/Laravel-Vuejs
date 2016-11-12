    <script>
      export default{

          template: require('./a-table.html'),

        /*PROPS*/

        props: {
          items: Array,
          columns: Array,
          total: Number
        },

      /**
      * function data
      * @return {object}
      */
      data: function () {

        console.log("init");
        console.log(this.items.length);

        searchQuery: ''
        
        
        var sortOrders = {}
        this.columns.forEach(function (key) {
          sortOrders[key] = 1
        })
        return {
          sortKey: '',
          sortOrders: sortOrders,
          start: 0,
          limit: 0,
          pagination: 0,
          filterKey:''
        }
      },

      ready: function(){
        console.log("init2");
        console.log(this.items.length);
      },
      created: function() {
        console.log("init3");
        console.log(this.items.length);

        this.limit = parseInt(5);
        this.start=0;

      },
      watch: {
        pagination: function() {

          console.log("init3");
          console.log(this.items.length);

          this.limit = parseInt(this.pagination);

          if(this.limit != this.start && this.start > 0)
            this.start = parseInt(this.pagination);
          this.limit = this.start + parseInt(this.pagination);
         
        }
      },

      methods: {
      
        paginate: function(direction) {
          console.log("init");
          console.log(this.items);


          if(direction === 'next') {
            this.start += parseInt(this.pagination);
            this.limit += parseInt(this.pagination);
          }
          else if(direction === 'previous') {
            this.limit -= parseInt(this.pagination);
            this.start -= parseInt(this.pagination);
          }
        },
        sortBy: function (key) {
          this.sortKey = key
          this.sortOrders[key] = this.sortOrders[key] * -1
        },
      },

      filters: {
        paginate: function( start, limit) {
      
    },

        reverse: function(value){
       
         return value.split('').reverse().join('');
        },
        capitalize: function (value){
          return value.toUpperCase();
        }
      }
    }

  </script>


