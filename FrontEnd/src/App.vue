<template>
  <ProductList v-if="inList" @onAdd="goToAdd()"/>
  <AddProduct v-if="!inList" @onSave="goToList()" />
</template>

<script>
import ProductList from '@/components/ProductList'
import AddProduct from '@/components/AddProduct'

export default {
  data(){
    return{
      inList: true
    }
  },
  name: 'App',
  components: {
    ProductList,
    AddProduct
  },
  methods: {
    goToAdd(){
      this.inList = false
    },

    goToList(){
      this.inList = true
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 20px;
}

.header {
  padding: 2% 1%
}

.content {
  width: 80%;
  margin: auto
}

h2 {
    float: left;
    margin: 0 10px;
}

.buttons {
    margin: 0 15px;
  float: right
}
button {
    margin: 0px 10px;
    padding: 5px 10px;
}

</style>
