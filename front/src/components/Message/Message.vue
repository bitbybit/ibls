<template>
    <div class="alert alert-warning message">
        <h3>
            <a :href="'mailto:' + email" v-if="email" class="alert-link">{{ name }}</a>
            <span v-else>
                {{ name }}
            </span>
        </h3>
        <div class="message__text">{{ text }}</div>
    </div>
</template>

<script>
    export default {
        props: ['name', 'email', 'text']
    }
</script>
