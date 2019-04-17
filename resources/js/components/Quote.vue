<template>
    <div class="my-5 quote" v-if="loaded">
        <div class="px-3 py-4 quote__text mw-50 px-0 col-12 col-lg-6">
            <div><i class="fas fa-3x fa-microphone-alt text-secondary mb-4"></i></div>
            <h5>{{ text }}</h5>
            <a href="#">ссылка</a>
        </div>
        <div class="quote__img d-none d-md-block px-0 col-6">
            <img height="360" width="560" :src="image"/>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        props: {
            id: {
                required: true,
                type: Number
            }
        },
        data() {
            return {
                loaded: false,
                image: null,
                text: null,
                title: null
            }
        },
        mounted() {
            this.load()
        },
        methods: {
            async load() {
                try {
                    const response = await axios.get(`/api/quote/${this.id}/cached`);
                    this.image = response.data.data.image
                    this.text = response.data.data.text
                    this.title = response.data.data.title
                    this.loaded = true
                } catch (e) {
                    console.log(e)
                }
            }
        }
    }
</script>
