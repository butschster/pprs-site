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
        </div>

        <Quote :quote="quote" class="mb-5" :allowImageChange="true" @fileUploaded="fileUploaded"/>

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
                    <Dropzone @uploaded="fileUploaded" section="quote" class="p-5 border border-dark"/>
                    <FormError field="image_uuid"/>
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
    import Dropzone from 'components/form/Dropzone'
    import Quote from './partials/Quote'

    export default {
        components: {CKEditor, VueElementLoading, FormError, Dropzone, Quote},
        data() {
            return {
                loading: false,
                quote: {
                    id: null,
                    title: 'Новая цитата',
                    text: '',
                    image: '',
                    image_uuid: ''
                },
                config: {
                    height: 100
                }
            }
        },
        methods: {
            async store() {
                this.loading = true

                try {
                    const response = await axios.post(`/api/quote`, this.quote)
                    this.quote = response.data.data

                    toastr['success']('Создана новая цитата!', 'Success')
                    this.$router.push({name: 'quote.show', params: {id: this.quote.id}})
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