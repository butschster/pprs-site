<template>
    <div class="d-flex shadow-lg bg-white align-items-stretch rounded my-5" v-if="loaded">
        <div class="border-right p-5"
             style="background-image: url('https://www.toptal.com/designers/subtlepatterns/patterns/arches.png')">
            <div><i class="fas fa-3x fa-microphone-alt"></i></div>
            <h5 class="mt-4 mb-0">{{ text }}</h5>
        </div>
        <img class="bd-placeholder-img" height="250px" :src="image"/>
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
                    const response = await axios.get(this.route('api.quote.show', {quote: this.id}));
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
