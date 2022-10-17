// require('./bootstrap');
// import { createApp } from 'vue';
// import { createWebHistory } from 'vue-router';
// import * as VueRouter from 'vue-router'

// app.use(VueRouter);
// const app = createApp({});
// const routes = [
//     {
//       path: '/',
//       name: 'login',
//       component: login
//     },
//     {
//       path: '/register',
//       name: 'register',
//     component:register
//     }
//   ]
//   const router = createRouter({
//     history: createWebHistory(process.env.BASE_URL),
//     routes
//   })
// app.mount('#app')
// export default router
import { createApp} from "vue";
import { createWebHistory, createRouter } from "vue-router";
import login from "../components/auth/login";
import register from "../components/auth/register";
import home from "../components/home";
import logout from "../components/auth/logout";
import create from "../components/employee/create";
import index from "../components/employee/index";
import editemploy from "../components/employee/editemploy";
import createSupplier from "../components/supplier/createSupplier";
import edit from "../components/supplier/edit";
import indexSupplier from "../components/supplier/indexSupplier";
import createCategory from "../components/category/createCategory";
import indexCategory from "../components/category/indexCategory";
import editCategory from "../components/category/editCategory";
import createProduct from "../components/product/create";
import indexProduct from "../components/product/index";
import editProduct from "../components/product/edit";
import createExpense from "../components/expense/create";
import editExpense from "../components/expense/edit";
import indexExpense from "../components/expense/index";
import createSalary from "../components/Salary/all_employ";
import paySalary from "../components/Salary/create";
import indexSalary from "../components/Salary/index";
import viewsalary from "../components/Salary/viewsalary";
import editsalary from "../components/Salary/edit-salary";
import stock from "../components/product/stock";
import editstock from "../components/product/editstock";
import customer from "../components/customer/create";
import allcustomer from "../components/customer/index";
import editcustomer from "../components/customer/edit";
import pos from "../components/pos/pointofsale";

// Import class User globaly 
import User from './Helpers/User';
window.User=User;
// Import class Notification globaly 
import Notification from './Helpers/Notification';
window.Notification=Notification;
//strat sweetalert
import Swal from 'sweetalert2';
window.Swal=Swal;
// 




const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});
window.Toast=Toast;

//end sweetalert

import forget from "../components/auth/forget";
// import { vue } from "laravel-mix";
const app=createApp({})
const routes = [
  {
    path: "/",
    name: "login",
    component: login,
  },
  {
    path: "/register",
    name: "register",
    component: register,
  },
  {
    path: "/forget",
    name: "forget",
    component: forget,
  }
  ,
  {
    path: "/home",
    name: "home",
    component: home,
  },
  {
    path: "/logout",
    name: "logout",
    component: logout,
  },
  //employee
  {
    path: "/create",
    name: "createemployee",
    component: create,
  },
   {
    path: "/allemployee",
    name: "allemployee",
    component: index,
  },
  {
    path: "/editemploy/:id",
    name: "editemploy",
    component: editemploy,
  },
  //supplier
  {
    path: "/createSupplier",
    name: "createSupplier",
    component: createSupplier,
  },
  {
    path: "/store-supplier",
    name: "store-supplier",
    component: indexSupplier,
  },
  {
    path: "/editsupplier/:id",
    name: "editsupplier",
    component: edit,
  },
  //category
  {
    path: "/storecategory",
    name: "createCategory",
    component: createCategory,
  },
  {
    path: "/allcategory",
    name: "indexCategory",
    component: indexCategory,
  },
  {
    path: "/editcategory/:id",
    name: "editCategory",
    component: editCategory,
  },
  //product
  {
    path: "/storeproduct",
    name: "createProduct",
    component: createProduct,
  },
  {
    path: "/allproduct",
    name: "indexProduct",
    component: indexProduct,
  },
  {
    path: "/editproduct/:id",
    name: "editProduct",
    component: editProduct,
  },
  // expense
  {
    path: "/storexpense",
    name: "createExpense",
    component: createExpense,
  },
  {
    path: "/allexpense",
    name: "indexExpense",
    component: indexExpense,
  },
  {
    path: "/editexpense/:id",
    name: "editExpense",
    component: editExpense,
  },
  //salary
  {
    path: "/givensalary",
    name: "createSalary",
    component: createSalary,
  },
 
  {
    path: "/paySalary/:id",
    name: "paySalary",
    component: paySalary,
  },
  {
    path: "/Salary",
    name: "indexSalary",
    component: indexSalary,
  },
  {
    path: "/viewsalary/:id",
    name: "viewsalary",
    component: viewsalary,
  },
  {
    path: "/editsalary/:id",
    name: "edit-salary",
    component:editsalary,
  },
  //stock
  {
    path: "/stock",
    name: "stock",
    component:stock,
  },
  {
    path: "/editstock/:id",
    name: "editStock",
    component:editstock,
  },
  //customer
  {
    path: "/storecustomer",
    name: "customer",
    component: customer,
  },
  {
    path: "/allcustomer",
    name: "allcustomer",
    component: allcustomer,
  },
  {
    path: "/editcustomer/:id",
    name: "editcustomer",
    component: editcustomer,

  },
  //POS 
   {
    path: "/pos",
    name: "pos",
    component: pos,
  }

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

createApp(app).use(router).mount('#app')

export default router;