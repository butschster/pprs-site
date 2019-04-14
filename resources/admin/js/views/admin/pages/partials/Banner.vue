<template>
    <div class="card">
        <div class="card-header text-white bg-primary">
            Баннер <span v-if="!isExists" class="badge badge-warning">Не добавлен</span>
        </div>
        <div class="card-body">
            <VueCkeditor v-model="banner.content"/>
            <FormError field="content"/>

            <VueDropzone ref="dropzone" id="dropzone" :options="dropzoneOptions"
                         @vdropzone-success="fileUploaded"
                         @vdropzone-sending="sendingEvent"
            />
            <FormError field="image_uuid"/>
        </div>
        <div class="jumbotron rounded-0 mb-0" :style="{backgroundImage: `url('${banner.image_url}')`}">
            <div class="top-banner__container main-container" v-html="banner.content"></div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="button" @click="save">
                <i class="fa fa-check"></i> {{ actionText }}
            </button>

            <button v-if="isExists"" class="btn btn-danger" type="button" @click="remove">
                <i class="fa fa-trash"></i> Удалить
            </button>
        </div>
    </div>
</template>

<script>
    import VueCkeditor from 'vue-ckeditor2'
    import vue2Dropzone from 'vue2-dropzone'
    import FormError from '../../../../components/form/FormError'

    import Ls from '../../../../services/ls'

    const AUTH_TOKEN = Ls.get('auth.token')

    export default {
        components: {
            VueDropzone: vue2Dropzone,
            FormError, VueCkeditor
        },
        props: ['id', 'page_id'],
        data() {
            return {
                banner: {
                    id: null,
                    image_uuid: null,
                    image_url: null,
                    content: '',
                    page_id: null
                },
                dropzoneOptions: {
                    url: '/api/image/upload',
                    uploadMultiple: false,
                    maxFiles: 1,
                    acceptedFiles: 'image/*',
                    headers: {"Authorization": `Bearer ${AUTH_TOKEN}`}
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
                } catch (e) {
                    console.error(e)
                }
            },
            async store() {
                try {
                    const response = await axios.post(`/api/banner`, {
                        content: this.banner.content,
                        page_id: this.page_id,
                        image_uuid: this.banner.image_uuid
                    })

                    this.banner = response.data.data
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
                        page_id: null
                    }
                } catch (e) {
                    console.error(e)
                }
            },
            fileUploaded(file, {data}) {
                this.banner.image_uuid = data.uuid
                this.banner.image_url = data.url
                this.$refs.dropzone.removeAllFiles()
            },
            sendingEvent(file, xhr, formData) {
                formData.append('section', 'banner');
            }
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