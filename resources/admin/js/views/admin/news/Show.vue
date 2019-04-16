<template>
    <div class="main-content">
        <VueElementLoading :active="loading"/>

        <div class="page-header">
            <h3 class="page-title">
                {{ news.title }}
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'news.index'}" href="#">Новости</router-link>
                </li>
                <li class="breadcrumb-item">{{ news.title }}</li>
            </ol>
            <div class="page-actions">
                <a :href="news.link" target="_blank" class="btn btn-xs btn-link">
                    <i class="fa fa-external-link" aria-hidden="true"></i> Посмотреть
                </a>
                <button @click="remove" class="btn btn-xs btn-danger">
                    <i class="fa fa-trash"></i> Удалить
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" class="form-control form-control-lg" v-model="news.title">
                    <FormError field="title"/>
                </div>
                <div class="form-group">
                    <label>Краткое описание</label>
                    <CKEditor v-model="news.description" toolbar="minimal"/>
                    <FormError field="description"/>
                </div>
            </div>
            <div class="card-header bg-primary text-white">
                Meta данные
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Meta title</label>
                    <input type="text" class="form-control" v-model="news.meta_title" :placeholder="news.title">
                    <small class="help-text text-muted">Если поле не заполнено, значение будет взято из названия</small>
                    <FormError field="meta_title"/>
                </div>
                <div class="form-group">
                    <label>Meta keywords</label>
                    <input type="text" class="form-control" v-model="news.meta_keywords">
                    <FormError field="meta_keywords"/>
                </div>
                <div class="form-group">
                    <label>Meta description</label>
                    <input type="text" class="form-control" v-model="news.meta_description">
                    <FormError field="meta_description"/>
                </div>
            </div>
            <div class="card-header bg-primary text-white">
                Текст
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Текст</label>
                    <CKEditor v-model="news.text" :height="600" />
                    <FormError field="text"/>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="button" @click="save">
                    <i class="fa fa-check"></i> Сохранить
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import CKEditor from 'components/form/CKEditor'
    import FormError from 'components/form/FormError'
    import VueElementLoading from 'vue-element-loading'

    export default {
        components: {CKEditor, VueElementLoading, FormError},
        data() {
            return {
                loading: false,
                news: {
                    id: null,
                    title: '',
                    text: '',
                }
            }
        },
        mounted() {
            this.load()
        },
        methods: {
            async load() {
                this.loading = true

                try {
                    const response = await axios.get(`/api/news/${this.$route.params.id}`)
                    this.news = response.data.data
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            },
            async save() {
                this.loading = true

                try {
                    const response = await axios.post(`/api/news/${this.news.id}`, this.news)
                    this.news = response.data.data

                    toastr['success']('Данные обновлены!', 'Success')
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            },
            async remove() {
                this.loading = true

                try {
                    await axios.delete(`/api/news/${this.news.id}`)
                    toastr['success']('Новость удалена!', 'Success')
                    this.$router.push({name: 'news.index'})
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            }
        }
    }
</script>