<template>
    <div>
        <VueCkeditor :config="config"
                     :value="value"
                     @input="onChange"/>
    </div>
</template>

<script>
    import VueCkeditor from 'vue-ckeditor2'
    import { mapGetters } from 'vuex'

    export default {
        components: {VueCkeditor},
        props: {
            value: {
                required: true
            },
            height: {
                type: Number,
                default() {
                    return 100
                }
            },
            bodyClass: {
                type: String,
                required: false,
                default() {
                    return 'article-text ckeditor'
                }
            },
            toolbar: {
                type: String,
                required: false,
                default() {
                    return 'default'
                }
            }
        },
        data() {
            return {
                content: '',
                config: {
                    bodyClass: "",
                    language: 'ru',
                    extraPlugins: 'embed,autoembed',
                    contentsCss: [
                        '/css/app.css'
                    ],
                    stylesSet: [
                        {name: 'Title', element: 'h1', attributes: {class: 'article-text__title'}},
                        {name: 'Banner strong', element: 'div', attributes: {class: 'top-banner__strong'}},
                        {name: 'Banner small', element: 'div', attributes: {class: 'top-banner__small'}},

                    ],
                    format_tags: 'p;h2;h3;h4;h5;h6',
                    embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
                    image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
                }
            }
        },
        created() {
            this.config.height = this.height
            this.config.bodyClass = this.bodyClass
            this.config.filebrowserImageBrowseUrl = `/${FILES_PATH}?type=Images&token=${this.token}`
            this.config.filebrowserImageUploadUrl = `/${FILES_PATH}/upload?type=Images&token=${this.token}`
            this.config.filebrowserBrowseUrl = `/${FILES_PATH}?type=Files&token=${this.token}`
            this.config.filebrowserUploadUrl = `/${FILES_PATH}/upload?type=Files&token=${this.token}`

            this.config = Object.assign(this.config, this.style)
        },
        methods: {
            onChange(value) {
                this.$emit('input', value)
            }
        },
        computed: {
            ...mapGetters({
                token: 'auth/token'
            }),
            style() {
                switch (this.toolbar) {
                    case 'minimal':
                        return {
                            toolbarGroups: [
                                {name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing']},
                                {name: 'links', groups: ['links']},
                                {name: 'insert', groups: ['insert']},
                                {name: 'forms', groups: ['forms']},
                                {name: 'tools', groups: ['tools']},
                                {name: 'document', groups: ['mode', 'document', 'doctools']},
                                {name: 'others', groups: ['others']},
                                {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
                                {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']},
                                {name: 'styles', groups: ['styles']},
                                {name: 'colors', groups: ['colors']}
                            ],
                            removeButtons: 'Underline,Subscript,Superscript,Undo,Redo,Cut,Copy,Scayt,Anchor,Table,HorizontalRule,SpecialChar,Source,Strike,Outdent,Indent,Styles,Format,About'
                        }
                }

                return {}
            }
        }
    }
</script>