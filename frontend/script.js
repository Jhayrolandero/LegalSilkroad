window.addEventListener('load', () => {
  
    const token = localStorage.getItem('jwt_token');
    if (!token) {
        window.location.href = "http://127.0.0.1:5500/frontend/register.html";
    }

    axios.interceptors.request.use((config) => {
        const token = localStorage.getItem('jwt_token');
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        return config;
    }, (error) => {
        return Promise.reject(error);
    });

    axios.get("http://127.0.0.1:8000/api/userNotes")
    .then((response) => {
        console.log(response.data)
    })
    .catch((error) => {
        console.error(error.response)
    })
})