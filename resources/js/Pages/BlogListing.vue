<!-- resources/js/Pages/Blog/Index.vue -->
<template>
    <AuthenticatedLayout></AuthenticatedLayout>
    <br>
        <div class="flex items-center justify-center mt-4">
            <Link
            :href="route('blog.create')"
            class=" text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >Create Blog
            </Link>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <Link
                :href="route('blog.index')"
                class=" text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Check Blog List
            </Link>

           
        </div>
    <br>

    <center>
        <div>
            <h2 style="font-size: 40px;font-weight: 600;">Blog Posts</h2>
            
            <!-- <form @submit.prevent="searchPosts" class="search-form">
            <input v-model="searchTerm" type="text" placeholder="Search by title...">
            <button type="submit">Search</button>
            </form> -->
            <form @submit.prevent="searchPosts" class="search-form">
            <input v-model="searchTerm" type="text" placeholder="Search by title...">
            <button type="submit">Search</button>
            </form>
            

            <div v-for="post in blogPosts.data" :key="post.id" class="post">
                <img style="height: 200px;" v-if="post.image" :src="'/storage/' + post.image" alt="Blog Post Image">
                <h3>Post title: {{ post.title }}</h3>
                <p>Author: {{ post.user.name }}</p> 
                <p>Content: {{ post.content }}</p>
                
            </div>
            
        
            <div class="pagination">
                <ul>
                    <Link
                    v-for="page in blogPosts.links" :key="page.url" :href="page.url"
                    >
                    <span style="margin: 30px 50px; color: blue;">{{ cleanPaginationLabel(page.label) }}</span>
                    </Link>
                </ul>
            </div>
        </div>
    </center>
  </template>
  
  <script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

  export default {
    layout: AuthenticatedLayout,
    components: { Link },
    props: {
        blogPosts: Array,
    },
    data() {
        return {
        searchTerm: '',
        };
    },
    //remove &laquo; &raquo; from pagination
    methods: {
        cleanPaginationLabel(label) {
        return label.replace(/&laquo;|&raquo;/g, '');
        },
        //search by title
        searchPosts() {
        this.$inertia.get(route('blog.index', { search: this.searchTerm }));
        },
    },
    
    };
  </script>
  
  <style>
  .post {
    margin: 20px 0;
    border: 1px solid #ccc;
    padding: 10px;
  }
  
  .pagination {
    margin-top: 20px;
  }

  .search-form {
  display: flex;
  width: 50%;
  align-items: center;
  margin-top: 20px;
}

.search-form input[type="text"] {
  flex: 1;
  
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px 0 0 5px;
}

.search-form button {
  padding: 10px 15px;
  background-color: #3490dc;
  color: white;
  border: none;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.search-form button:hover {
  background-color: #2779bd;
}
  </style>
  