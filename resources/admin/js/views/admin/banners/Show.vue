<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Баннеры</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">Баннеры</li>
            </ol>
        </div>

        <VueElementLoading :active="loading"/>

        <div class="card shadow-lg">
            <div class="alert alert-info my-0" v-if="banner.page">
                Находится на странице <router-link class="btn btn-link" :to="{name: 'page.show', params: {id: banner.page.id }}" href="#">{{ banner.page.title }}</router-link>
            </div>
            <div v-else  class="alert alert-warning my-0">
                Не привязан ни к какой странице
            </div>
            <div class="card-header d-flex justify-content-between align-items-center">
                <Responsive @preview="resizeBanner"/>
            </div>
            <Dropzone id="top_banner" section="banners" @uploaded="fileUploaded" :useCustomSlot="true">
                <div class="jumbotron rounded-0 top-banner mb-0" :class="bannerSize" :style="bannerBackground">
                    <div class="top-banner__container main-container">
                        <div class="top-banner__text" v-html="banner.content"></div>
                        <h1 class="top-banner__title">{{ sectionName }}</h1>
                    </div>

                    <button v-if="banner.image_uuid" class="btn btn-sm btn-danger position-absolute" type="button"
                            @click="removeImage" style="top: 20px; right: 20px">
                        <i class="fa fa-trash fa-fw"></i>
                    </button>
                </div>
            </Dropzone>
            <CKEditor v-model="banner.content" bodyClass="ckeditor top-banner__text"/>
            <FormError field="content"/>
            <div class="card-footer">
                <button class="btn btn-primary" type="button" @click="save">
                    <i class="fa fa-check"></i> {{ actionText }}
                </button>
                <button class="btn btn-danger" type="button" @click="remove">
                    <i class="fa fa-trash"></i> Удалить
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import CKEditor from 'components/form/CKEditor'
    import FormError from 'components/form/FormError'
    import Dropzone from 'components/form/Dropzone'
    import Responsive from 'components/Responsive'

    export default {
        components: {
            Dropzone, FormError, CKEditor, Responsive
        },
        data() {
            return {
                loading: false,
                bannerSize: 'col-12',
                banner: {
                    id: null,
                    image_uuid: null,
                    image_url: null,
                    content: ''
                }
            }
        },
        created() {
            this.load()
        },
        methods: {
            async load() {
                try {
                    const response = await axios.get(`/api/banner/${this.$route.params.id}`)
                    this.banner = response.data.data
                } catch (e) {

                }
            },
            save() {
                this.update()
            },
            async update() {
                try {
                    const response = await axios.put(`/api/banner/${this.banner.id}`, {
                        content: this.banner.content,
                        image_uuid: this.banner.image_uuid
                    })

                    this.banner = response.data.data

                    toastr['success']('Баннер обновлен!', 'Success')

                } catch (e) {
                    console.error(e)
                }
            },
            async remove() {
                try {
                    await axios.delete(`/api/banner/${this.banner.id}`)

                    toastr['success']('Баннер спешно удален!', 'Success')
                    this.$router.push({name: 'banners.index'})
                } catch (e) {
                    console.error(e)
                }
            },
            removeImage() {
                this.banner.image_uuid = null
                this.banner.image_url = null
            },
            fileUploaded(data, file, dropzone) {
                this.banner.image_uuid = data.uuid
                this.banner.image_url = data.url
                dropzone.removeAllFiles()
            },
            resizeBanner(size) {
                this.bannerSize = size
            }
        },
        computed: {
            sectionName() {
                if (this.banner.page) {
                    return this.banner.page.title
                }

                return 'Section name'
            },
            bannerBackground() {
                if (this.banner.image_url) {
                    return {backgroundImage: `url('${this.banner.image_url}')`}
                }
            },
            actionText() {
                return 'Сохранить'
            }
        }
    }
</script>