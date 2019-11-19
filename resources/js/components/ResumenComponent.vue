<template>
  <div>
    <ejecutados></ejecutados>
    <br>
    <br>
    <noejecutados></noejecutados>
  </div>
</template>

<script>
import ejecutados from "./resumen/EjecutadosComponent";
import noejecutados from "./resumen/NoejecutadosComponent";

export default {
  components:{
    ejecutados,
    noejecutados
  }
};
</script>
