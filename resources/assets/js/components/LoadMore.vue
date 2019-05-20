<template>
    <div class="lazy-load">
        <img class="loading-image" src="/images/loading.gif" alt="" >
        <span id="page">2</span><span id="load_status">0</span>
    </div>
</template>

<script>
    export default {
        name: "load-more",
    }
</script>

<style lang="css">
    .lazy-load{
        text-align: center;
    }
    #page{
        display: none;
    }
    .loading-image{
        max-width: 20px;
    }
    #load_status{
        display: none;
    }
</style>