<template>
  <div>
    <br />
    <b-row>
      <b-button variant="success" v-on:click="Adicionar">Adicionar</b-button>
    </b-row>
    <br />
    <b-table
      hover
      primary-key="id"
      :items="items"
      :fields="fields"
      :busy="isBusy"
      :sort-by.sync="sortBy"
    >
      <template v-slot:table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>

      <template v-slot:cell(actions)="row">
        <b-button
          size="sm"
          @click="update(row.item, row.index, $event.target)"
          class="mr-1"
        >Actualizar</b-button>
        <b-button size="sm" @click="remove(row.item, row.index, $event.target)" class="mr-1">Borrar</b-button>
      </template>
    </b-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sortBy: "name",
      isBusy: true,
      fields: [
        {
          key: "id",
          sortable: true
        },
        {
          key: "name",
          sortable: true
        },
        { key: "actions", label: "Actions" }
      ],

      items: []
    };
  },

  methods: {
    Adicionar: function(event) {
      this.$router.push("/sucursales-add/false");
    },

    update(item, index, button) {
      this.$router.push("/sucursales-add/true/" + item.id);
    },
    remove(item, index, button) {
      axios
        .delete(API_URL + `/api/sucursales/${item.id}`)
        .then(res => {
          if (res) {
            this.makeToast(
              "success",
              "Resultado de la operación",
              "Sucursal eliminado correctamente"
            );
            this.isBusy = !this.isBusy;
            this.getSucursales();
          }
        })
        .catch(err => {
          console.log(err);
        });
    },

    getSucursales() {
      axios
        .get(API_URL + "/api/sucursales")
        .then(({ data }) => {
          this.items = data;
          this.isBusy = !this.isBusy;
        });
    },

    makeToast(variant = null, title, body) {
      this.$bvToast.toast(body, {
        title: `${title || "default"}`,
        variant: variant,
        solid: true
      });
    }
  },

  mounted() {
    this.getSucursales();
  }
};
</script>
