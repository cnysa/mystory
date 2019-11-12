<template>
    <div class="container-fluid">
        <navbar></navbar>
        <div class="row justify-content-center mt-5">
            <router-view :backend="backend"></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['backend']
    }
</script>
