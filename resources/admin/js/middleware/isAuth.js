export default function auth ({ next }){
    const user = window.localStorage.getItem('user');
    const access_token = window.localStorage.getItem('token');
    const refresh_token = window.localStorage.getItem('refresh_token');
    if(!user || !access_token || !refresh_token){
        return next({
            name: 'login'
        })
    }
    return next()
}
