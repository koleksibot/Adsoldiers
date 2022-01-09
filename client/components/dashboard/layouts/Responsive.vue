<template>
    <div class="logo-admin">
        <nuxt-link :to="{ name: 'index' }">
          <img src="@/assets/img/logo.png">
        </nuxt-link>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
        </button>
    </div>
</template>

<script>
    export default {
        
    }
</script>