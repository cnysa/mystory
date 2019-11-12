<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="primary">
            <b-navbar-brand href="#">Url Shortener</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>
                    <b-nav-item><router-link to="/dashboard">Dashboard</router-link></b-nav-item>
                    <b-nav-item><router-link to="/statistics">Statistics</router-link></b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<style lang="scss" scoped>
    .nav-link {
        a {
            color: #ddd !important;
        }
        .router-link-exact-active {
            color: #fff !important;
        }
    }
</style>
