<template>
  <div>
      <br>
    <table class="table table-striped table-bordered" style="width:100%">
      <thead  class="thead-dark">
        <th scope="col" colspan="2" rowspan="2">SUCURSALES</th>
        <th scope="col" colspan="3" style="text-align:center">SERVICIOS</th>
      </thead>
      <tbody>
        <tr>
          <td colspan="2"></td>
          <td v-bind:key="index" v-for="(value, index) in servicios">{{value.name}}</td>
        </tr>

        <tr v-for="(value, index) in sucursales" :key="index" rowspan=5>
          <td>{{value.name}}</td>
          <td>
            <tr>0-10</tr>
            <tr>11-30</tr>
            <tr>31-90</tr>
            <tr>91-180</tr>
            <tr>>180</tr>
          </td>

          <td v-bind:key="index1" v-for="(value1, index1) in servicios">
            <tr>{{ rangos[addIndex(index)+'-'+addIndex(index1)]['0-10']}}</tr>
            <tr>{{ rangos[addIndex(index)+'-'+addIndex(index1)]['11-30']}}</tr>
            <tr>{{ rangos[addIndex(index)+'-'+addIndex(index1)]['31-90']}}</tr>
            <tr>{{ rangos[addIndex(index)+'-'+addIndex(index1)]['91-180']}}</tr>
            <tr>{{ rangos[addIndex(index)+'-'+addIndex(index1)]['>180']}}</tr>
          </td>
        </tr>


        <tr class="table-success">
          <td>TOTALES</td>
          <td>
            <tr>0-10</tr>
            <tr>11-30</tr>
            <tr>31-90</tr>
            <tr>91-180</tr>
            <tr>>180</tr>
          </td>

          <td v-bind:key="index1" v-for="(value1, index1) in servicios">
            <tr>{{ totales[index1+1]['0-10'] }}</tr>
            <tr>{{ totales[index1+1]['11-30'] }}</tr>
            <tr>{{ totales[index1+1]['31-90'] }}</tr>
            <tr>{{ totales[index1+1]['91-180'] }}</tr>
            <tr>{{ totales[index1+1]['>180'] }}</tr>
          </td>

        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sucursales: [],
      servicios: [],
      rangos: [],
      totales: []
    };
  },

  methods: {
    addIndex: function(index) {
      return ++index;
    },
    getData: async function() {
      await this.getServicios();
      await this.getSucursales();
      await this.getRangos();
      await this.getTotales();
    },

    getSucursales: async function() {
      await axios.get(API_URL + "/api/sucursales").then(({ data }) => {
        data.forEach(element => {
          this.sucursales.push(element);
        });
      });
    },

    getServicios: async function() {
      await axios.get(API_URL + "/api/services").then(({ data }) => {
        data.forEach(element => {
          this.servicios.push(element);
        });
      });
    },

    getRangos: async function() {
      axios.get(API_URL + "/api/getAllRangosEjecutados").then(({ data }) => {
        this.rangos = data;
      });
    },

    getTotales: async function() {
      await axios.get(API_URL + "/api/totalesServicio/"+1).then(({ data }) => {
        this.totales = data;
      });

      console.log(this.totales);

    }
  },

  created() {
    this.getData();
  }
};
</script>
