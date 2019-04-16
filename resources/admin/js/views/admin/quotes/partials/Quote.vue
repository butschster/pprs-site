<template>
    <div class="d-flex shadow-lg bg-white rounded">
        <div class="border-right position-relative p-5 flex-fill" style="background-image: url('https://www.toptal.com/designers/subtlepatterns/patterns/arches.png')">
            <button type="button" class="btn position-absolute" v-clipboard:copy="code" style="top: 0; right: 0;" v-if="quote.id">
                <i class="fa fa-clipboard" aria-hidden="true"></i>
            </button>

            <div class="mr-4"><i class="fa fa-3x fa-microphone" aria-hidden="true"></i></div>
            <router-link v-if="quote.id" class="lead mt-3 mb-0" :to="{name: 'quote.show', params: {id: quote.id }}" v-html="quote.text" />
            <div v-else class="lead mt-3 d-block mb-0" v-html="quote.text" />
        </div>
        <Dropzone :useCustomSlot="true" v-if="allowImageChange" @uploaded="fileUploaded" section="quote">
            <img v-if="quote.image" class="" :src="quote.image" width="250px"/>
        </Dropzone>
        <img v-else-if="quote.image" class="" :src="quote.image" width="250px"/>
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