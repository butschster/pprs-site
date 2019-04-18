<template>
    <div>
        <Responsive @preview="resize" v-if="allowResize"/>
        <div class="quote" :class="size">
            <div class="p-4 quote__text mw-50 px-0 col-12 col-lg-6 position-relative">
                <button type="button" class="btn position-absolute" v-clipboard:copy="code" style="top: 0; right: 0;" v-if="quote.id">
                    <i class="fa fa-clipboard" aria-hidden="true"></i>
                </button>

                <router-link :to="{name: 'quote.show', params: {id: quote.id }}">
                    <i class="fa fa-3x fa-microphone text-secondary mb-4"></i>
                </router-link>

                <div v-html="quote.text"/>
            </div>
            <div v-if="quote.image" class="quote__img d-none d-md-block px-0 col-6">
                <img height="360" width="560" :src="quote.image"/>
            </div>
        </div>
    </div>
</template>

<script>
    import Responsive from 'components/Responsive'

    export default {
        components: {Responsive},
        props: {
            allowResize: {
                type: Boolean,
                default: true
            },
            quote: Object,
            allowImageChange: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                size: 'col-12',
            }
        },
        methods: {
            fileUploaded(data, file, dropzone) {
                this.$emit('fileUploaded', data, file, dropzone)
            },
            resize(size) {
                this.size = size
            }
        },
        computed: {
            code() {
                return `[quote|${this.quote.id}]`
            }
        }
    }
</script>