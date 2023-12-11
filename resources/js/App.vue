<script>
import Header from "@/Components/Header.vue";
    export default {
        components: {Header},
    }
</script>

<template>

    <Header/>

    <main class="main">
        <router-view/>
    </main>

</template>

<style scoped>

</style>
