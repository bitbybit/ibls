<template>
    <div>
        <div class="text-center">
            <router-link
                to="/add"
                class="btn btn-lg btn-success m-lg-4">
                Add message
            </router-link>
        </div>

        <div>
            <message
                    v-for="message in messages"
                    v-bind:name="message.name"
                    v-bind:email="message.email"
                    v-bind:text="message.message"
                    v-bind:date="message.date.date"
                    v-bind:key="message.id"
            ></message>
        </div>

        <pagination
                v-bind:pages="pages"></pagination>
    </div>
</template>

<script>
    import Message from '../Message/Message.vue'
    import Pagination from '../Pagination/Pagination.vue'
    import HTTP from '../../HTTP';

    export default {
        props: ['API', 'messagesPerPage'],

        data() {
            return {
                messages: [],
                pages: [],
            }
        },

        components: {
            Message,
            Pagination
        },

        methods: {
            onload: function(page = 1) {
                this.$emit('onload', {
                    title: `List Messages: page ${page}`
                });

                const limit = this.messagesPerPage,
                      offset = (page - 1) * this.messagesPerPage
                ;

                HTTP.get(this.API, { limit, offset }, (status, data) => {
                    this.messages = data.messages;
                    this.pages = [];

                    for(let i = this.messagesPerPage; i < data.count + this.messagesPerPage; i = i + this.messagesPerPage) {
                        const page = i / this.messagesPerPage;

                        this.pages.push({
                            number: page,
                            href: `/p/${page}`
                        });
                    }
                });
            }
        },

        created: function() {
            this.onload(this.$route.params.p);
        },

        watch: {
            $route(to, from) {
                if (from.params.p !== to.params.p) {
                    this.onload(to.params.p);
                }
            }
        }
    }
</script>
