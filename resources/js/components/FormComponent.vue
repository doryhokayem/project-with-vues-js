 <template>
 
 <form method="POST" action="/products" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
         @csrf
            <div class="control">
                <label for="name" class="label">Product Name:</label>
                
                <input type="text" id="name" name="name" class="input" v-model="form.name"> 

                <span class="help is-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
            </div>

            <div class="control">
                <label for="description" class="label">Product Description:</label>
                
                <input type="text" id="description" name="description" class="input" v-model="form.description">

                <span class="help is-danger" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
            </div>

            <div class="control">
                <label for="price" class="label">Product Price:</label>
                
                <input type="text" id="price" name="price" class="input" v-model="form.price">

                <span class="help is-danger" v-if="form.errors.has('price')" v-text="form.errors.get('price')"></span>
            </div>

            <div class="control">
                <label for="URL" class="label">Product URL:</label>
                
                <input type="text" id="URL" name="URL" class="input" v-model="form.URL">

                <span class="help is-danger" v-if="form.errors.has('URL')" v-text="form.errors.get('URL')"></span>
            </div>

            <div class="control">
                <button class="button is-primary" :disabled="form.errors.any()">Create</button>
            </div>
        </form>
             
 </template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
