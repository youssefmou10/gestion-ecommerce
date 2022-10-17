<template>
  
  <div>

 <div class="row">
  <router-link to="/allexpense" class="btn btn-primary">All Expense </router-link>
   
 </div>



    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Expense Update</h1>
                  </div>

      <form class="user" @submit.prevent="expenseUpdate" >

        <div class="form-group">

          <div class="form-row">
            <div class="col-md-12">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  v-model="form.details"></textarea>
       <small class="text-danger" v-if="errors.details"> {{ errors.details[0] }} </small>
            </div> 
             <div class="col-md-12">
         <input type="text" class="form-control" id="exampleInputFirstName"  v-model="form.amount">
       <small class="text-danger" v-if="errors.amount"> {{ errors.amount[0] }} </small>
            </div>
            
          </div>
        </div>
       
        
    

       

        <div class="form-group">

          <div class="form-row">
           


     <div class="col-md-6">
        
            </div>     
            
          </div>
        </div>



 


        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Update</button>
        </div>
        
      </form>
                  <hr>
                  <div class="text-center">
  
  
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>



<script type="text/javascript">
   import axios from 'axios'
  export default {
    
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },

    data(){
    return {
      form:{
        details:'',
        amount:'',
      },
      errors:{}
    }
   
  },
  //edit
   created(){
      //acces to data 
      let id = this.$route.params.id
      axios.get('/api/expense/'+id)
      //acces to data
      .then(({data})=>(this.form=data))
      .catch(console.log('error'))
    },
  methods:{
  expenseUpdate(){
       let id = this.$route.params.id
       axios.put('/api/expense/'+id,this.form)
       .then(() => {
        this.$router.push({ name:'indexExpense'})
        Toast.fire({
           icon: 'success',
           title: 'Update Sucsseful'
              })
       })
       .catch(error =>this.errors = error.response.data.errors)
      } 
  }


  }
   
</script>


<style type="text/css">
  
</style>