<template>
    <div>
        <header class="container-flex space-between">
            <div class="date">
                <span class="c-gray-1">{{ post.published_date }} /{{ post.user.name}}</span>
            </div>
            <div class="post-category">
                <category-link class="category text-capitalize" :category="post.category" v-text="post.category.name" ></category-link>

                <!-- <router-link class="category text-capitalize" :to="{name: 'category_post', params: {category: post.category.slug }}" v-text="post.category.name"></router-link> -->
            </div>
        </header>
        <h1 v-text="post.title"></h1>
        <br>
        <div class="divider"></div>
        <br>
    </div>
</template>

<script>
    export default {
         props: ['post'],

    }

</script>
