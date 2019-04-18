<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Pages</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">Страницы</li>
            </ol>
            <div class="page-actions">
                <router-link :to="{name: 'page.create'}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Добавить
                </router-link>
            </div>
        </div>
        <VueElementLoading :active="loading"   />
        <VueNestable v-model="pages" @change="changedPosition">
            <div slot-scope="{ item }" class="d-flex justify-content-center">
                <VueNestableHandle :item="item" class="mr-2 bg-light text-muted p-2">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </VueNestableHandle>
                <div class="flex-grow-1 p-2 d-flex justify-content-center">
                    <router-link tag="a" class="flex-grow-1" :to="{name: 'page.show', params: {id: item.id }}">
                        <i class="fa fa-chevron-right mr-2" :style="{color: item.color}"></i> {{ item.title }}
                    </router-link>
                    <router-link tag="a" :to="{name: 'page.create', params: {parent_id: item.id }}" class="btn px-2 btn-success btn-xs rounded-circle">
                        <i class="fa fa-plus"></i>
                    </router-link>
                </div>
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
                    toastr['success']('Готово!', 'Success')
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            }
        }
    }
</script>