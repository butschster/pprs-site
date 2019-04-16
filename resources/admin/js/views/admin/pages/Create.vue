<template>
    <div class="main-content">
        <VueElementLoading :active="loading"/>
        <div class="page-header">
            <h3 class="page-title">
                <i class="fa fa-chevron-right" aria-hidden="true" :style="{color: page.color}"></i>
                {{ title}}
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'pages.index'}" href="#">Страницы</router-link>
                </li>
                <li class="breadcrumb-item">{{ title }}</li>
            </ol>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="form-group">
                    <label>Название страницы</label>
                    <div class="d-flex">
                        <div class="flex-grow-1 mr-3">
                            <input type="text" class="form-control form-control-lg" v-model="page.title">
                        </div>
                        <Swatches v-model="page.color" :colors="colors" popover-to="left" row-length="6"
                                  swatch-size="46" :trigger-style="{borderRadius: '6px'}"/>
                    </div>

                    <FormError field="title"/>
                    <FormError field="color"/>
                </div>
                <div class="form-group">
                    <label>Текст ссылки</label>
                    <input type="text" class="form-control" v-model="page.slug" :placeholder="slug">
                    <small class="help-text text-muted">Для автоматической генерации оставьте поле пустым</small>
                    <FormError field="slug"/>
                </div>
                <div class="form-group">
                    <label>Родительская страница</label>
                    <Treeselect v-model="page.parent_id" :options="pages"/>
                    <FormError field="parent_id"/>
                </div>
            </div>

            <div class="card-header bg-primary text-white">
                Meta данные
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Meta title</label>
                    <input type="text" class="form-control" v-model="page.meta_title">
                    <FormError field="meta_title"/>
                </div>
                <div class="form-group">
                    <label>Meta keywords</label>
                    <input type="text" class="form-control" v-model="page.meta_keywords">
                    <FormError field="meta_keywords"/>
                </div>
                <div class="form-group">
                    <label>Meta description</label>
                    <input type="text" class="form-control" v-model="page.meta_description">
                    <FormError field="meta_description"/>
                </div>
            </div>
            <div class="card-header text-white bg-primary">
                Текст
            </div>
            <div class="form-group">
                <CKEditor v-model="page.text"/>
                <FormError field="text"/>
            </div>
            <SectionBanner v-if="page" v-model="page" />
            <div class="card-footer">
                <button class="btn btn-primary" type="button" @click="store">
                    <i class="fa fa-check"></i> Сохранить
                </button>
            </div>
        </div>

        <Banner v-model="page.banner_id"/>
    </div>
</template>

<script>
    import CKEditor from 'components/form/CKEditor'
    import VueElementLoading from 'vue-element-loading'
    import Swatches from 'vue-swatches'
    import Treeselect from '@riophae/vue-treeselect'
    import FormError from 'components/form/FormError'
    import Banner from './partials/Banner'
    import SectionBanner from './partials/SectionBanner'

    const slugify = require('@sindresorhus/slugify')

    export default {
        components: {VueElementLoading, Swatches, Treeselect, FormError, Banner, CKEditor, SectionBanner},
        data() {
            return {
                loading: true,
                colors: 'material-basic',
                page: {
                    title: '',
                    slug: '',
                    banner_id: null,
                    text: '',
                    meta_title: '',
                    meta_keywords: '',
                    meta_description: '',
                    parent_id: null,
                    color: ''
                },
                pages: []
            }
        },
        async created() {
            await this.loadPages()
            if (this.$route.params.parent_id) {
                this.page.parent_id = this.$route.params.parent_id
            }
        },
        methods: {
            async loadPages() {
                this.loading = true

                try {
                    const response = await axios.get('/api/pages')
                    this.pages = response.data
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            },
            async store() {
                this.loading = true

                try {
                    const response = await axios.post(`/api/page`, this.page)
                    this.page = response.data.data

                    toastr['success']('Страница создана!', 'Success')
                    this.$router.push({name: 'page.show', params: {id: this.page.id}})
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            }
        },
        computed: {
            title() {
                if(this.page.title.length === 0) {
                    return 'Новая страница'
                }

                return this.page.title
            },
            slug() {
                if (!this.page.slug) {
                    return slugify(this.page.title);
                }

                return this.page.slug
            }
        }
    }
</script>