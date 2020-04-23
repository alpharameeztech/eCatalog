import VueRouter from 'vue-router';
import Dashboard from './pages/dashboard/Index';
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/admin',
            component: Dashboard,
            meta: {

            }
        },
        {
            path: '/admin/dashboard',
            component: Dashboard,
            meta: {

            }
        },
    ],
});
export default router;
