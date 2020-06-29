<template>
  <section class="posts container">
       <post-list-item  v-for="post in items" :key="post.id" :post="post"></post-list-item>
        <article class="post" v-if="!items.length">
            {{ items }}
            <div class="content-post">
                <h1>Aun no hay publicaciones</h1>
            </div>
        </article>
    </section>
    <!-- $posts->appends(request()->all())->render("pagination::default") -->
</template>

<script>
export default {
    props : ['items'],
}
</script>
