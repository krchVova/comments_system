<style>
    .app {
        margin: 0 auto;
        width: 1000px;
    }
    .app h1 {
        text-align: center;
    }
</style>
<template>
    <div class="app">
        <h1>Tree comments</h1>
        <p>
            <router-link :to="{ name: 'comments' }">All comments</router-link>
        </p>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {}
</script>
