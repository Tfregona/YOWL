import { createRouter, createWebHistory } from "vue-router";
import Index from "../components/index.vue"

const routes = [{
    path: '/',
    name: 'welcome',
    component: Index
}];

export default createRouter({
    history: createWebHistory(),
    routes
})