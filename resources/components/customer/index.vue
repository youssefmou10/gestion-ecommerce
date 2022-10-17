<template>
  <div>
    <div class="row">
      <router-link to="/storecustomer" class="btn btn-primary">Add Customer</router-link>

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
                  <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Phone</th>
                        <th>email</th>
                         <th>addresse</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in filtersearch" :key="customer.id">
                        <td>{{customer.name}}</td>
                        <td><img :src="customer.photo" id="photo"></td>
                        <td>{{customer.phone}}</td>
                        <td>{{customer.email}}</td>
                        <td>{{customer.addresse}}</td>
                        <td>
                          <router-link :to="{name:'editcustomer' , params:{id:customer.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                           <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger" id="delete">Delete</a>
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
      customers:[],
      FiltersearchTerm:''
    }
  },
  computed:{
    filtersearch(){
      return this.customers.filter(
        customer=>{
            return customer.name.match(this.FiltersearchTerm)
        }
      )
    }

  },
  methods:{
    allcustomer(){
      axios.get('/api/allcustomer/')
      .then(({data})=>(this.customers=data))
      .catch()
    },
    deleteCustomer(id){
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
      axios.delete("/api/deletecustomer/"+id)
      .then(
        this.customers=this.customers.filter(customer=>{
          return customer.id!=id
        })
      )
      .catch(()=>{
        this.$router.push({name:'allcustomer'})
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
    this.allcustomer();
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

</style>