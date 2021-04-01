class Auth {
    constructor() {
        this.token = window.localStorage.getItem('token');
        let userData = window.localStorage.getItem('user');
        this.refresh_token = window.localStorage.getItem('refresh_token');
        this.user = userData ? JSON.parse(userData) : null;

        if (this.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
        }
    }

    login (token, refresh_token, user) {
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('refresh_token', refresh_token);
        window.localStorage.setItem('user', JSON.stringify(user));
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    }

    logout() {
        api.request('get', '/api/logout').then(() => {
            window.localStorage.removeItem('token');
            window.localStorage.removeItem('refresh_token');
            window.localStorage.removeItem('user');
        });
    }
    getRefresh() {
        return this.refresh_token;
    }
}

export default Auth;
