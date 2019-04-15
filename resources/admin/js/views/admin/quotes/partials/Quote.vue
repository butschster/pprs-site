<template>
    <div class="d-flex shadow-lg bg-white rounded">
        <div class="border-right position-relative p-5 flex-grow-1" style="background-image: url('https://www.toptal.com/designers/subtlepatterns/patterns/arches.png')">
            <button type="button" class="btn position-absolute" v-clipboard:copy="code" style="top: 0; right: 0;" v-if="quote.id">
                <i class="fa fa-clipboard" aria-hidden="true"></i>
            </button>

            <div>
                <div class="mr-4"><i class="fa fa-3x fa-microphone" aria-hidden="true"></i></div>
                <router-link tag="a" class="lead mt-3 d-block mb-0" :to="{name: 'quote.show', params: {id: quote.id }}" v-html="quote.text" />
            </div>
        </div>
        <div v-if="quote.image" :style="{backgroundImage: `url(${quote.image})`, backgroundSize: 'cover', width: '250px'}"></div>
    </div>
</template>

<script>
    export default {
        props: ['quote'],
        computed: {
            code() {
                return `<quote :id="${this.quote.id}"></quote>`
            }
        }
    }
</script>