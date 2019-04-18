<template>
    <div>
        <VueDropzone :ref="id" :id="id" :options="options" @vdropzone-success="fileUploaded"
                     @vdropzone-sending="sendingEvent" :useCustomSlot="useCustomSlot">
            <slot></slot>
        </VueDropzone>
        <FormError field="file"/>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import FormError from './FormError'
    import { mapGetters } from 'vuex'

    export default {
        components: {VueDropzone: vue2Dropzone, FormError},
        props: {
            id: String,
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
                    headers: {"Authorization": this.token}
                }
            }
        },
        mounted() {
            this.$refs[this.id].setOption('headers', {"Authorization": this.token})
        },
        methods: {
            fileUploaded(file, {data}) {
                this.$emit('uploaded', data, file, this.$refs[this.id])
            },
            sendingEvent(file, xhr, formData) {
                formData.append('section', this.section);
            }
        },
        computed: {
            ...mapGetters({
                token: 'auth/bearerString'
            })
        }
    }
</script>