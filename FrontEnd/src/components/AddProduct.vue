<template>

  <div class="content">
    <div class="header">
      <h2>Product Add</h2>
      <div class="buttons">
        <button @click="save">Save</button>
        <button @click="cancelAdd">Cancel</button>
      </div>
    </div>
    <div class="separator"></div>

    <div class="form" id="product_form">
      <div class="field" >
        <label> SKU </label>
        <input required type="text" id="sku" v-model="sku" />
      </div>
      <div class="field" >
        <label> Name </label>
        <input required type="text" id="name" v-model="name" />
      </div>
      <div class="field" >
        <label> Price ($) </label>
        <input required type="number" id="price"   v-model="price" />
      </div>
      <div class="field" >
        <label>Type </label>
        <select v-model="type" id="productType" @change="displayForm()">
          <option > Type Switcher </option>
          <option value="DVD"> DVD </option>
          <option value="Book"> Book </option>
          <option value="Furniture"> Furniture </option>
        </select>
      </div>

      <div v-if="selected" class="form">
        <div v-show="type == 'DVD'">
          <div class="field" >
            <label> Size: </label>
            <input type="number" id="size" v-model="value" />
            
          </div>
        </div>

        <div v-show="type == 'Book'">
          <div class="field" >
            <label> Weigth: </label>
            <input type="number" id="weight" v-model="value" />
            
          </div>
        </div>

        <div v-show="type == 'Furniture'">
          <div class="field"  >
            <label> length: </label>
            <input type="number" id="length" v-model="length" />
          </div>
          <div class="field" >
            <label> width: </label>
            <input type="number" id="width" v-model="width" />
          </div>
          <div class="field" >
            <label> height: </label>
            <input type="number" id="height" v-model="heigth"  />
          </div>
        </div>
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
      selected: false,
    };
  },
  mounted: function() {},

  methods: {
    save() {
      this.$emit("onSave");
      this.addProduct();
    },

    cancelAdd() {
      this.$emit("onSave");
    },

    getValue() {
      if (this.type == "Furniture")
        this.value = `${this.heigth}X${this.width}X${this.length}`;

      return this.value;
    },

    displayForm() {
      this.selected = false;
      this.selected = true;
    },

    addProduct() {
      axios.post(
        "https://pr0ductlist.000webhostapp.com/BackEnd/api/create_products.php",
        {
          sku: this.sku,
          name: this.name,
          price: this.price,
          type: this.type,
          value: this.getValue(),
        }
      );
    },
  },
};
</script>

<style>
.form {
  margin-top: 15px;
}
label,
input {
  margin: 1%;
  display: inline;
}

.field {
  display: flex;
  justify-content: space-between;
  width: 300px;
  text-align: left;
}

select {
  padding: 3px 40px;
}
</style>