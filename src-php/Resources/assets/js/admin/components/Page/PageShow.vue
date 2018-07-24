<template>

    <div>
        <x-model
            :value="selected"
            @input="updateCurrentItem"
        >
            <v-form
                ref="form"
                slot-scope="{ value }"
                v-model="valid"
                lazy-validation
            >
                <content-card heading="Details">
                    <v-checkbox
                        v-model="value.active"
                        label="Published"
                    />

                    <v-text-field
                        v-model="value.name"
                        label="Name"
                        required
                    />

                    <v-text-field
                        v-model="value.slug"
                        label="Slug"
                        required
                    />

                    <v-select
                        v-model="value.parent_id"
                        :items="items"
                        label="Parent Page"
                        item-text="name"
                        item-value="id"
                        autocomplete
                    />
                </content-card>

                <meta-attributes
                    :item="item"
                />

                <content-card heading="Ordering">
                    <v-text-field
                        v-model.number="value.priority"
                        :rules="priorityRules"
                        :counter="4"
                        label="Priority"
                        hint="The higher the number, the higher the importance."
                        persistent-hint
                        required
                    />

                    <v-text-field
                        v-model.number="value.sort"
                        :rules="sortRules"
                        :counter="4"
                        label="Sort"
                        hint="The higher the number, the higher in the sort order."
                        persistent-hint
                        required
                    />
                </content-card>

                <content-card heading="Featured Image">
                    <dropzone-upload
                        id="imageBlockFeatured"
                        :block="imageBlock"
                        class="dropzone mb-2"
                        @input="value => value.featured_image = value"
                    />

                    <v-text-field
                        v-model="imageAlt"
                        :counter="50"
                        label="Alt Text"
                    />
                </content-card>

                <repeater-blocks
                    :repeaters="repeaters"
                    :content="value.page_content || []"
                    @input="content => value.page_content = content"
                />

                <delete-dialog
                    :open="showDelete"
                    @confirm="destroy"
                    @close="showDelete = false"
                />

                <dirty-dialog
                    :open="isDirty && showDirty"
                    @confirm="gotoNext"
                    @close="abortNext"
                />

            </v-form>
        </x-model>
    </div>

</template>

<script>
import { AjaxStoreMapper } from 'ajax-store'
import {
    Language,
    Repeaters,
    DetailView,
    MetaAttributes,
    RepeaterBlocks,
    FeaturedImageMixin,
} from 'maxfactor-cms'

export default {

    components: {
        RepeaterBlocks,
        MetaAttributes,
    },

    mixins: [
        Language,
        DetailView,
        AjaxStoreMapper('page'),
        FeaturedImageMixin,
    ],

    data() {
        return {
            routeNamespace: 'admin.page', // Laravel
            indexRouteName: 'page.index', // Vuex
            toolbar: [
                {
                    title: 'Save',
                    icon: 'save',
                    action: this.submit,
                },
            ],
            priorityRules: [
                value => (value !== '' && (value >= 0 && value <= 1000)) || 'Priority must be a number between 0 and 1000.',
            ],
            sortRules: [
                value => (value !== '' && (value >= 0 && value <= 1000)) || 'Sort order must be a number between 0 and 1000.',
            ],
        }
    },

    computed: {
        /**
         * Action route parameters for Ziggy to generate the correct API endpoint
         *
         * @return {Object} Route parameters
         */
        routeParams() {
            return {
                page: this.itemId,
                locale: this.locale,
            }
        },

        repeaters() {
            return Repeaters.RichTextRepeaters
        },
    },

}
</script>
