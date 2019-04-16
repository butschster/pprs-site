<template>
    <div>
        <div class="card-header bg-primary text-white">
            Секционный баннер
        </div>
        <Dropzone section="section_banner" @uploaded="fileUploaded" :useCustomSlot="true" class="card-body">
            <div class="banner mb-0">
                <h2 class="banner__name-page main-container" :style="{color: page.color }">{{ page.section_title }}</h2>
                <div class="banner__container" :style="{background: `url(${page.section_image_url})`}">
                    <h2 class="banner__title" :style="{background: page.color}">{{ page.section_subtitle }}</h2>
                    <div class="banner__text-preview main-container" v-html="page.section_text"/>
                </div>
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
                <CKEditor v-model="page.section_text"/>
                <FormError field="section_text"/>
            </div>
        </div>
    </div>
</template>

<script>
    import CKEditor from 'components/form/CKEditor'
    import FormError from 'components/form/FormError'
    import Dropzone from 'components/form/Dropzone'

    export default {
        components: {
            Dropzone, FormError, CKEditor
        },
        props: ['value'],
        data() {
            return {
                page: {
                    color: '',
                    section_title: '',
                    section_subtitle: '',
                    section_text: '',
                    section_image_url: ''
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
            }
        }
    }
</script>