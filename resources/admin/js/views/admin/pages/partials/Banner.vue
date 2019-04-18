<template>
    <div class="card shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="flex-fill">Главный баннер <span v-if="!isExists" class="badge badge-warning">Не добавлен</span>
            </div>
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

            <button v-if="isExists" class="btn btn-danger" type="button" @click="remove">
                <i class="fa fa-trash"></i> Удалить
            </button>
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
        props: ['id', 'value'],
        data() {
            return {
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
            if (this.id) {
                this.load()
            }
        },
        methods: {
            async load() {
                try {
                    const response = await axios.get(`/api/banner/${this.id}`)
                    this.banner = response.data.data
                } catch (e) {

                }
            },
            save() {
                this.isExists ? this.update() : this.store()
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
            async store() {
                try {
                    const response = await axios.post(`/api/banner`, {
                        content: this.banner.content,
                        image_uuid: this.banner.image_uuid
                    })

                    this.banner = response.data.data

                    this.$emit('created', this.banner.id)
                    this.$emit('input', this.banner.id)
                    toastr['success']('Баннер создан!', 'Success')
                } catch (e) {
                    console.error(e)
                }
            },
            async remove() {
                try {
                    await axios.delete(`/api/banner/${this.banner.id}`)

                    this.banner = {
                        id: null,
                        image_uuid: null,
                        image_url: null,
                        content: '',
                    }
                    toastr['success']('Баннер спешно удален!', 'Success')

                    this.$emit('input', null)
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
            isExists() {
                return this.banner.id
            },
            actionText() {
                if (this.isExists) {
                    return 'Сохранить'
                }

                return 'Создать'
            }
        }
    }
</script>