
import Router from 'vue-router';
import Vue from 'vue';

import Home from './views/Home';
import About from './views/About';
import Archive from './views/Archive';
import Contact from './views/Contact';
import Error from './views/404';
import postShow from './views/PostShow'
import categoryPost from './views/CategoryPost'
import tagPosts from './views/TagsPosts'




Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/nosotros',
            name: 'about',
            component: About
        },
        {
            path: '/archivo',
            name: 'archive',
            component: Archive
        },
        {
            path: '/contacto',
            name: 'contact',
            component: Contact
        },

        {
            path: '/blog/:slug',
            name: 'post_show',
            component: postShow,
            props:true
        },{
            path: '/category/:category',
            name: 'category_post',
            component: categoryPost,
            props:true

        },
        {
            path: '/tags/:tag',
            name: 'tags_post',
            component: tagPosts,
            props:true
        },
        {
            path: '*',
            component: Error
        }
    ],
    linkExactActiveClass: 'active',
    mode: 'history',
    scrollBehavior(){
        return { x:0, y:0};
    }
});
