<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Баннеры</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">Баннеры</li>
            </ol>
        </div>
        <VueElementLoading :active="loading"/>

        <div class="d-flex flex-wrap">
            <div class="col-12 mb-5" v-for="banner in banners">
                <Banner :banner="banner" :allowResize="false"/>
            </div>
        </div>
    </div>
</template>

<script>
    import VueElementLoading from 'vue-element-loading'
    import Banner from './partials/Banner'

    export default {
        components: {VueElementLoading, Banner},
        data() {
            return {
                loading: false,
                banners: []
            }
        },
        mounted() {
            this.load()
        },
        methods: {
            async load() {
                this.loading = true
                try {
                    const response = await axios.get('/api/banners')
                    this.banners = response.data.data
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            }
        }
    }
</script>