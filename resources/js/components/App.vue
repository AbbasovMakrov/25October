<template>
    <div id="app">
        <Navbar/>
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Navbar from "./Navbar";

    export default {
        name: "App",
        components:{
            Navbar
        }
    }
</script>

<style scoped>

</style>
