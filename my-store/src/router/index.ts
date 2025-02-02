import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '@/views/LoginView.vue'
import SignupView from '@/views/SignupView.vue'
import CheckoutView from '@/views/CheckoutView.vue'
import AddProductView from '@/views/AddProductView.vue'
import ProductsView from '@/views/ProductsView.vue'
import ChatView from '@/views/ChatView.vue'
import ProductDetailsView from '@/views/ProductDetailsView.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/login'
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/signup',
      name: 'signup',
      component: SignupView,
    },
    {
      path: '/checkout',
      name: 'checkout',
      component: CheckoutView,
      meta: { requiresAuth: true, role: "user" }
    },
    {
      path: '/add-product',
      name: 'add-product',
      component: AddProductView,
      meta: { requiresAuth: true, role: "admin" }
    },
    {
      path: '/products',
      name: 'products',
      component: ProductsView,
      meta: { requiresAuth: true, role: "user" }
    },
    {
      path: '/chat',
      name: 'chat',
      component: ChatView,
      meta: { requiresAuth: true, role: "user" }
    },
    {
    path: '/products/:productId',
    name: 'product-details',
    component: ProductDetailsView,
    meta: { requiresAuth: true, role: "user" }
  }
  ],
})

router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem("token");
  const userRole = localStorage.getItem("role");

  if (to.meta.requiresAuth) {
    if (!isAuthenticated) {
      next({ name: "login" });
    } else if (to.meta.role && to.meta.role !== userRole) {
      if (userRole === "admin"){
        next({name: 'add-product'})
      }
      else{
        next({ name: "products" });
      }
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router
