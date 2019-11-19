<template>
  <div>
      <br>
    <div class="text-center">
      <h1>
          RESUMEN NO EJECUTADOS
      </h1>
    </div>
    <ejecutados></ejecutados>
    <br />
    <br />

    <div class="text-center">
      <h1>
          RESUMEN EJECUTADOS
      </h1>
    </div>
    <noejecutados></noejecutados>
  </div>
</template>

<script>
import ejecutados from "./resumen/EjecutadosComponent";
import noejecutados from "./resumen/NoejecutadosComponent";

export default {
  components: {
    ejecutados,
    noejecutados
  }
};
</script>
