<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Цитаты</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">Цитаты</li>
            </ol>
            <div class="page-actions">
                <router-link :to="{name: 'quote.create'}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Добавить
                </router-link>
            </div>
        </div>
        <VueElementLoading :active="loading"/>

        <div class="d-flex flex-wrap">
            <div class="col-12 mb-5" v-for="quote in quotes">
                <Quote :quote="quote" :allowResize="false"/>
            </div>
        </div>
    </div>
</template>

<script>
    import VueElementLoading from 'vue-element-loading'
    import Quote from './partials/Quote'

    export default {
        components: {VueElementLoading, Quote},
        data() {
            return {
                loading: false,
                quotes: []
            }
        },
        mounted() {
            this.load()
        },
        methods: {
            async load() {
                this.loading = true
                try {
                    const response = await axios.get('/api/quotes')
                    this.quotes = response.data.data
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            }
        }
    }
</script>