import VueRouter from 'vue-router';
import Dashboard from './pages/dashboard/Index';
import Countries from "./pages/Countries";
import Cities from "./pages/Cities";
import Stores from "./pages/Stores";
import Malls from "./pages/Malls";
import Branches from "./pages/Branches";
import Tags from "./pages/Tags";
import Catalogs from "./pages/Catalogs";
import CatalogImages from "./pages/CatalogImages";
import CatalogPdfs from "./pages/CatalogPdfs";
import Faqs from "./pages/Faqs";
import Terms from "./pages/Terms";
import Blogs from "./pages/Blogs";
import Settings from "./pages/Settings";
import Home from "./pages/Home";
import Socials from "./pages/Socials";
import Banners from "./pages/Banners";

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
        {
            path: '/home/catalog/images',
            component: CatalogImages,
        },
        {
            path: '/home/catalog/pdfs',
            component: CatalogPdfs,
        },
        {
            path: '/home/faqs',
            component: Faqs,
        },
        {
            path: '/home/terms',
            component: Terms,
        },
        {
            path: '/home/blogs',
            component: Blogs,
        },
        {
            path: '/home/settings',
            component: Settings,
        },
        {
            path: '/home/homepage',
            component: Home,
        },
        {
            path: '/home/socials',
            component: Socials,
        },
        {
            path: '/home/banners',
            component: Banners,
        }
    ],
});
export default router;
