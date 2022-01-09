<template>
  <div>
    <Header />
    <nuxt />
    <Footer />
  </div>
</template>

<script>
import Header from "@/components/front/layout/Header";
import Footer from "@/components/front/layout/Footer";
export default {
  components: {
    Header,
    Footer
  }
};
</script>
