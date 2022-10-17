<template>
  <div>
    <div class="row">
      <router-link to="/storeproduct" class="btn btn-primary">Add Product</router-link>

    </div>
  </div>
    <div>
    <br>
    <input type="text" class="form-control" v-model="FiltersearchTerm" style="width:300px;" placeholder="Search Here">
    <br>
         <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th style="width:10%">Product Name</th>
                        <th style="width=20%">Product Code</th>
                        <th style="width=10%">root</th>
                        <th style="width=10%">Categorie</th>
                        <th style="width=10%">buying_price</th>
                         <th style="width=10%">selling_price</th>
                         <th style="width=10%">photo</th>
                        <th style="width=20%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filtersearch" :key="product.id">
                        <td>{{product.product_name}}</td>
                         <td>{{product.product_code}}</td>
                         <td>{{product.root }}</td>
                         <td>{{product.categorie_name}}</td>
                          <td>{{product.buying_price}}</td>
                           <td>{{product.selling_price }}</td>
                        <td><img :src="product.image" id="photo"></td>
                     
                       
                        <td style="display:inline m-t:10">
                          <router-link :to="{name:'editProduct' , params:{id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                           <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger" id="delete">Delete</a>
                        </td>
                        
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
    </div>
</template>
<script>
 import axios from 'axios'
export default {
  created(){
    if(!User.loggedIn())
    {
        this.$router.push({name:'login'})
    }
  },
  data(){
    return{
      products:[],
      FiltersearchTerm:''
    }
  },
  computed:{
    filtersearch(){
      return this.products.filter(
        product=>{
            return product.product_name.match(this.FiltersearchTerm)
        }
      )
    }

  },
  methods:{
    allProduct(){
      axios.get('/api/product/')
      .then(({data})=>(this.products=data))
      .catch()
    },
    deleteProduct(id){
      Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
     confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
      axios.delete("/api/product/"+id)
      .then(
        this.products=this.products.filter(product=>{
          return product.id!=id
        })
      )
      .catch(()=>{
        this.$router.push({name:'indexProduct'})
      })
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
      )
     }
  })

    }
  },
  created(){
    this.allProduct();
  }

 
  
}
</script>
<style scoped>
#photo{
  height:40px;
  width:40px;
}
td #delete{
  margin-left: 5px!important;
  cursor:pointer;
  color:white;
} 
#ac{
  margin-top: 5px!important;
}

</style>