import {createRouter, createWebHistory} from "vue-router";



const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/contacts', component: () => import ('./views/Contacts/Index.vue'),
            name: 'contact.index'
        },
        {
            path: '/tasks', component: () => import ('./views/Tasks/Index.vue'),
            name: 'task.index'
        },
        {
            path: '/tasks/create', component: () => import ('./views/Tasks/Create.vue'),
            name: 'task.create'
        },
        {
            path:'/tasks/:id', component: () => import('./views/Tasks/Show.vue'),
            name: 'task.show',
            props: true
        }
    ],
})

export default router


