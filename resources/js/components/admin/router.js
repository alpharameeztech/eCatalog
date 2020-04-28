import VueRouter from 'vue-router';
import Dashboard from './pages/dashboard/Index';
import Countries from "./pages/Countries";
import Cities from "./pages/Cities";
import Stores from "./pages/Stores";
import Malls from "./pages/Malls";
import Branches from "./pages/Branches";
import Tags from "./pages/Tags";
import Catalogs from "./pages/Catalogs";

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
        {
            path: '/home/branches',
            component: Branches,
        },
        {
            path: '/home/tags',
            component: Tags,
        },
        {
            path: '/home/catalogs',
            component: Catalogs,
        },
    ],
});
export default router;
