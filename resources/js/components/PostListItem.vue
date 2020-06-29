<template>
        <article class="post">
            <div class="content-post">
                <post-header :post="post"></post-header>
                <p v-html="post.excerpt"> </p>
                <footer class="container-flex space-between">
                    <div class="read-more">
                        <post-link :post="post" class="text-uppercase c-green">
                         Leer mas</post-link>
                    </div>
                    <!-- @include('posts.tags') -->
                    <post-tag :post="post"></post-tag>
                </footer>
            </div>
        </article>

</template>
<script>
export default {
 props : ['post']

}
</script>
