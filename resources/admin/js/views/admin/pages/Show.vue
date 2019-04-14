<template>
    <div class="main-content">
        <VueElementLoading :active="loading"/>
        <div class="page-header" v-if="page">
            <h3 class="page-title">
                <i class="fa fa-chevron-right" aria-hidden="true" :style="{color: page.color}"></i>
                {{ page.title }}
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'pages.index'}" href="#">Страницы</router-link>
                </li>
                <li class="breadcrumb-item">{{ page.title }}</li>
            </ol>
        </div>

        <div v-if="page">
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

                        <FormError field="title" />
                    </div>
                    <div class="form-group">
                        <label>Текст ссылки</label>
                        <input type="text" class="form-control" v-model="page.slug" :placeholder="slug">
                        <span class="help-text">{{ page.link }}</span>

                    </div>
                    <div class="form-group">
                        <label>Родительская страница</label>
                        <Treeselect v-model="page.parent_id" :options="pages"/>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="button" @click="save">
                        <i class="fa fa-check"></i> Сохранить
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Meta данные
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Meta title</label>
                        <input type="text" class="form-control" v-model="page.meta_title">
                    </div>
                    <div class="form-group">
                        <label>Meta keywords</label>
                        <input type="text" class="form-control" v-model="page.meta_keywords">
                    </div>
                    <div class="form-group">
                        <label>Meta description</label>
                        <input type="text" class="form-control" v-model="page.meta_description">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="button" @click="save">
                        <i class="fa fa-check"></i> Сохранить
                    </button>
                </div>
            </div>

            <Banner v-if="page.id" :id="page.banner_id" :page_id="page.id" />

            <div class="card">
                <div class="card-header text-white bg-primary">
                    Текст
                </div>
                <VueCkeditor v-model="page.text" :config="config" />
                <div class="card-footer">
                    <button class="btn btn-primary" type="button" @click="save">
                        <i class="fa fa-check"></i> Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueElementLoading from 'vue-element-loading'
    import Swatches from 'vue-swatches'
    import VueCkeditor from 'vue-ckeditor2'
    import Treeselect from '@riophae/vue-treeselect'
    import FormError from '../../../components/form/FormError'
    import Banner from './partials/Banner'

    const slugify = require('@sindresorhus/slugify')

    export default {
        components: {VueElementLoading, Swatches, Treeselect, FormError, Banner, VueCkeditor},
        data() {
            return {
                loading: true,
                colors: 'material-basic',
                page: null,
                pages: [],
                config: {}
            }
        },
        created() {
            this.loadPage()
        },
        methods: {
            async loadPage() {
                this.loading = true

                try {
                    await this.loadPages()
                    const response = await axios.get(`/api/page/${this.id}`)
                    this.page = response.data.data
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            },
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
            async save() {
                this.loading = true

                try {
                    const response = await axios.post(`/api/page/${this.id}`, this.page)
                    this.page = response.data.data

                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            }
        },
        computed: {
            id() {
                return this.$route.params.id
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