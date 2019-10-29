<template>
  <div>
    <div>
      <b-navbar type="dark" variant="dark">
        <b-navbar-toggle target="nav-text-collapse"></b-navbar-toggle>

        <b-navbar-brand href="#">
          <img src="images/index.jpeg" height="100px" width="100px" alt="Kitten" />
        </b-navbar-brand>

        <b-collapse id="nav-text-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-text>
              <router-link :to="{ name: 'obe' }">OBE MORON</router-link>|
            </b-nav-text>
          </b-navbar-nav>
        </b-collapse>

        <b-collapse id="nav-text-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-text>
              <router-link :to="{ name: 'servicios' }">SERVICIOS</router-link>
            </b-nav-text>
          </b-navbar-nav>
        </b-collapse>

        <b-collapse id="nav-text-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-text>
              <router-link :to="{ name: 'sucursales' }">SUCURSALES</router-link>
            </b-nav-text>
          </b-navbar-nav>
        </b-collapse>

        <b-collapse id="nav-text-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-text>
              <router-link :to="{ name: 'ordenes' }">ORDENES</router-link>
            </b-nav-text>
          </b-navbar-nav>
        </b-collapse>


        <b-collapse id="nav-text-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-text>
              <router-link :to="{ name: 'resumen' }">RESUMEN</router-link>
            </b-nav-text>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>
    </div>

    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
export default {};
</script>
