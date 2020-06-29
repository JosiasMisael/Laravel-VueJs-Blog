<template>
    <paginator :url= "`/api/tags/${ this.tag }`" component-names="post-list" ></paginator>

</template>
<script>
    export default {
        props: ['tag'],
    }

</script>

