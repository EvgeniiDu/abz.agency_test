import Home from "@/Components/Home.vue";
import CreateUser from "@/Components/CreateUser.vue";

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/create',
        component: CreateUser
    }
]

export default routes;
