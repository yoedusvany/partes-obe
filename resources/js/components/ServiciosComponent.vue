<template>
  <div>
    <b-table striped hover :items="items" :fields="fields" :busy="isBusy">
      <template v-slot:table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>
    </b-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isBusy: true,
      // Note `isActive` is left out and will not appear in the rendered table
      fields: ["id", "name"],
      items: []
    };
  },

  mounted() {
    axios
      .get(API_URL + "/api/services")
      //.then(response => (this.info = response.data));
      .then(({ data }) => {
        this.items = data;
        this.isBusy = !this.isBusy;
      });
  }
};
</script>
