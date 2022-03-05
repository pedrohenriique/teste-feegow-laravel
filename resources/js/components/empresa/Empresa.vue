<template>
    <div id="componenteEmpresa">

        <p class=" mt-2 text-center" v-if="preload">
            <span class="spinner-border" role="status"></span> Carregando...
        </p>

        <div class="page-section mt-5" v-if="!preload">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h1 class="text-center mb-3">Mais informações da {{ matriz.nome_fantasia }}</h1>
                        <div class="text-lg">
                            <p>Empresa: {{ matriz.nome_fantasia }}</p>
                            <p>Endereço: {{ matriz.endereco }}, Nº{{ matriz.numero }}, {{ matriz.bairro }},
                                {{ matriz.cidade }} - {{ matriz.estado }}</p>
                            <p>Contato: {{ matriz.telefone_2 }} {{ matriz.telefone_1 }}</p>
                            <p>E-mail: {{ matriz.email_1 }}</p>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5 mb-5">
                        <h1 class="text-center mb-5">Unidades</h1>
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-4 mb-2" v-for="unidade in unidades">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-xl mb-0">{{unidade.nome_fantasia}}</p>
                                        <span class="text-sm text-grey">{{unidade.cnpj}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            preload: false,
            editando: false,
            cadastrado: false,
            atualizado: false,
            carregando: false,

            matriz: [],
            unidades: [],
        }
    },
    mounted() {
        this.preload = true;
        this.atualizar();
    },
    methods: {
        atualizar() {
            axios.get(`${URL_SITE}/busca-empresa`)
                .then(response => {
                    this.matriz = response.data.content.matriz[0];
                    this.unidades = response.data.content.unidades;
                    this.preload = false;
                }).catch(error =>
                (this.preload = false));
        },
    }
}
</script>
