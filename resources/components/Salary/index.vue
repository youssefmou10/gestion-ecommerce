<template>
  <div>
    <div class="row">
      <router-link to="/givensalary" class="btn btn-primary">Pay Salary</router-link>

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
                  <h6 class="m-0 font-weight-bold text-primary">All Salary Details</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Month Name</th>
                        <th>Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filtersearch" :key="salary.id">
                        <td>{{salary.salary_month}}</td>
                        <td>
                          <router-link :to="{name:'viewsalary' , params:{id:salary.salary_month}}" class="btn btn-sm btn-primary">View Salary</router-link> 
                      

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
      salaries:[],
      FiltersearchTerm:''
    }
  },
  computed:{
    filtersearch(){
      return this.salaries.filter(
        salary=>{
            return salary.salary_month.match(this.FiltersearchTerm)
        }
      )
    }

  },
  methods:{
    allSalary(){
      axios.get('/api/salary/')
      .then(({data})=>(this.salaries=data))
      .catch()
    },
  },
  created(){
    this.allSalary();
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