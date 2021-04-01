class API {
    constructor() {
    }

    request (methods, url, payload = null, contentType = 'application/json') {
        const token = window.localStorage.getItem('token');
        const user = window.localStorage.getItem('user');
        const refresh_token = window.localStorage.getItem('refresh_token');
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        axios.defaults.headers.common['Content-Type'] = contentType;
        return axios[methods](url, payload).then((response) => {
            return response.data;
        }).catch((error) => {
            if(error.response.status === 401) {
                const data = {
                    refresh_token: refresh_token
                }
                axios.post('/api/login/refresh', data)
                    .then((res) => {
                        auth.login(res.data.token, refresh_token, user);
                        this.request(methods, url, payload);
                    })

            } else {
                return error;
            }
        });
    }
}

export default API;
