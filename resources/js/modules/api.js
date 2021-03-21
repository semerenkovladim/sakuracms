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
            if(error.status === 401) {
                const data = {
                    refresh_token: refresh_token
                }
                axios.post('/api/login/refresh', data)
                    .then(({data}) => {
                        auth.login(data.token, data.refresh_token, data.user);
                        this.request(methods, url, payload);
                    })

            }
        });
    }
}

export default API;
