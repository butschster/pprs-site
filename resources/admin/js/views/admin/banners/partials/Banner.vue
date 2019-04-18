<template>
    <router-link :to="{name: 'banner.show', params: {id: banner.id}}" class="jumbotron rounded-0 top-banner mb-0" :style="bannerBackground">
        <div class="top-banner__container main-container">
            <div class="top-banner__text" v-html="banner.content"></div>
            <h1 class="top-banner__title">
                {{ sectionName }}
            </h1>
        </div>
    </router-link>
</template>

<script>
    export default {
        props: ['banner'],
        computed: {
            sectionName() {
                if (this.banner.page) {
                    return this.banner.page.title
                }

                return 'Section name'
            },
            bannerBackground() {
                if (this.banner.image_url) {
                    return {backgroundImage: `url('${this.banner.image_url}')`}
                }
            },
        }
    }
</script>