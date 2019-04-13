<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Pages</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">Страницы</li>
            </ol>
            <div class="page-actions">
                <a href="#" class="btn btn-primary">
                    <i class="icon-fa icon-fa-plus"></i> Добавить
                </a>
            </div>
        </div>
        <VueElementLoading :active="loading"   />
        <VueNestable v-model="pages" @change="changedPosition">
            <div slot-scope="{ item }" class="d-flex justify-content-center">
                <VueNestableHandle :item="item" class="mr-2">
                    <i class="fa fa-arrows" aria-hidden="true"></i>
                </VueNestableHandle>
                <router-link tag="a" :to="{name: 'page.show', params: {id: item.id }}" class="flex-grow-1">
                    {{ item.title }}
                </router-link>
            </div>
        </VueNestable>
    </div>
</template>

<script>
    import {VueNestable, VueNestableHandle} from 'vue-nestable'
    import VueElementLoading from 'vue-element-loading'

    export default {
        components: {
            VueNestable,
            VueNestableHandle,
            VueElementLoading
        },
        data() {
            return {
                loading: false,
                pages: []
            }
        },
        created() {
            this.load()
        },
        methods: {
            async load() {
                this.loading = true
                try {
                    const response = await axios.get('/api/pages')
                    this.pages = response.data
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            },
            async changedPosition(value, options) {
                this.loading = true

                try {
                    const response =await axios.post('/api/pages/sort', {
                        pages: this.pages
                    })
                    this.pages = response.data
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            }
        }
    }
</script>