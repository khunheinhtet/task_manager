<template>
    <div class="login-container">
      <h2>Login</h2>
      <form @submit.prevent="handleLogin">
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" v-model="email" required />
        </div>
  
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" v-model="password" required />
        </div>
  
        <button type="submit" :disabled="loading">
          {{ loading ? "Logging in..." : "Login" }}
        </button>
  
        <p v-if="error" class="error">{{ error }}</p>
      </form>
      <button class="register-button" style="margin-top: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; padding: 10px; cursor: pointer;">
        <span style="margin-right: 5px;">Don't have an account?</span>
        <router-link style="color: white;" to="/register">Register</router-link>
      </button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { configUrl } from '@/config/config';
  import Cookies from 'universal-cookie';

  export default {
    data() {
      return {
        email: "",
        password: "",
        loading: false,
        error: "",
      };
    },
    methods: {
      async handleLogin() {
        this.loading = true;
        this.error = "";
  
        try {
          const response = await axios.post(`${configUrl}/login`, { email: this.email, password: this.password }, { withCredentials: true });
          const data = await response.data;
  
          if (response.status !== 200) {
            throw new Error(data.error || "Login failed");
          }

          const cookies = new Cookies();
          cookies.set("token", data.token, { path: "/" });
          this.$router.push("/");
        } catch (err) {
          this.error = err.message;
        } finally {
          this.loading = false;
        }
      },
    }
  };
  </script>
  
  <style scoped>
  .login-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #f9f9f9;
    text-align: center;
  }
  
  .input-group {
    margin-bottom: 15px;
    text-align: left;
  }
  
  .input-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  
  .input-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  button:disabled {
    background-color: #aaa;
  }
  
  .error {
    color: red;
    margin-top: 10px;
  }
  </style>
  