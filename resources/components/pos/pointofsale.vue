<template>
        <div>
            <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">POS</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
          
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
                  <a href="#" class="btn btn-sm btn-info" style="font-color:#fff;">Add Customer</a>
                </div>
                
                <div class="table-responsive" style="font-size:12px;" >
                  <table class="table align-items-center table-flush" :key="componentKey" >
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody >
                      <tr v-for="cart in carts" :key="cart.id">
                        <td>{{cart.pro_name}}</td>
                        <td>
                          <input type="text" readonly="" :key="cart.id" style="width:15px;" :value="cart.pro_quantity">
                          <button class="btn btn-success" style="width:1px;  margin-left:1px; ">+</button>
                          <button class="btn btn-danger" style="width:1px; margin-left:3px">-</button>
                        </td>
                        <td>{{cart.pro_price}}</td>
                        <td><span class="badge badge-success">{{cart.sub_total}}</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary" >X</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-item-center">
                          Total Quantity:
                          <strong>56</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-item-center">
                          Sub Total:
                          <strong>562$</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-item-center">
                          Vat:
                          <strong>35%</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-item-center">
                          Total:
                          <strong>5456$</strong>
                        </li>
                    </ul>
                    <br>
                    <form>
                          <label>Customer</label>
                          <select class="form-control" v-model="customer_id">
                            <option  v-for="customer in customers"> {{customer.name}} </option>
                          </select>
                          <label>
                            Pay
                          </label>
                          <input type="text" class="form-control" required="" v-model="pay">
                          <label>
                            Due
                          </label>
                          <input type="text" class="form-control" required="" v-model="due">
                            <label>Pay Bye</label>
                          <select class="form-control" v-model="paybye">
                            <option value="Hand cash"> Hand cash </option>
                             <option value="Cheaque"> Cheaque </option>
                              <option value="Gift Card"> Gift Card </option>
                          </select>
                          <br><br>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>

                </div>
              </div>
            </div>

            <!-- Pie Chart -->
                 <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                  </div>

   <!--  Category Wise Product -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product </a>
  </li>
  

  <li class="nav-item" v-for="category in categories" :key="category.id">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="gettingproduct(category.id)">{{ category.categorie_name}}</a>
  </li>


   
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

<div class="card-body">
 <input type="text" v-model="FiltersearchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">

     <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filtersearch" :key="product.id"  >
             <button class="btn btn-sm" @click.prevent="AddToCart(product.id)" :key="componentKey" >
             <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
              <img :src="product.image" id="em_photo" class="card-img-top">
              <div class="card-body">
                <h6 class="card-title">{{ product.product_name }}</h6>
             <span class="badge badge-success" v-if="product.product_quantié >= 1 ">Available {{ product.product_quantié }}  </span> 
                <span class="badge badge-danger" v-else=" ">Stock Out </span> 
                
              </div>
            </div></button>
          
        </div>        
      </div>

     </div>
    


  </div>  <!--  End TBAS HOME -->



 

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


<input type="text" v-model="getsearchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">

     <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getproductfiltersearch" :key="getproduct.id">
            <button class="btn btn-sm">
             <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
              <img :src="getproduct.image" id="em_photo" class="card-img-top">
              <div class="card-body">
                <h6 class="card-title">{{ getproduct.product_name}}</h6>
                <span class="badge badge-success" v-if="getproduct.product_quantié  >= 1 ">Available {{ getproduct.product_quantié }}  </span> 
               <span class="badge badge-danger" v-else=" ">Stock Out </span>    
      </div>
      </div>
       </button>
          
        </div>        
      </div>




  </div>
  
</div>
              <!-- End Category Wise Product -->



            
              </div>
            </div>
            <!-- Invoice Example -->
          
            <!-- Message From Customer-->
          </div>
          <!--Row-->

        
          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>
      
        </div>
        </div>
</template>
<script>
 import axios from 'axios';
 import { ref } from 'vue';
const componentKey = ref(0);
 
export default {
  created(){
    if(!User.loggedIn())
    {
        this.$router.push({name:'login'})
    }
   
  },
  
  
   created(){
    this.allProduct();
    this.allCategory();
    this.allcustomers();
    this.cartProduct();
    },
 
  mounted() {
            this.AddToCart();
        },


  data(){
    return{
      products:[],
      categories:'',
      getproducts:[],
      FiltersearchTerm:'',
      getsearchTerm:'',
      customers:'',
      errors:'',
      carts:[],
      componentKey: 0,
    }
  },
  
  computed:{
    filtersearch(){
      return this.products.filter(
        product=>{
            return product.product_name.match(this.FiltersearchTerm)
        }
      )
    },
      getproductfiltersearch(){
      return this.getproducts.filter(
        getproduct=>{
            return getproduct.product_name.match(this.getsearchTerm)
        }
      )
    },
   
  },
 
  methods:{
    AddToCart(id){
       axios.get('/api/addToCart/'+id)
       .then(()=>{
         componentKey.value += 1;
        Notification.cart_success()
      })
      .catch()
    },
    cartProduct(){
      axios.get('/api/cartProduct/')
      .then(
        ({data})=>(this.carts=data)
        )
      .catch()
    },
    allProduct(){
      axios.get('/api/product/')
      .then(({data})=>(this.products=data))
      .catch()
    },
     allCategory(){
      axios.get('/api/category/')
      .then(({data})=>(this.categories=data))
      .catch()
    },
    gettingproduct(id){
       axios.get('/api/gettingproduct/'+id)
      .then(({data})=>(this.getproducts=data))
      .catch()

    },
    allcustomers(){
      axios.get('/api/allcustomer')
      .then(({data})=>(this.customers=data))
      .catch(console.log('errors'))
  },

  }
  

 
  
}
</script>
<style scoped>
#photo{
  height:90px;
  width:135px;
  margin-top:5px;
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