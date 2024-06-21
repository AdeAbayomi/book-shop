import Vue from 'vue';
import Router from 'vue-router';
import BookListing from '../components/BookListing.vue';
import EditBook from '../components/EditBook.vue';

Vue.use(Router);

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'BookListing',
            component: BookListing
        },
        {
            path: '/edit/:bookId',
            name: 'EditBook',
            component: EditBook,
            props: true
        }
    ]
});

export default router;
