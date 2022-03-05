<div class="container">
    @if(count($agendamentos) > 0)
        <table class="table" id="tabela">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Data Nascimento</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($agendamentos as $agendamento)
                <tr id="{{$agendamento['id']}}">
                    <th scope="row">{{$agendamento['id']}}</th>
                    <td>{{$agendamento['name']}}</td>
                    <td>{{$agendamento['cpf']}}</td>
                    <td>{{$agendamento['birthdate']}}</td>
                    <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirma">
                            Desmarcar
                        </button>
                        <div class="modal fade" id="modalConfirma" tabindex="-1" role="dialog"
                             aria-labelledby="modalAgendaTitle"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Você deseja desmarcar este agendamento?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancelar
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success"
                                                onclick="desmarcar(`{{$agendamento['id']}}`)">Desmarcar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning" role="alert">
            <p class="text-center">Nenhum agendamento para esta especialidade.</p>
        </div>

    @endif
</div>

