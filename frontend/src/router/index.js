import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/components/Home.vue';
import Login from '@/components/Login.vue';
import Register from '@/components/Register.vue';
import Cookies from 'universal-cookie';
const cookies = new Cookies();


// Define route paths as constants
const ROUTES = {
  HOME: '/',
  LOGIN: '/login',
  REGISTER: '/register',
};

// Define routes
const routes = [
  {
    path: ROUTES.HOME,
    name: 'home',
    component: Home,
    meta: { requiresAuth: true },
  },
  {
    path: ROUTES.LOGIN,
    name: 'login',
    component: Login,
  },
  {
    path: ROUTES.REGISTER,
    name: 'register',
    component: Register,
  },
];

// Create router instance
const router = createRouter({
  history: createWebHistory(),
  routes,
});


// Authentication check function
const isAuthenticated = () => {
  const token = cookies.get('token');
  return !!token; // Returns true if token exists, false otherwise
};

// Global navigation guard
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !isAuthenticated()) {
    // Redirect to login if not authenticated
    next(ROUTES.LOGIN);
  } else {
    // Proceed to the next route
    next();
  }
});
export default router
