<template>
  <div>
    <br />
    <b-button variant="success" v-on:click="Regresar">Regresar</b-button>

    <b-card class="mt-3" header="Form Data Result">
      <b-form @submit="onSubmit" @reset="onReset" v-if="show">
        <!--SUCURSALES-->
        <b-form-group id="input-group-s1" label="Sucursales" label-for="input-s1">
          <b-form-select id="input-s1" v-model="form.sucursal" :options="optionsSucursal"></b-form-select>
        </b-form-group>

        <!--SERVICIOS-->
        <b-form-group id="input-group-s2" label="Servicios" label-for="input-s2">
          <b-form-select id="input-s2" v-model="form.servicio" :options="optionsServicios"></b-form-select>
        </b-form-group>

        <!--NO DE SERIE-->
        <b-form-group id="input-group-1" label="No Serie" label-for="input-1">
          <b-form-input
            id="input-1"
            v-model="form.noSerie"
            type="number"
            required
            placeholder="No de serie de la orden"
          ></b-form-input>
        </b-form-group>

        <!--CLIENTE-->
        <b-form-group id="input-group-2" label="Cliente" label-for="input-2">
          <b-form-input
            id="input-2"
            v-model="form.cliente"
            type="text"
            required
            placeholder="Nombre y apellidos del cliente."
          ></b-form-input>
        </b-form-group>

        <!--DIR-->
        <b-form-group id="input-group-3" label="Dirección" label-for="input-3">
          <b-form-input
            id="input-3"
            v-model="form.dir"
            type="text"
            required
            placeholder="Dirección del cliente."
          ></b-form-input>
        </b-form-group>

        <b-button type="submit" variant="primary">Submit</b-button>
        <b-button type="reset" variant="danger">Reset</b-button>
      </b-form>
    </b-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      optionsSucursal: [],
      optionsServicios: [],
      form: {
        sucursal: null,
        servicio: null,
        noSerie: "",
        cliente: "",
        dir: ""
      },

      show: true
    };
  },
  methods: {
    Regresar: function(event) {
      this.$router.push({ path: "ordenes" });
    },
    onSubmit(evt) {
      evt.preventDefault();

      axios.post(API_URL + "/api/ordenes", this.form).then(response => {
        if (response) {
          this.makeToast(
            "success",
            "Resultado de la operacion",
            "Orden registrada"
          );
          this.$router.push("ordenes");
        } else {
          this.makeToast(
            "danger",
            "Resultado de la operacion",
            "Ocurrio un error"
          );
        }
      });
    },

    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.noSerie = "";
      this.form.cliente = "";
      this.form.dir = "";
      this.show = false;
      (this.form.sucursal = null),
        (this.form.servicio = null),
        this.$nextTick(() => {
          this.show = true;
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
    axios.get(API_URL + "/api/services").then(({ data }) => {
      data.forEach(element => {
        this.optionsServicios.push({
          value: element.id,
          text: element.name,
          id: element.id
        });
      });
    });

    axios.get(API_URL + "/api/sucursales").then(({ data }) => {
      data.forEach(element => {
        this.optionsSucursal.push({
          value: element.id,
          text: element.name,
          id: element.id
        });
      });
    });
  }
};
</script>
