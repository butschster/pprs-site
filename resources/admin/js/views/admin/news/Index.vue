<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Новости</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Главная</li>
                <li class="breadcrumb-item">Новости</li>
            </ol>
            <div class="page-actions">
                <router-link :to="{name: 'news.create'}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Добавить
                </router-link>
            </div>
        </div>
        <VueElementLoading :active="loading"/>

        <div class="media bg-light shadow p-3 mb-4" v-for="post in news">
            <div class="media-body">
                <h5 class="mt-0"><router-link :to="{name: 'news.show', params: {id: post.id}}">{{ post.title }}</router-link></h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ post.created_at | moment("DD MMM YYYY") }} </h6>
                <div v-html="post.description"></div>
            </div>
        </div>

        <Pagination :data="pagination" @pagination-change-page="load" />
    </div>
</template>

<script>
    import VueElementLoading from 'vue-element-loading'
    import Pagination from 'laravel-vue-pagination'

    export default {
        components: {VueElementLoading, Pagination},
        data() {
            return {
                loading: false,
                news: [],
                pagination: {}
            }
        },
        mounted() {
            this.load()
        },
        methods: {
            async load(page = 1) {
                this.loading = true
                try {
                    const response = await axios.get('/api/news?page=' + page)
                    this.news = response.data.data
                    this.pagination = response.data
                } catch (e) {
                    console.error(e)
                }

                this.loading = false
            }
        }
    }
</script>