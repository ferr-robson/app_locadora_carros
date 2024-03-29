import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

// Interceptando o request de uma requisicao axios
axios.interceptors.request.use(
    config => {
        config.headers.Accept = 'application/json';

        // Pegando o token dos cookies 
        let token = document.cookie.split(';').find(indice => {
            return indice.includes('token=');
        });
        token = 'Bearer ' + token.split('=')[1];
        
        // Adicionando o token ao header
        config.headers.Authorization = token;

        return config;
    },
    error => {
        //console.log('erro na requisicao: ', error);
        return Promise.reject(error);
    }
);

// Interceptando a resposta de uma requisicao axios
axios.interceptors.response.use(
    config => {
        //console.log('interceptando a resposta antes da aplicacao', config);
        return config;
    },
    error => {
        if(error.response.status == 401 && error.response.data.message == 'Token has expired') {
            
            // Fazendo uma requisicao para a rota refresh
            axios.post('http://localhost:8000/api/refresh')
                .then(response => {
                    // Pegando o novo token e salvando ele nos cookies
                    document.cookie = 'token=' + response.data.token;

                    // Recarregando a pagina 
                    window.location.reload();
                })
        }
        /*else if(error.response.status == 500 && error.response.data.message == 'The token has been blacklisted') {
            console.log('lista negra. Terminar a secao');
        }*/
        //console.log('erro na resposta: ', error);
        return Promise.reject(error);
    }
);