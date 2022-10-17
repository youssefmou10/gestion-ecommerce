<template>
  <div>
    <div class="row">
      <router-link to="/storecategory" class="btn btn-primary">Add Category</router-link>

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
                  <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>CategoryName</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="category in filtersearch" :key="category.id">
                        <td>{{category.categorie_name}}</td>
                        <td>
                          <router-link :to="{name:'editCategory' , params:{id:category.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                           <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger" id="delete">Delete</a>
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
      categories:[],
      FiltersearchTerm:''
    }
  },
  computed:{
    filtersearch(){
      return this.categories.filter(
        category=>{
            return category.categorie_name.match(this.FiltersearchTerm)
        }
      )
    }

  },
  methods:{
    allCategory(){
      axios.get('/api/category/')
      .then(({data})=>(this.categories=data))
      .catch()
    },
    deleteCategory(id){
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
      axios.delete("/api/category/"+id)
      .then(
        this.categories=this.categories.filter(category=>{
          return category.id!=id
        })
      )
      .catch(()=>{
        this.$router.push({name:'indexCategory'})
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
    this.allCategory();
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