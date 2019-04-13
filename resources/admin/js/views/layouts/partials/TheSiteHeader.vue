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
            <li>
                <a href="#" class="dropdown-item" @click.prevent="logout">
                    <i class="icon-fa icon-fa-sign-out"/> Logout
                </a>
            </li>
        </ul>
    </header>
</template>
<script type="text/babel">
    import Auth from '../../../services/auth'

    export default {
        methods: {
            onNavToggle() {
                this.$utils.toggleSidebar()
            },
            logout() {
                Auth.logout().then(() => {
                    this.$router.replace({name: 'login'})
                })
            }
        }
    }
</script>
