<div class="container">
    <div class="row">
        <div class="col-sm-12">
            {{ $total . ' ' . $nomeEspecialidade . ' encontrado(s)'}}
        </div>
        @foreach ($profissionais['content'] as $profissional)
            <div class="col-sm-4 py-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <div class="avatar mr-2">
                            <div class="avatar-img">
                                <img src="{{ $profissional['foto'] }}" alt="">
                            </div>
                            <div>
                                <h6 class="card-title ml-3">{{ $profissional['nome'] }}</h6>
                                <span class="card-subtitle mb-2 text-muted ml-3">{{ $profissional['conselho'] . ' ' . $profissional['documento_conselho'] }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success mt-2 botao"
                                    onclick="abrirModal({{ $especialidade }} , {{ $profissional['profissional_id'] }})">
                                AGENDAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="modal fade " id="modalAgenda" tabindex="-1" role="dialog" aria-labelledby="modalAgendaTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agendar consulta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="enviaDados">
                    @csrf
                    <input type="hidden" name="specialty_id" id="specialty_id" value="">
                    <input type="hidden" name="professional_id" id="professional_id" value="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome completo</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nome">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Como conheceu?</label>
                            <select class="form-control" name="source_id" id="source_id">
                                <option value='' selected>Selecione</option>
                                @foreach ($origens['content'] as $origem) { }}
                                <option value='{{ $origem['origem_id'] }}'>{{ $origem['nome_origem'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Data de nascimento</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate"
                                   placeholder="Data de Nascimento" onkeypress="$(this).mask('00/00/0000');">
                        </div>
                        <div class="form-group col-md-6">
                            <label>CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF"
                                   onkeypress="$(this).mask('000.000.000-00');">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-sm btn-success" onclick="salvarAgendamento()">Agendar</button>
            </div>
        </div>
    </div>
</div>
