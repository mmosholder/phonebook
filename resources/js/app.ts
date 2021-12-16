require('./bootstrap');
import Vue from 'vue';
import VueApollo from 'vue-apollo';
import ApolloClient from 'apollo-boost';
import VueTelInput from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';

import App from './global/App.vue';

let apolloClient;
if (process.env.NODE_ENV == 'local') {
    apolloClient = new ApolloClient({
        uri: 'http://localhost:3002/graphql',
    });
}
else if (process.env.NODE_ENV == 'production') {
    apolloClient = new ApolloClient({
        uri: 'http://phonebookit.herokuapp.com/graphql',
    });
}

const apolloProvider = new VueApollo({
    defaultClient: apolloClient,
});

Vue.use(VueApollo);
Vue.use(VueTelInput);

new Vue({
    el: '#app',
    // inject apolloProvider here like vue-router or vuex
    apolloProvider,
    render: h => h(App),
});
