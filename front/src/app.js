import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import Messages from './components/Messages/Messages.vue';
import Form from './components/Form/Form.vue';

(function(){ "use strict";

    require('./app.scss');
    require.context('./components', true, /\.scss$/);

    Vue.use(VueRouter);

    const API_LIST = 'http://ibls/guestbook/list',
          API_ADD = 'http://ibls/guestbook/add',
          MESSAGES_PER_PAGE = 10
    ;

    new Vue({
        router: new VueRouter({
            routes: [
                { path: '/', component: Messages, props: {
                    API: API_LIST,
                    messagesPerPage: MESSAGES_PER_PAGE
                } },
                { path: '/p/:p', component: Messages, props: {
                    API: API_LIST,
                    messagesPerPage: MESSAGES_PER_PAGE
                } },
                { path: '/add', component: Form, props: { API: API_ADD } },
            ],
        }),
        render: h => h(App),
    }).$mount('#app');

}());
