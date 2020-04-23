import VueRouter from 'vue-router';
import Dashboard from './pages/dashboard/Index';
import Countries from "./pages/Countries";
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
    ],
});
export default router;
