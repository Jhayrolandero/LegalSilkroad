// const registerForm  = document.getElementById("registerForm")
const loginForm  = document.getElementById("loginForm")

const loginEmail =  document.getElementById('loginEmail')
const loginPassword = document.getElementById('loginPassword')
// registerForm.addEventListener("submit", event => {
//     event.preventDefault()
//     console.log('Register')
// })

loginForm.addEventListener("submit", event => {
    event.preventDefault()

    const email = loginEmail.value 
    const password = loginPassword.value
    
    axios.post('http://127.0.0.1:8000/api/login', {email,password})
    .then(function (response) {
    localStorage.setItem('jwt_token', response.data.token);
    const token = localStorage.getItem("jwt_token")
    if (token) {
        window.location.href = "http://127.0.0.1:5500/frontend/index.html";
    }
    })
    .catch(function (error) {
    console.log(error.response.data);
    });
})