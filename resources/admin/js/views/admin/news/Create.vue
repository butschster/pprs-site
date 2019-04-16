<template>
    <div class="main-content">
        <VueElementLoading :active="loading"/>

        <div class="page-header">
            <h3 class="page-title">
                {{ title }}
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'news.index'}" href="#">Новости</router-link>
                </li>
                <li class="breadcrumb-item">{{ title }}</li>
            </ol>
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
                    <CKEditor v-model="news.text" :height="600"/>
                    <FormError field="text"/>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="button" @click="store">
                    <i class="fa fa-check"></i> Создать
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
                    description: '',
                    title: '',
                    text: '',
                }
            }
        },
        methods: {
            async store() {
                this.loading = true

                try {
                    const response = await axios.post(`/api/news`, this.news)
                    toastr['success']('Новость добавлена!', 'Success')

                    this.$router.push({name: 'news.show', params: {id: response.data.data.id}})
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            }
        },
        computed: {
            title() {
                if (this.news.title.length === 0) {
                    return 'Новая новость'
                }

                return this.news.title
            }
        }
    }
</script>