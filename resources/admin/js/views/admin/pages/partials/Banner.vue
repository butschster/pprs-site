<template>
    <div class="card">
        <div class="card-header text-white bg-primary">
            Баннер <span v-if="!isExists" class="badge badge-warning">Не добавлен</span>
        </div>
        <Dropzone section="banners" @uploaded="fileUploaded" :useCustomSlot="true">
            <div class="jumbotron rounded-0 top-banner mb-0">
                <div class="top-banner__container main-container" :style="{backgroundImage: `url('${banner.image_url}')`}">
                    <div class="top-banner__text" v-html="banner.content"></div>
                    <h1 class="top-banner__title"><a href="#">Section name</a></h1>
                </div>
            </div>
        </Dropzone>

        <div class="card-body">
            <VueCkeditor :config="config"  v-model="banner.content"/>
            <FormError field="content"/>
        </div>
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
    import VueCkeditor from 'vue-ckeditor2'
    import FormError from '../../../../components/form/FormError'
    import Dropzone from '../../../../components/Dropzone'

    export default {
        components: {
            Dropzone, FormError, VueCkeditor
        },
        props: ['id', 'value'],
        data() {
            return {
                banner: {
                    id: null,
                    image_uuid: null,
                    image_url: null,
                    content: ''
                },
                config: {
                    height: 100,
                    filebrowserImageBrowseUrl: '/api/files?type=Images',
                    filebrowserImageUploadUrl: '/api/files/upload?type=Images&_token=',
                    filebrowserBrowseUrl: '/api/files?type=Files',
                    filebrowserUploadUrl: '/api/files/upload?type=Files&_token='
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
                    const response = await axios.put(`/api/banner/${this.id}`, {
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
                    await axios.delete(`/api/banner/${this.id}`)

                    this.banner = {
                        id: null,
                        image_uuid: null,
                        image_url: null,
                        content: '',
                    }
                } catch (e) {
                    console.error(e)
                }
            },
            fileUploaded(data, file, dropzone) {
                this.banner.image_uuid = data.uuid
                this.banner.image_url = data.url
                dropzone.removeAllFiles()
            },
        },
        computed: {
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