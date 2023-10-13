<template>
    <div class="containers">
        <div class="text-wrapper">
    <div class="titles" data-content="404">
        403 - ACCESS DENIED
    </div>

    <div class="subtitle">
        Oops, You don't have permission to access this page.
    </div>
    <div class="isi">
         A web server may return a 403 Forbidden HTTP status code in response to a request from a client for a web page or resource to indicate that the server can be reached and understood the request, but refuses to take any further action. Status code 403 responses are the result of the web server being configured to deny access, for some reason, to the requested resource by the client.
         </div>

    <div class="buttons">
        <router-link to="/" class="btn">Batter Leave Now</router-link>
    </div>
</div>
    </div>
</template>

<script>
    export default {
        name : '403Page',
    }
</script>
<style>
@import url(https://fonts.googleapis.com/css?family=Raleway:700);

.containers{
    height: 100vh;
    padding: 10px;
}

.text-wrapper {
    height: 100%;
   display: flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
}

.titles {
    font-size: 5em;
    font-weight: 700;
    color: #EE4B5E;
}

.subtitle {
    font-size: 40px;
    font-weight: 700;
    color: #1FA9D6;
}
.isi {
    font-size: 18px;
    text-align: center;
    margin:30px;
    padding:20px;
    color: #838080;
}
.buttons {
    margin: 30px;
        font-weight: 700;
        border: 2px solid #EE4B5E;
        text-decoration: none;
        padding: 15px;
        text-transform: uppercase;
        color: #EE4B5E !important;
        border-radius: 26px;
        transition: all 0.2s ease-in-out;
        display: inline-block;
        
  }
.buttons:hover {
            background-color: #EE4B5E;
            color: white !important;
            transition: all 0.2s ease-in-out;
        }
    
</style>