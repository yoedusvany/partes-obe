<template>
  <div>
    <br />
    <b-button variant="success" v-on:click="Regresar">Regresar</b-button>

    <b-card class="mt-3" header="Gestionar sucursal">
      <b-form @submit="onSubmit" @reset="onReset" v-if="show">
        <!--NAME-->
        <b-form-group id="input-group-2" label="Nombre de la sucursal" label-for="input-2">
          <b-form-input id="input-2" v-model="form.name" type="text" required placeholder="Nombre."></b-form-input>
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
      actualizar: false,
      sucursalId: null,
      form: {
        name: ""
      },

      show: true
    };
  },
  methods: {
    Regresar: function(event) {
      this.$router.push("/sucursales");
    },
    onSubmit(evt) {
      evt.preventDefault();

      if (this.actualizar === "false") {
        axios.post(API_URL + "/api/sucursales", this.form).then(response => {
          if (response) {
            this.makeToast(
              "success",
              "Resultado de la operacion",
              "Sucursal registrado"
            );
            this.$router.push("/sucursales");
          } else {
            this.makeToast(
              "danger",
              "Resultado de la operacion",
              "Ocurrio un error"
            );
          }
        });
      } else {
        axios
          .put(API_URL + "/api/sucursales/" + this.sucursalId, this.form)
          .then(response => {
            if (response) {
              this.makeToast(
                "success",
                "Resultado de la operacion",
                "Sucursal actualizada correctamente"
              );
              this.$router.push("/sucursales");
            } else {
              this.makeToast(
                "danger",
                "Resultado de la operacion",
                "Ocurrio un error"
              );
            }
          });
      }
    },

    getItem(ordenId) {
      axios.get(API_URL + "/api/sucursales/" + this.sucursalId).then(response => {
        this.form.name = response.data.name;
      });
    },

    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.name = "";
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
    this.actualizar = this.$route.params.actualizar;
    this.sucursalId = this.$route.params.sucursal;

    if (this.actualizar === "true") {
      this.getItem(this.sucursalId);
    }
  }
};
</script>
