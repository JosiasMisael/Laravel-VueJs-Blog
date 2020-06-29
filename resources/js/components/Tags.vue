<template>
    <div class="tags container-flex">
        <span v-for="tag in post.tags" :key="tag.id" class="tag c-gris text-capitalize">
             <router-link :to="{name: 'tags_post', params: {tag: tag.slug }}" >#{{tag.name}}</router-link>
 <!-- <a href="#">#{{ tag.name}}</a> -->
        </span>
        <!-- <span class="tag c-gris text-capitalize" v-if="!post.tags.length">#No hay tags</span> -->
    </div>
</template>
<script>
    export default {
        props :['post']

    }

</script>
