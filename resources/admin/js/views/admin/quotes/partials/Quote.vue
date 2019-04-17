<template>
    <div class="my-5 quote">
        <div class="p-4 quote__text mw-50 px-0 col-12 col-lg-6 position-relative">
            <button type="button" class="btn position-absolute" v-clipboard:copy="code" style="top: 0; right: 0;" v-if="quote.id">
                <i class="fa fa-clipboard" aria-hidden="true"></i>
            </button>

            <div><i class="fa fa-3x fa-microphone text-secondary mb-4"></i></div>

            <router-link tag="h5" v-if="quote.id" :to="{name: 'quote.show', params: {id: quote.id }}" v-html="quote.text" />
            <h5 v-else v-html="quote.text" />
        </div>
        <div v-if="quote.image" class="quote__img d-none d-md-block px-0 col-6">
            <img height="360" width="560" :src="quote.image"/>
        </div>
    </div>
</template>

<script>
    import Dropzone from 'components/form/Dropzone'

    export default {
        components: {Dropzone},
        props: {
            quote: Object,
            allowImageChange: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            fileUploaded(data, file, dropzone) {
                this.$emit('fileUploaded', data, file, dropzone)
            },
        },
        computed: {
            code() {
                return `[quote|${this.quote.id}]`
            }
        }
    }
</script>