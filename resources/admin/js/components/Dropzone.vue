<template>
    <div>
        <VueDropzone ref="dropzone" id="dropzone" :options="options" @vdropzone-success="fileUploaded" @vdropzone-sending="sendingEvent" :useCustomSlot="useCustomSlot">
            <slot></slot>
        </VueDropzone>
        <FormError field="file"/>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import FormError from './form/FormError'

    import Ls from '../services/ls'
    const AUTH_TOKEN = Ls.get('auth.token')

    export default {
        components: {VueDropzone: vue2Dropzone, FormError},
        props: {
            section: String,
            useCustomSlot: {
                type: Boolean,
                default() {
                    return false
                }
            }
        },
        data() {
            return {
                options: {
                    url: '/api/image/upload',
                    uploadMultiple: false,
                    maxFiles: 1,
                    acceptedFiles: 'image/*',
                    headers: {"Authorization": `Bearer ${AUTH_TOKEN}`}
                }
            }
        },
        methods: {
            fileUploaded(file, {data}) {
                this.$emit('uploaded', data, file, this.$refs.dropzone)
            },
            sendingEvent(file, xhr, formData) {
                formData.append('section', this.section);
            }
        }
    }
</script>