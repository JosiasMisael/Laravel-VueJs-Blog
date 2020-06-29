<template>
<dir>
    <component :is="componentNames" :items="items"></component>
    <pagination-links :pagination ="pagination"></pagination-links>
</dir>
</template>
<script>
export default {
    props:['url', 'componentNames'],
    data(){
    return{
        pagination: {},
        items: [],

    }
    },
    mounted() {
            axios.get(`${this.url}?page=${this.$route.query.page}` || 1).then(res => {
                this.pagination = res.data;
                this.items = res.data.data;
                delete this.pagination.data;
            }).catch(error => {

            });
        },
}
</script>

<style lang="scss">
 .pagination{
     a.active{
      background-color:#1abc9c;
      color: white;
     }
 }
</style>

