<template>
     <router-link
     :to="{ name:'post_show',
     params: { slug: post.slug }}">
     <slot />
     </router-link>
</template>
<script>
export default {
    props:['post']
}
</script>
