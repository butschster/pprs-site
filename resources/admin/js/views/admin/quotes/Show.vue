<template>
    <div class="main-content">
        <VueElementLoading :active="loading"/>

        <div class="page-header">
            <h3 class="page-title">
                {{ quote.title }}
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'quotes.index'}" href="#">Цитаты</router-link>
                </li>
                <li class="breadcrumb-item">{{ quote.title }}</li>
            </ol>
            <div class="page-actions">
                <button @click="remove" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Удалить
                </button>
            </div>
        </div>

        <Quote :quote="quote" class="mb-5"/>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" class="form-control form-control-lg" v-model="quote.title">
                    <FormError field="title"/>
                </div>
                <div class="form-group">
                    <label>Текст</label>
                    <CKEditor v-model="quote.text"/>
                    <FormError field="text"/>
                </div>

                <div class="form-group">
                    <label>Изображение</label>
                    <Dropzone @uploaded="fileUploaded" section="quote"  class="p-5 border border-dark"/>
                    <FormError field="image_uuid"/>
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
    import Dropzone from 'components/form/Dropzone'
    import Quote from './partials/Quote'

    export default {
        components: {CKEditor, VueElementLoading, FormError, Dropzone, Quote},
        data() {
            return {
                loading: false,
                quote: {
                    id: null,
                    title: '',
                    text: '',
                    image: '',
                    image_uuid: ''
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
                    const response = await axios.get(`/api/quote/${this.$route.params.id}`)
                    this.quote = response.data.data
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            },
            async save() {
                this.loading = true

                try {
                    const response = await axios.post(`/api/quote/${this.quote.id}`, this.quote)
                    this.quote = response.data.data

                    toastr['success']('Данные обновлены!', 'Success')
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            },
            async remove() {
                this.loading = true

                try {
                    await axios.delete(`/api/quote/${this.quote.id}`)
                    toastr['success']('Цитата удалена!', 'Success')
                    this.$router.push({name: 'quotes.index'})
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            },
            fileUploaded(data, file, dropzone) {
                this.quote.image_uuid = data.uuid
                this.quote.image = data.url
                dropzone.removeAllFiles()
            },
        }
    }
</script>