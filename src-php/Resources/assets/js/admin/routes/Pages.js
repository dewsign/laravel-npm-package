import PageShow from '../components/PageShow.vue'
import PageIndex from '../components/PageIndex.vue'

export default [
    {
        path: '/page',
        name: 'page.index',
        component: PageIndex,
    },
    {
        path: '/page/create',
        name: 'page.create',
        component: PageShow,
    },
    {
        path: '/page/:itemId',
        name: 'page.show',
        component: PageShow,
    },
]
