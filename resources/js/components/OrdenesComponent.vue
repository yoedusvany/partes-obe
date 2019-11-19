<template>
  <div>
    <br />

    <b-container class="bv-example-row">
      <b-row>
        <b-col cols="5">
          <b-button variant="success" v-on:click="Adicionar">Adicionar</b-button>
        </b-col>
        <b-col>
          <b-button variant="light">0-10</b-button>
          <b-button variant="success">11-30</b-button>
          <b-button variant="info">31-90</b-button>
          <b-button variant="warning">91-180</b-button>
          <b-button variant="danger">>181</b-button>
        </b-col>
      </b-row>
    </b-container>

    <b-table
      hover
      primary-key="id"
      :items="items"
      :fields="fields"
      :busy="isBusy"
      :tbody-tr-class="rowClass"
      :sort-by.sync="sortBy"
    >
      <template v-slot:table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>

      <template v-slot:cell(actions)="row">
        <b-button size="sm" @click="ejecutar(row.item, row.index, $event.target)" class="mr-1">Ejecutar</b-button>
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
      sortBy: "dias",
      isBusy: true,
      fields: [
        {
          key: "sucursal",
          sortable: true
        },
        {
          key: "servicio",
          sortable: true
        },
        {
          key: "dias",
          sortable: true
        },
        {
          key: "fecha",
          sortable: true
        },
        {
          key: "cliente",
          sortable: true
        },
        {
          key: "dir",
          sortable: false
        },
        { key: "actions", label: "Actions" }
      ],

      items: []
    };
  },

  methods: {
    Adicionar: function(event) {
      this.$router.push("/orden-add/false");
    },
    rowClass(item, type) {
      if (!item) return;
      if (item.dias >= 11 && item.dias <= 30) return "table-success";
      if (item.dias >= 31 && item.dias < 90) return "table-info";
      if (item.dias >= 91 && item.dias < 180) return "table-warning";
      if (item.dias >= 181) return "table-danger";
    },

    update(item, index, button) {
      this.$router.push("/orden-add/true/"+item.id);

    },
    remove(item, index, button) {
      axios
        .delete(API_URL + `/api/ordenes/${item.id}`)
        .then(res => {
          if (res) {
            this.makeToast(
              "success",
              "Resultado de la operación",
              "Orden eliminada correctamente"
            );
            this.isBusy = !this.isBusy;
            this.getOrdenes();
          }
        })
        .catch(err => {
          console.log(err);
        });
    },

    ejecutar(item, index, button) {
      axios
        .get(API_URL + `/api/ejecutarOrden/${item.id}`)
        .then(res => {
          if (res) {
            this.makeToast(
              "success",
              "Resultado de la operación",
              "Orden ejecutada correctamente"
            );
            this.isBusy = !this.isBusy;
            this.getOrdenes();
          }
        })
        .catch(err => {
          console.log(err);
        });
    },

    makeToast(variant = null, title, body) {
      this.$bvToast.toast(body, {
        title: `${title || "default"}`,
        variant: variant,
        solid: true
      });
    },

    getOrdenes() {
      axios.get(API_URL + "/api/ordenes").then(({ data }) => {
        this.items = data;
        this.isBusy = !this.isBusy;
      });
    }
  },

  mounted() {
      this.getOrdenes();
  }
};
</script>
