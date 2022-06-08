import './bootstrap';


import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import MainLayout from "./Layouts/MainLayout.vue"

import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';

createInertiaApp({
  resolve: name => {
    let page = require(`./Pages/${name}`).default
    page.layout ??= MainLayout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .component("Link", Link)
      .mixin({ methods: { route } })
      .mount(el)
  },
})
