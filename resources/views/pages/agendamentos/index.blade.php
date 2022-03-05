@extends('layouts.site')
@section('content')
    <div>
        <div class="page-banner overlay-dark bg-image">
            <div class="banner-section">
                <div class="container text-center">
                    <nav aria-label="Breadcrumb">
                        <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        </ol>
                    </nav>
                    <h1 class="font-weight-normal">Agendamento por especialidade.</h1>
                </div>
            </div>
        </div>

        <div class="page-section mt-5 mb-5">
            <div class="container">
                <h1 class="text-center mb-3">Faça a busca por especialidade</h1>
                <div class="row mb-2 mt-4">
                    <div class="col-sm-12">
                        <select name="especialidade" id="especialidade" class="form-control">
                            <option selected>Selecione uma especialidade</option>
                            @foreach ($especialidades['content'] as $especialidade) { ?>
                            <option value="{{$especialidade['especialidade_id']}} ">{{$especialidade['nome']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" onclick="buscaAgendamento()" class="btn btn-success mt-2 mb-2">Buscar</button>
            </div>
        </div>
        <div id="carregando" class="mb-2 text-center"></div>
        <div id="agendamentos"></div>
    </div>
@endsection
@push('scripts')
    <script>
        function buscaAgendamento() {

            let especialidade = $("#especialidade").val().replace(/ /g, '');
            $('#agendamentos').hide();
            $('#carregando').html('<div class="spinner-border" role="status"></div>').show();

            $.ajax({
                type: 'POST',
                url: `{{route('agendamento.buscaAgendamento')}}`,
                data: {
                    especialidade: especialidade,
                    _token: `{{csrf_token()}}`
                },
                success: function (data) {
                    $('#carregando').hide();
                    $('#agendamentos').html(data).show();
                }
            });
        }

        function desmarcar(id) {
            $('#modalConfirma').modal('hide');
            $.ajax({
                type: 'DELETE',
                url: `{{route('agendamento.desmarcaAgendamento')}}`,
                data: {
                    id: id,
                    _token: `{{csrf_token()}}`
                },
                success: function (data) {
                    if (data.sucesso) {
                        $('#modalAgenda').modal('hide');
                        toastr.success(`Agendamento desmarcado com sucesso!`, 'SUCESSO!', {
                            "showDuration": "400",
                            "hideDuration": "400",
                            "timeOut": "5000",
                            "extendedTimeOut": "100",
                            "positionClass": "toast-top-right",
                        });
                        document.getElementById(id).remove();
                    } else {
                        toastr.warning(`Algo aconteceu e o agendamento não foi desmarcado, Entre em contato com o suporte!`, 'ATENÇÃO!', {
                            "showDuration": "400",
                            "hideDuration": "400",
                            "timeOut": "5000",
                            "extendedTimeOut": "100",
                            "positionClass": "toast-top-right",
                        });
                    }
                }
            });
        }
    </script>
@endpush
