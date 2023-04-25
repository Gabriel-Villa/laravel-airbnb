import './bootstrap';
import '../css/app.css';
import 'flowbite';
import vSelect from 'vue-select'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { createPinia } from 'pinia'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import 'vue3-toastify/dist/index.css';

import { library } from '@fortawesome/fontawesome-svg-core'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import {
    faUserSecret,
    faMagnifyingGlass,
    faBars,
    faXmark,
    faHouse,
    faUmbrellaBeach,
    faFire,
    faHeart,
    faShip,
    faSnowboarding,
    faMinus,
    faPlus
} from '@fortawesome/free-solid-svg-icons'

import { faFacebook, faGoogle, faGithub } from '@fortawesome/free-brands-svg-icons'

library.add(
    faUserSecret,
    faMagnifyingGlass,
    faFacebook,
    faGoogle,
    faGithub,
    faBars,
    faXmark,
    faHouse,
    faUmbrellaBeach,
    faFire,
    faHeart,
    faShip,
    faSnowboarding,
    faMinus,
    faPlus
)

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('font-awesome-icon', FontAwesomeIcon)
            .component('v-select', vSelect)
            .use(ZiggyVue, Ziggy)
            .use(createPinia())
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
