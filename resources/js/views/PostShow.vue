<template>
    <article class="post container">
        <!-- @include($post->viewType()) -->
        <div class="content-post">
            <post-header :post="post"></post-header>
            <div class="image-w-text" v-html="post.body">

            </div>
            <footer class="container-flex space-between">
                <social-links :description="post.title"></social-links>
                <!-- @include('partials.social-links',['descriptions'=>$post->title]) -->
                <post-tag :post="post"></post-tag>
            </footer>
            <div class="comments">
                <div class="divider"></div>
                 <disqus-comments></disqus-comments>
            </div><!-- .comments -->
        </div>
    </article>

</template>
<script>
    export default {
        props: ['slug'],
        data() {
            return {
                post: {
                    user:{},
                    category: {}
                },

            }
        },
        mounted() {
            axios.get('/api/blog/' + this.slug).then(res => {
                this.post = res.data;
            }).catch(err => {
                console.log(err.data);

            });
        }
    }

</script>
