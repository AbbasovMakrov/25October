<template>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <router-link class="navbar-brand" to="/">Iraq Protests Chat</router-link>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" v-if="!this.isAuth">
                        <router-link class="btn btn-primary my-1 btn-block" :to="{name:'login'}"
                        >Login</router-link>
                    </li>
                    <li class="nav-item" v-if="this.isAuth">
                        <button
                            @click.prevent=""
                            class="btn btn-warning my-1 btn-block"
                        >
                            Logout
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "Navbar",
        computed:{
            isAuth(){
                return this.$store.state.isAuth;
            }
        }
    }
</script>
