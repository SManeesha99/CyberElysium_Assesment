<template>

      <div>
            <Navbar />
            <slot name="content"></slot>
            <Footer />
      </div>

</template>

<script>

import Navbar from '@/Components/Main/Navbar.vue'
import Footer from '@/Components/Main/Footer.vue'

export default {

    components: {

        Navbar,
        Footer

    }

}

</script>

<style lang="scss" scoped>

</style>
