<template>
    <nav aria-label="navigation" class="m-lg-4">
        <ul class="pagination justify-content-center">
            <li
                v-for="page in pages"
                class="page-item">
                <router-link
                    v-bind:to="page.href"
                    class="page-link"
                >{{ page.number }}</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['pages']
    }
</script>
