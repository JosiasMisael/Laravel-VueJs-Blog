<template>
        <paginator :url="`/api/categorias/${this.category}`" component-names="post-list" ></paginator>
</template>
<script>
    export default {
        props : ['category'],
    }

</script>

