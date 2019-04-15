<template>
    <div>
        <slot></slot>
        <small class="help-block text-danger" v-for="error in errors">
            {{ error }}
        </small>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        props: {
            container: {
                type: String,
                default() {
                    return 'default'
                }
            },
            field: String
        },
        watch: {
            $validationErrors() {
                console.log('changed')
            }
        },
        computed: {
            ...mapGetters('validation', {
                validationErrors: 'getErrors',
            }),

            hasErrors() {
                return _.size(this.errors) > 0
            },
            errors() {
                return _.get(this.validationErrors, this.field, [])
            }
        }
    }
</script>