<template>
    <div>
        <div class="rounded-0 card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div class="flex-fill">Секционный баннер</div>
            <Responsive @preview="resizeBanner"/>
        </div>

        <Dropzone id="section_banner" section="section_banner" @uploaded="fileUploaded" :useCustomSlot="true" class="card-body">
            <div class="banner mb-0 position-relative" :class="bannerSize">
                <h2 class="banner__name-page main-container" :style="{color: page.color }">{{ page.section_title }}</h2>
                <div class="banner__container" :style="bannerImage">
                    <h2 class="banner__title" :style="{background: page.color}">{{ page.section_subtitle }}</h2>
                    <div class="banner__text-preview main-container" v-html="page.section_image_text"/>
                </div>

                <button v-if="page.section_image_uuid" class="btn btn-sm btn-danger position-absolute" type="button"
                        @click="removeImage" style="top: 20px; right: 20px">
                    <i class="fa fa-trash fa-fw"></i>
                </button>
            </div>
        </Dropzone>
        <div class="card-body">
            <div class="form-group">
                <label>Заголовок</label>
                <input type="text" class="form-control" v-model="page.section_title">
                <FormError field="section_title"/>
            </div>
            <div class="form-group">
                <label>Подзаголовок</label>
                <input type="text" class="form-control" v-model="page.section_subtitle">
                <FormError field="section_subtitle"/>
            </div>
            <div class="form-group">
                <label>Краткое описание</label>
                <CKEditor v-model="page.section_image_text" bodyClass="ckeditor banner__text-preview" />
                <FormError field="section_image_text"/>
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
        props: ['value'],
        data() {
            return {
                bannerSize: 'col-12',
                page: {
                    color: '',
                    section_title: '',
                    section_subtitle: '',
                    section_text: '',
                    section_image_url: '',
                    section_image_text: '',
                    section_image_uuid: null
                }
            }
        },
        created() {
            this.page = this.value
        },
        watch: {
            page: {
                handler(data) {
                    this.$emit('input', data)
                },
                deep: true
            }
        },
        methods: {
            fileUploaded(data, file, dropzone) {
                this.page.section_image_uuid = data.uuid
                this.page.section_image_url = data.url
                dropzone.removeAllFiles()
            },
            removeImage() {
                this.page.section_image_uuid = null
                this.page.section_image_url = null
            },
            resizeBanner(size) {
                this.bannerSize = size
            }
        },
        computed: {
            bannerImage() {
                if (this.page.section_image_url) {
                    return {background: `url(${this.page.section_image_url})`}
                }

                return null
            }
        }
    }
</script>