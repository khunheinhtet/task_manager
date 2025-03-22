import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/components/Home.vue';
import Login from '@/components/Login.vue';
import Register from '@/components/Register.vue';
import Cookies from 'universal-cookie';
const cookies = new Cookies();

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    // meta: { requiresAuth: true }
  },
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/register',
    name: 'register',
    component: Register
  },
]
const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const token = cookies.get('token');

  if (to.meta.requiresAuth && !token) {
    next('/login');
  } else {
    next();
  }
});
export default router
