<template>
  <div>
    <div class="row">
      <router-link to="/createSupplier" class="btn btn-primary">Add Suppliers</router-link>

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
                  <h6 class="m-0 font-weight-bold text-primary">Suppliers List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Phone</th>
                        <th>Shop Name</th>
                         <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in filtersearch" :key="supplier.id">
                        <td>{{supplier.name}}</td>
                        <td><img :src="supplier.photo" id="photo"></td>
                        <td>{{supplier.phone}}</td>
                         <td>{{supplier.shopname}}</td>
                        <td>{{supplier.email}}</td>
                     
                       
                        <td style="display:inline">
                          <router-link :to="{name:'editsupplier' , params:{id:supplier.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                           <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger" id="delete">Delete</a>
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
      suppliers:[],
      FiltersearchTerm:''
    }
  },
  computed:{
    filtersearch(){
      return this.suppliers.filter(
        supplier=>{
            return supplier.name.match(this.FiltersearchTerm)
        }
      )
    }

  },
  methods:{
    allSupplier(){
      axios.get('/api/supplier/')
      .then(({data})=>(this.suppliers=data))
      .catch()
    },
    deleteSupplier(id){
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
      axios.delete("/api/supplier/"+id)
      .then(
        this.suppliers=this.suppliers.filter(supplier=>{
          return supplier.id!=id
        })
      )
      .catch(()=>{
        this.$router.push({name:'indexSupplier'})
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
    this.allSupplier();
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