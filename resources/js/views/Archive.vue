<template>
    <section class="pages container">
    <div class="page page-archive">
        <h1 class="text-capitalize">archive</h1>
        <p>Nam efficitur, massa quis fringilla volutpat, ipsum massa consequat nisi, sed eleifend orci sem sodales lorem. Curabitur molestie eros urna, eleifend molestie risus placerat sed.</p>
        <div class="divider-2" style="margin: 35px 0;"></div>
        <div class="container-flex space-between">
            <div class="authors-categories">
                <h3 class="text-capitalize">authors</h3>
                <ul class="list-unstyled">
                    <li v-for="author in authors" :key="author.id">{{ author.name}}</li>
                    <li v-if="!authors.length">Aun no hay Autores</li>
                </ul>
                <h3 class="text-capitalize">categories</h3>
                <ul class="list-unstyled">
                    <li class="text-capitalize" v-for="category in categories" :key="category.id">
                        <category-link :category="category"></category-link>
                     </li>
                    <li v-if="!categories.length" class="text-capitalize">Aun no hay categorias</li>
                </ul>
            </div>
            <div class="latest-posts">
                <h3 class="text-capitalize">latest posts</h3>
                <p v-for="post in posts" :key="post.id">
                    <post-link :post="post">{{ post.title}}</post-link>
                </p>
                <p v-if="!posts.length">No hay Posts Aun</p>
                <h3 class="text-capitalize">posts by month</h3>
                <ul class="list-unstyled">
                    <li class="text-capitalize" v-for="item in archive" :key="item.id">{{item.monthname}}-{{item.year}}({{ item.posts }})</li>
                    <!-- <li class="text-capitalize"> <a href=" {{ route('page.home', ['month' => $item->month, 'year' => $item->year ]) }}"> -->
                    <li v-if="!archive.length">Sin fecha</li>
                </ul>
            </div>
        </div>
    </div>
</section>

</template>
<script>
export default {
    data(){
        return {
         archive: [],
         authors : [],
         categories : [],
         posts : [],
        }
    },
    mounted(){
        axios.get('/api/archivo').then(res=>{
            this.archive = res.data.archive;
            this.authors = res.data.authors;
            this.categories = res.data.categories;
            this.posts = res.data.posts;

        }).catch(err=>{

        })
    }
}
</script>
