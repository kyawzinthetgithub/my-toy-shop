<template>
  <div class="containers my-auto">
    <div class="cards">
      <div class="logimg">
        <img src="../assets/logo.png" alt="" />
      </div>
      <h3 class="text-center my-3" style="color:#4b5a63; text-shadow: 0px 0px 2px #4b5a63;">Login</h3>
      <div v-if="message != ''" class="alert alert-danger alert-dismissible fade show" role="alert">
        <small>{{message}}</small>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
      </div>
      <form action="">
        <div class="form-group my-2">
          <label for="userEmail" class="my-2">Email</label>
          <input
            type="email"
            name="email"
            id="userEmail"
            class="form-control"
            placeholder="Enter Email"
            v-model="userData.email"
          />
        </div>
        <div class="form-group my-2">
          <label for="userPassword" class="my-2">Password</label>
          <input
            type="password"
            name="password"
            id="userPassword"
            class="form-control"
            placeholder="Enter Password"
            v-model="userData.password" @keypress.enter="accountLogin()"
          />
        </div>
        <div class="d-grid mt-3">
          <button type="button" class="btn btn-success" @click="accountLogin()">
            Login
          </button>
        </div>
      </form>
      <p class="text-center my-3">
        Don't have account.
        <a
          href="javascript:void(0)"
          class="text-decoration-none text-primary"
          @click="goregister()"
          >Register Here</a
        >
      </p>
    </div>
  </div>
</template>

<script src="../js/LoginView.js"></script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.containers {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.cards {
  background: linear-gradient(rgba(121, 121, 121, 0.3), rgba(121, 121, 121, 0.3));
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 0 2px #eee;
}

.cards .logimg {
  display: flex;
  justify-content: center;
}

.cards img {
  width: 100px;
  height: 100px;
  border: 1px solid #575757;
  border-radius: 100%;
}

.cards label {
  color: #575757;
}
</style>
