<template>
<router-link class="category text-capitalize" :to="{name: 'category_post', params: {category: category.slug }}" v-text="category.name"></router-link>

</template>
<script>
export default {
    props:['category']

}
</script>
