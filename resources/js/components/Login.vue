<template>
    <div id="app">
        <div class="container">
            <div class="col-md-6 offset-md-3">
                <h2 class="display-4 text-center mt-5">Login To Dashboard</h2>
                <Errors :errors="errors" v-if="errors !== {}"/>
                <form method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="email">Name</label>
                        <input
                            type="text"
                            v-model="user.name"
                            name="name"
                            class="form-control"
                            id="email"
                        />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            v-model="user.password"
                            name="password"
                            class="form-control"
                            id="password"
                        />
                    </div>
                    <div class="from-group">
                        <button
                            @click.prevent="Login"
                            class="btn btn-success btn-block"
                        >
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from "./Errors";
    export default {
        name: "Login",
        data(){
            return {
                user:{
                    name:"",
                    password:""
                },
                errors:{}
            }
        },
        components:{
          Errors
        },
        methods:{
            Login() {
                this.$store.dispatch('attemptLogin',this.user).then(response => {
                    this.$router.push('/dashboard');
                }).catch(errors => this.errors = errors);
            }
        }
    }
</script>

<style scoped>

</style>
