<script>
  export default{

   props: {
      items: Array,
      start: 5,
      limit: 0,
      pagination: null,
      total: 6,
      columns: Array
    },
    data: function () {

      searchQuery: ''
      var sortOrders = {}
      this.columns.forEach(function (key) {
        sortOrders[key] = 1
      })
      return {
        sortKey: '',
        sortOrders: sortOrders
      }
    },
    created: function() {
      
      this.limit = parseInt(this.pagination);
      this.start=0;

    },
    watch: {
      pagination: function() {
        this.limit = parseInt(this.pagination);

        if(this.limit != this.start && this.start > 0)
          this.start = parseInt(this.pagination);
        this.limit = this.start + parseInt(this.pagination);
      }
    },

    methods: {
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
      sortBy: function (key) {
        this.sortKey = key
        this.sortOrders[key] = this.sortOrders[key] * -1
      },
    },

    filters: {
      paginate: function() {
        return this.items.slice(this.start,this.limit);
      }
    }
    

  }

</script>

<template >

<div>
<div>
<table class="table table-striped">
    <thead class="bg-primary">

      <tr>
        <th v-for="key in columns" @click="sortBy(key)" >
          {{key | capitalize}}
          <span class="arrow"
          :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
        </span>
      </th>
    </tr>
  </thead>
  <tbody>

    <tr v-for=" item in items">
      <td v-for="key in columns">
        {{ item[key] }}
      </td>
    </tr>
  </tbody>

</table>


  {{ columns }}
     <li v-for="key in columns">{{ key }}</li>
</div>
</div>



      



</template>
