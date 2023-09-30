<template>
  <div>
    <NavbarPage></NavbarPage>

    <div class="container-fluid py-3" style="background:#b0b2b5;">
      <div class="row my-5">
        <div class="col-lg-6 offset-lg-3">
          <div
            class="card p-5"
            style="
              background: linear-gradient(
               
                rgba(255, 255, 255, 0.02),rgba(255, 255, 255, 0.02)
              );
            "
          >
            <div class="row">
            <h3
              class="text-muted text-center mb-5"
              style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5)"
            >
              Customer Contact
            </h3>
              <div class="col-lg-6 my-3">
                <img src="../assets/img1.jpeg" style="width:100%; height:100%;" class="img-thumbnail" alt="">
              </div>
              <div class="col-lg-6 border p-3 rounded">
                <form>
                  <div class="form-group mb-2">
                    <label for="name" class="text-muted mb-2">Name</label>
                    <input v-model="userInfo.name"
                      type="text"
                      name="name"
                      id="name"
                      class="form-control bg-transparent"
                      style="box-shadow: none"
                      placeholder="Enter Name..." 
                    />
                    <small class="text-danger" v-if="validateError.name">{{validateError.name[0]}}</small>
                  </div>

                  <div class="form-group mb-2">
                    <label for="email" class="text-muted mb-2">Email</label>
                    <input v-model="userInfo.email"
                      type="email"
                      name="email"
                      id="email"
                      class="form-control bg-transparent"
                      style="box-shadow: none"
                      placeholder="Enter Email..."
                    />
                    <small class="text-danger" v-if="validateError.email">{{validateError.email[0]}}</small>
                  </div>

                  <div class="form-group mb-2">
                    <label for="message" class="text-muted mb-2">Message</label>
                    <textarea v-model="userInfo.message"
                      name="message"
                      id="message"
                      class="form-control bg-transparent" rows="3"
                      style="box-shadow: none" placeholder="Enter Message..."
                    ></textarea>
                    <small class="text-danger" v-if="validateError.message">{{validateError.message[0]}}</small>
                  </div>
                  
                  <div class="d-grid">
                    <button type="button" class="btn btn-primary mt-2" @click="sentMessage()">Sent</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <FooterPage></FooterPage>
  </div>
</template>

<script src="../js/CustomerContact.js"></script>
