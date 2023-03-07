import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import ConfirmationService from 'primevue/confirmationservice';
import PrimeVue from 'primevue/config';
import "primevue/resources/themes/mdc-light-indigo/theme.css"       //thema gratuido que soporta Composicion API de Vue 3
import "primevue/resources/primevue.min.css"                 //core css
import "primeicons/primeicons.css"                           //icons


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue)
            .use(ConfirmationService)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
