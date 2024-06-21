<template>
    <div>
        <div class="bg-gray-800 pt-8 pb-20">
            <div class="w-9/12 text-center mx-auto mb-0">
                <h1 class="text-orange text-5xl p-10">Book Shop</h1>
                <p class="w-9/12 mx-auto mb-0 text-white">Cupcake ipsum dolor sit amet croissant. I love topping candy canes sweet roll croissant caramels. Soufflé macaroon liquorice chocolate tart I love.</p>
            </div>
        </div>
        <div class="w-3/5 text-left mx-auto pt-20 relative">
            <div class="absolute top-5 right-0">
                <input v-model="searchQuery" type="text" placeholder="Search by title" class="rounded-md border-gray-400 border p-2">
            </div>
            <table class="w-full text-left border-collapse mb-20">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="border border-white p-4">Title</th>
                        <th class="border border-white p-4">Author</th>
                        <th class="border border-white p-4">Rating</th>
                        <th class="border border-white p-4"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="book in filteredBooks" :key="book.id" class="bg-gray-200">
                        <td class="border border-white p-2">{{ book.title }}</td>
                        <td class="border border-white p-2">{{ book.author }}</td>
                        <td class="border border-white p-2">{{ book.rating }}</td>
                        <td class="border border-white p-2">
                            <div class="flex flex-col">
                                <a href="#" @click.prevent="editBook(book.id)" class="underline mb-1">Edit</a>
                                <a href="#" @click.prevent="deleteBook(book.id)" class="underline">Delete</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'BookListing',
    data() {
        return {
            searchQuery: '',
            books: []
        }
    },
    computed: {
        filteredBooks() {
            return this.books.filter(book => book.title.toLowerCase().includes(this.searchQuery.toLowerCase()));
        }
    },
    methods: {
        editBook(bookId) {
            this.$router.push({ name: 'EditBook', params: { bookId } });
        },
        deleteBook(bookId) {
            axios.delete(`/api/books/${bookId}`)
                .then(response => {
                    this.books = this.books.filter(book => book.id !== bookId);
                })
                .catch(error => {
                    //
                });
        }
    },
    mounted() {
        axios.get('/api/books')
            .then(response => {
                this.books = response.data.data;
            })
            .catch(error => {
                //
            });
    }
}
</script>
