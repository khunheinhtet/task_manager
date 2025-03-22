<script setup>
</script>

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
        <tbody>
          <tr>
            <td>1</td>
            <td>Test 1</td>
            <td>Test 2</td>
            <td class="priority low">Low</td>
            <td>Pending</td>
            <td>2025-03-22</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

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

