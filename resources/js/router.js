import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './routes/Home.vue'
import Create from './routes/posts/Create.vue'
import Contacts from './routes/Contacts.vue'
import Show from './routes/posts/Show.vue'
import Error from "./routes/Error.vue";

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Home, name: "home.index", meta: {title: "Home", linkText: "Home"} },
        { path: '/contacts', component: Contacts, name: "contacts.index", meta: {title: "Contattaci", linkText: "Contatti"} },
        { path: '/create', component: Create, name: "post.store", meta: {title: "Nuovo Post", linkText: "Scrivi Post"} },
        { path: '/post/:post', component: Show, name: "post.show", meta: { title: "Dettagli post" } },
        { path: '/404', alias: '*', component: Error, name: "error", meta: { title: "Error" } },
    ]
})

router.beforeEach((to, from,next) =>{
    document.title=to.meta.title;

    next();
});

export default router;
