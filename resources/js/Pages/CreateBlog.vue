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
      <h1 class="form-title">Create Blog</h1>
      <div class="form-container">
        <form @submit.prevent="submitForm" class="blog-form">
          <label for="title">Title:</label>
          <input v-model="form.title" type="text" id="title" required>
          
          <label for="content">Content:</label>
          <textarea v-model="form.content" id="content" required></textarea>
          <div class="character-count">{{ characterCount }} characters</div>
          
          <label for="image">Image</label>
          <input type="file" ref="image" @change="handleImageUpload">
          
          <button type="submit">Create Post</button>
        </form>
      </div>
          
        </center>
  </template>
  
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';


  export default {
    layout: AuthenticatedLayout,
    components:{
      Link
    },
    data() {
      return {
        form: {
          title: '',
          content: '',
          image: null,
          
        }
      };
    },

    computed: {
      //function to count the number of characters in the content field
        characterCount() {
        return this.form.content.length;
        },
        
    
    },

    methods: {
      //function to handle image upload
        handleImageUpload(event) {
        this.form.image = event.target.files[0];
      },
      //function to submit form
      submitForm() {
        const formData = new FormData();
        formData.append('title', this.form.title);
        formData.append('content', this.form.content);
        if (this.form.image) {
          formData.append('image', this.form.image);
        }
        // Submit form
        this.$inertia.post('/submit-blog', formData);
        // Redirect or display success message
      },
     
    }
  };
</script>

<style>
.form-title {
  font-weight: 600;
  font-size: 40px;
  margin-bottom: 20px;
}

.form-container {
  margin-top: 20px;
}

.blog-form label {
  font-size: 17px;
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

.blog-form input[type="text"],
.blog-form textarea,
.blog-form input[type="file"] {
  width: 35%;
  height: 40px;
  padding: 5px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.blog-form textarea {
  height: 100px;
}

.character-count {
  margin-top: 5px;
  font-size: 13px;
  color: #666;
}

.blog-form button {
  border: none;
  padding: 10px 15px;
  background-color: #3490dc;
  color: white;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.blog-form button:hover {
  background-color: #2779bd;
}
</style>

  