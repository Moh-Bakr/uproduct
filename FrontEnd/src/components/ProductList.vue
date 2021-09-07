<template>
  <div class="content">
    <div class="header">
      <h2>Product List</h2>
      <div class="buttons">
        <button @click="add">ADD</button>
        <button @click="deleteAll">MASS DELETE</button>
      </div>
    </div>
    <div class="separator"></div>

    <div class="list" v-for="product in products.body" :key="product.sku">
      <div class="product">
        <input type="checkbox" @change="addToDelete(product.ID)" />
        <p>{{ product.SKU }}</p>
        <p>{{ product.Name }}</p>
        <p>{{ product.Price }} $</p>

        <p>
          <span v-if="product.Type == 'DVD'"> Size: </span>
          <span v-else-if="product.Type == 'Book'"> Weigth: </span>
          <span v-else> Dimension: </span>
          <span> {{ product.Value }}</span>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      products: "",
      forDeleteItems: new Set(),
    };
  },

  mounted: function() {
    axios
      .get("https://pr0ductlist.000webhostapp.com/BackEnd/api/get_products.php")
      .then((response) => {
        this.products = response.data;
      });
  },

  methods: {
    add() {
      this.$emit("onAdd");
    },

    addToDelete(id) {
      this.forDeleteItems.has(id)
        ? this.forDeleteItems.delete(id)
        : this.forDeleteItems.add(id);
    },

    deleteAll() {
      this.forDeleteItems.forEach((item) => {
        axios.post(
          "https://pr0ductlist.000webhostapp.com/BackEnd/api/delete_products.php",
          {
            id: item,
          }
        );
      });
    },
  },
};
</script>

<style>
.header {
  padding: 2% 1%;
}

.content {
  width: 80%;
  margin: auto;
}

h2 {
  float: left;
  margin: 0 10px;
}

.buttons {
  margin: 0 15px;
  float: right;
}
button {
  margin: 0px 10px;
  padding: 5px 10px;
}

.separator {
  display: block;
  background: gray;
  height: 3px;
  margin: 20px auto;
}

.list {
  margin: auto;
}
.product {
  border: 1px solid gray;
  float: left;
  width: 20%;
  margin: 10px 1.5%;
}

input[type=checkbox] {
  float: left;
  margin: 4%;
}
</style>