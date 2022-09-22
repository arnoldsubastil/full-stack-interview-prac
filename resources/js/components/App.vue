<script>
// give each todo a unique id
let id = 0
import axios from "axios"
export default {
  data() {
    return {
      products: [],
      resultOutput: '',
      newProduct : '',
      newTag: ''

    }
  },
  methods: {
    addProduct() {
        axios.post('http://127.0.0.1:8000/api/add-product', {
                    name: this.newProduct,
                    tags: this.newTag,
                })
        .then(response => console.log(response))
        .catch(error => console.log(error));
        
        this.getAllData();

    },
    removeProduct(product) {
        axios.delete('http://127.0.0.1:8000/api/delete-product?id=' + product)
        .then(response => console.log(response))
        .catch(error => console.log(error));
        
        this.getAllData();
    },
    async getAllData() {
        let result = await axios.get('http://127.0.0.1:8000/api/products-list');
        console.log(result.data);
        this.products = result.data;
    }
  },
 async mounted() {
    this.getAllData();
  }
}
</script>

<template>

<div class="panel inputForm">
  <form @submit.prevent="addProduct">
   <div class="inputtext"> <input class="inputtexttype" v-model="newProduct"></div>
   <div class="inputtext"> <input class="inputtexttype" v-model="newTag"> </div>
    <button>Add Product</button>    
  </form>
</div>
<div class="panel theList">
  <table id="productlist">
    <tr>
        <th>Product ID</th>
        <th>Product Detail</th>
        <th>Action</th>
    </tr>
    <tr v-for="product in products" :key="product.id">
        <td>{{ product.id }}</td>
        <td>
            <div class="productTitle">{{ product.name }}</div>
            <div class="productTags"> {{ product.taglist }}</div>
        </td>
        <td><button class="exbutton" @click="removeProduct(product.id)">X</button></td>
    </tr>
  </table>
</div>
</template>

<style>
 #productlist {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
#productlist th:first-child {
    width: 94px;
}
#productlist th:nth-child(3) {
    width: 94px;
}
#productlist td, #productlist th {
  border: 1px solid #ddd;
  padding: 8px;
}

#productlist tr:nth-child(even){background-color: #f2f2f2;}

#productlist tr:hover {background-color: #ddd;}

#productlist th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #050142;
  color: white;
}

.productTitle {
    font-size: 20px;
    font-family: arial;
    font-weight: bold;
}

button, select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button {
  width: 150px;
  background-color: #050142;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #090363;
}

.panel {
    width: 48%;
    display: inline-block;
    vertical-align: top;
}

.inputForm{
    width: 28%;
    text-align: right;
    margin-right: 33px;
}

.theList{
    width: 68%;
}

.inputText {
    width: 90%;
    position: relative;
}

.inputtexttype {
    width: 97%;
    border-radius: 5px;
    height: 20px;
    margin: 3px 0px;
    padding: 5px;
}

.exbutton {
    width: 50px;
    height: 50px;
    background: #902626;
}

</style>