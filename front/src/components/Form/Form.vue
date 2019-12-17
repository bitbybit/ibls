<template>
    <form @submit="sendMessage">
        <div class="alert alert-danger" v-if="error">
            {{ error }}
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" v-model="name" class="form-control" id="name" placeholder="Name" required>
        </div>

        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" v-model="email" class="form-control" id="email" placeholder="Email">
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea v-model="message" class="form-control" id="message" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg" value="Send message">
        </div>
    </form>
</template>

<script>
    import HTTP from '../../HTTP';

    export default {
        props: ['API'],

        data() {
            return {
                name: '',
                email: '',
                message: '',
                error: '',
            }
        },

        methods: {
            onload: function() {
                this.$emit('onload', {
                    title: 'Add new message'
                });
            },

            sendMessage: function(e) {
                e.preventDefault();

                this.error = '';

                HTTP.post(this.API, {
                    name: this.name,
                    email: this.email,
                    message: this.message,
                }, (status, data) => {
                    if (data.result !== 'ok') {
                        this.error = 'Message was not send.'
                    } else {
                        location.href = '/';
                    }
                });
            }
        },

        created: function() {
            this.onload();
        },

        watch: {
            $route(to, from) {
                this.onload();
            }
        }
    }
</script>
