<template>
    <header class="site-header">
        <a
                href="#"
                class="nav-toggle"
                @click="onNavToggle"
        >
            <div class="hamburger hamburger--arrowturn">
                <div class="hamburger-box">
                    <div class="hamburger-inner"/>
                </div>
            </div>
        </a>
        <ul class="action-list">
            <li v-if="user">
                <v-dropdown :show-arrow="false">
                    <a
                            slot="activator"
                            href="#"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            class="avatar"
                    >
                        <img src="/admin/img/avatar.svg" alt="Avatar">
                        {{ user.name }}
                    </a>
                    <v-dropdown-item>
                        <a
                                href="#"
                                class="dropdown-item"
                                @click.prevent="logout"
                        >
                            <i class="fa fa-sign-out"/> Выход
                        </a>
                    </v-dropdown-item>
                </v-dropdown>
            </li>
        </ul>
    </header>
</template>
<script type="text/babel">
    import { mapGetters } from 'vuex'
    export default {
        methods: {
            onNavToggle() {
                this.$utils.toggleSidebar()
            },
            logout() {
                this.$store.dispatch('auth/logout',).then(() => {
                    this.$router.replace({name: 'login'})
                })
            }
        },
        computed: {
            ...mapGetters({
                user: 'auth/user'
            })
        }
    }
</script>
