<template>
  <div class="containers my-5">
    <div class="cards py-5">
      <div class="logimg">
        <img src="../assets/logo.png" alt="" />
      </div>
      <h3 class="text-center my-3" style="color:#4b5a63; text-shadow: 0px 0px 2px #4b5a63;">Register</h3>
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
          <label for="userName" class="my-2">Name</label>
          <input
            type="text"
            name="name"
            id="userName"
            class="form-control"
            placeholder="Enter Name" v-model="userData.name"
          />
          <p class="text-danger" v-if="errors.name">{{errors.name[0]}}</p>
        </div>
        <div class="form-group my-2">
          <label for="userEmail" class="my-2">Email</label>
          <input
            type="email"
            name="email"
            id="userEmail"
            class="form-control"
            placeholder="Enter Email" v-model="userData.email"
          />
          <p class="text-danger" v-if="errors.email">{{errors.email[0]}}</p>
        </div>
        <div class="form-group my-2">
          <label for="userAddress" class="my-2">Address</label>
          <input
            type="text"
            name="address"
            id="userAddress"
            class="form-control"
            placeholder="Enter Address" v-model="userData.address"
          />
          <p class="text-danger" v-if="errors.address">{{errors.address[0]}}</p>
        </div>
        <div class="form-group my-2">
          <label for="userPhone" class="my-2">Phone</label>
          <input
            type="tel"
            name="phone"
            id="userPhone"
            class="form-control"
            placeholder="09xxxxxxxxx" v-model="userData.phone"
          />
          <p class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</p>
        </div>
        <div class="form-group mb-3">
          <label for="gender" class="d-block mb-2 text-muted"
            >Gender</label
          >
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="gender"
              id="male"
              value="male" v-model="userData.gender"
            />
            <label class="form-check-label" for="male">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="gender"
              id="female"
              value="female" v-model="userData.gender"
            />
            <label class="form-check-label" for="female">Female</label>
          </div>
          <p class="text-danger" v-if="errors.gender">{{errors.gender[0]}}</p>
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            name="password"
            class="form-control"
            id="password"
            placeholder="Password" v-model="userData.password"
          />
          <p class="text-danger" v-if="errors.password">{{errors.password[0]}}</p>
        </div>
        <div class="mb-4">
          <label for="confirmPassword" class="form-label"
            >Confirm Password</label
          >
          <input
            type="password"
            name="password_confirmation"
            class="form-control"
            id="confirmPassword"
            placeholder="Confirm Password" v-model="userData.password_confirmation"
          />
          <p class="text-danger" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</p>
        </div>
        <div class="d-grid mt-3">
          <button type="button" class="btn btn-success" @click="userRegister()">Register</button>
        </div>
      </form>
      <p class="text-center my-3">
        Already have account.
        <a
          href="javascript:void(0)"
          class="text-decoration-none text-primary"
          @click="gologin()"
          >Login Here</a
        >
      </p>
    </div>
  </div>
</template>

<script src="../js/Register.js"></script>

<style>

.containers {
  width: 100%;
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
