import VueRouter from 'vue-router';
import Dashboard from './pages/dashboard/Index';
import Countries from "./pages/Countries";
import Cities from "./pages/Cities";
import Stores from "./pages/Stores";
import Malls from "./pages/Malls";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            component: Dashboard,
            meta: {

            }
        },
        {
            path: '/home/dashboard',
            component: Dashboard,
            meta: {

            }
        },
        {
            path: '/home/countries',
            component: Countries,
        },
        {
            path: '/home/cities',
            component: Cities,
        },
        {
            path: '/home/stores',
            component: Stores,
        },
        {
            path: '/home/malls',
            component: Malls,
        },
    ],
});
export default router;
