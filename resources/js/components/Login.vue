<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login (Component Vue)</div>

                <div class="card-body">
                    <form method="POST" action="" @submit.prevent="login($event)">
                        <input type="hidden" name="_token" :value="csrf_token">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">E-mail</label>

                            <div class="col-md-6">
                                <input type="email" id="email" class="form-control" name="email" required autocomplete="email" autofocus v-model="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label" for="remember">
                                        Mantenha-me conectado
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="#">
                                    Esqueceu a senha?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        // Aqui recebo as propriedades passadas do blade para o vue
        //<login-component xyz="Valor1" abc="Valor2"></login-component>
        props: ['csrf_token'], // funcionamento semelhante ao data{} que usamos no vue.js

        data() {
            return {
                email: '',
                password: '',
            };
        },

        methods: {

            login(e) {

                let url = "http://localhost:8000/api/login";
                let configuracao = {
                    method: 'post',
                    // URLSearchParams retorna um objeto do tipo x-www-form-urlencoded
                    body: new URLSearchParams ({
                        'email': this.email,
                        'password': this.password
                    })
                };
                
                // Fazendo a autenticacao, passando a rota(url) e os dados do form de login no formato urlencoded
                fetch(url, configuracao)
                    // Convertendo a resposta da requisicao para json 
                    .then(response => response.json())
                    // Adicionando o token como cookie do site
                    .then(data => {
                        if(data.token){
                            //document.cookie = '<nomeDaChave>='+token+';<tag que permite que o token seja visto em outras partes do site>';
                            document.cookie = 'token='+data.token+';SameSite=Lax';
                        }

                        // Dar sequencia ao envio do form
                        e.target.submit();
                    });
            }
        }
    }

</script>
