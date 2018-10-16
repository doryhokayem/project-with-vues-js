<template> 
    <form method="POST" action="/products" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        <div class="control">
            <label for="name" class="label">Product Name:</label>
            <input type="text" id="name" name="name" class="input" v-model="form.name" required> 
            <span class="help is-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
        </div>
        <div class="control">
            <label for="description" class="label">Product Description:</label>
            <input type="text" id="description" name="description" class="input" v-model="form.description" required>
            <span class="help is-danger" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
        </div>
        <div class="control">
            <label for="price" class="label">Product Price:</label>     
            <input type="text" id="price" name="price" class="input" v-model="form.price" required>
            <span class="help is-danger" v-if="form.errors.has('price')" v-text="form.errors.get('price')"></span>
        </div>
        <div class="control">
            <label for="active" class="label">Product Active:</label>
            <input type="checkbox" id="active" name="active" class="active" v-model="form.active">
            <span class="help is-danger" v-if="form.errors.has('active')" v-text="form.errors.get('active')"></span>
        </div>
        <div class="control">
            <label for="URL" class="label">Product URL:</label>
            <input type="text" id="URL" name="URL" class="input" v-model="form.URL" required>
            <span class="help is-danger" v-if="form.errors.has('URL')" v-text="form.errors.get('URL')"></span>
        </div>
        <div class="control">
          <label for="category" class="label">Product Category:</label>
          <select v-model="form.selectedCategory">
            <option value="-1" selected disabled>Choose a category</option>
            <option v-for="category in categories" v-text="category.name" :key="category.id" :value="category.id" ></option>
          </select>
          <hr>
          <span class="help is-danger" v-if="form.errors.has('category')" v-text="form.errors.get('category')"></span>
        </div>
        <div class="control">
            <button class="button is-primary" :disabled="form.errors.any()">Create</button>
        </div>
    </form>
</template>

<script>
export default {
  props: [],
  data() {
    return {
      form: new Form({
        name: "",
        description: "",
        price: "",
        URL: "",
        active:"",
        selectedCategory:-1
      }),
      categories: [],
      
    };
  },
  mounted() {
    this.init();
  },
  methods: {
    init() {
      this.fetchCategories();
    },
    onSubmit() {
      this.form
        .post("/products")
        .then(response => alert("Success"))
        .catch(error => {
          console.log(error.response.data);
        });
    },
    fetchCategories() {
      axios
        .get("/api/categories")
        .then(response => {
          this.categories = response.data;
        })
        .catch(error => {
          this.categories = [];
        });
    }
  },
  computed: {
    //
  },
  watch: {
    //
  }
};
</script>
