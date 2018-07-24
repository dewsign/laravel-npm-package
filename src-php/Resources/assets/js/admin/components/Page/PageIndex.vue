<template>

    <list-view
        :show-route-name="showRouteName"
        :headers="listHeaders"
        :items="items"
        :loading="loading"
        heading="All Pages"
    >
        <template
            slot="row"
            slot-scope="{ item }"
        >
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.slug }}</td>
            <td>
                <v-chip
                    v-if="item.active"
                    small
                    color="green"
                    text-color="white"
                >Published</v-chip>
            </td>
        </template>
    </list-view>

</template>

<script>
import { AjaxStoreMapper } from 'ajax-store'
import { ListView } from 'maxfactor-cms'

export default {
    mixins: [
        ListView,
        AjaxStoreMapper('page'),
    ],

    data() {
        return {
            showRouteName: 'page.show', // Vuex
            listHeaders: [
                {
                    text: 'ID',
                    value: 'id',
                },
                {
                    text: 'Name',
                    value: 'name',
                },
                {
                    text: 'Slug',
                    value: 'slug',
                },
                {
                    text: 'Status',
                    value: 'status',
                },
            ],
            toolbar: [
                {
                    title: 'Create new Page',
                    icon: 'library_add',
                    route: 'page.create',
                },
            ],
        }
    },

}
</script>
