<template>
    <div id="app">
        <div class="alert alert-danger">
            <ul v-bind:key="key" v-for="(key,index,value) in getErrors">
                <li>{{value}}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Errors",
        props:{
            errors:Object
        },
        computed:{
            getErrors(){
                return Object.values(this.errors).flat();
            }
        }
    }
</script>

