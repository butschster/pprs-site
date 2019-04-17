<template>
    <div class="d-flex bg-white my-5 quote" v-if="loaded">
        <div class="border-right px-3 py-4 quote__text mw-50 px-0 col-12- col-lg-6"
             style="background-image: url('https://www.toptal.com/designers/subtlepatterns/patterns/arches.png')">
            <div><i class="fas fa-3x fa-microphone-alt text-secondary"></i></div>
            <h5 class="mt-4 mb-0">{{ text }}</h5>
            <a href="#" class="text-decoration text-black">ссылка</a>
        </div>
            <img class="bd-placeholder-img d-none d-lg-block px-0 col-6" height="360" width="560" :src="image"/>
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
