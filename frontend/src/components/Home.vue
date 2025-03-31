<template>
  <div class="container">
    <div class="table-container">
      <table class="responsive-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Due Date</th>
          </tr>
        </thead>
        <tbody v-if="data.length > 0">
            <tr v-for="(data, index) in data" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ data.title }}</td>
              <td>{{ data.description }}</td>
              <td>
                <span :class="'priority ' + data.priority.toLowerCase()">
                  {{ data.priority }}
                </span>
              </td>
              <td>{{ data.status }}</td>
              <td>{{ data.dueDate }}</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>


<script>
import axios from 'axios';
import { configUrl } from '@/config/config';
import Cookies from 'universal-cookie';

export default {
  data() {
    return {
      data: [],
    };
  },
  async mounted() {
    const cookies = new Cookies();
    const token = cookies.get('token');
    const response = await axios.get(`${configUrl}/getdata`, {
    withCredentials: true,
    headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${token}` // Fixed typo here
        }
    });

    if (response.status !== 200) {
      throw new Error("Failed to fetch tasks");
    }
    this.data = response.data;
  },
};
</script>

<style scoped>
/* Container */
.container {
  width: 100%;
  padding: 20px;
  max-width: 1440x;
  margin: auto;
}

/* Table Wrapper for Responsiveness */
.table-container {
  width: 100%;
  overflow-x: auto;
}

/* Table */
.responsive-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 600px;
}

.responsive-table th, 
.responsive-table td {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: left;
}

.responsive-table th {
  background-color: #f4f4f4;
  font-weight: bold;
}

/* Priority Colors */
.priority.low {
  background-color: #4caf50;
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
  /* display: inline-block; */
}

.priority.medium {
  background-color: #ffcc00;
  color: black;
  padding: 5px 10px;
  border-radius: 5px;
  display: inline-block;
}

.priority.high {
  background-color: #ff4d4d;
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
  display: inline-block;
}

/* Responsive Design */
@media (max-width: 768px) {
  .responsive-table {
    min-width: 100%;
    overflow-x: auto;
  }

  .responsive-table th,
  .responsive-table td {
    padding: 10px;
    font-size: 14px;
  }
}

@media (max-width: 480px) {
  .responsive-table th,
  .responsive-table td {
    padding: 8px;
    font-size: 12px;
  }
}
</style>

