<template>
    <div class="container">
        <h1 class="text-center">Guestbook: {{ title }}</h1>

        <router-view
                @onload="setTitle"
        ></router-view>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: '',
            }
        },

        methods: {
            setTitle(data) {
                this.title = data.title;
            }
        }
    }
</script>
