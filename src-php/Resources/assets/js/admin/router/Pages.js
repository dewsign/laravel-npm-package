import PageShow from '../components/Page/PageShow.vue'
import PageIndex from '../components/Page/PageIndex.vue'

export default [
    {
        path: '/page',
        name: 'page.index',
        component: PageIndex,
        meta: {
            title: 'All Pages',
        },
    },
    {
        path: '/page/create',
        name: 'page.create',
        component: PageShow,
        meta: {
            title: 'Create new Page',
        },
    },
    {
        path: '/page/:id',
        name: 'page.show',
        component: PageShow,
        meta: {
            title: 'Edit Page',
            localised: false,
        },
    },
]
