@extends('layouts.site')
@section('content')
    <div>
        <div class="page-banner overlay-dark bg-image">
            <div class="banner-section">
                <div class="container text-center">
                    <h1 class="font-weight-normal">Temos diversos especialistas, busque abaixo um para agendar.</h1>
                </div>
            </div>
        </div>

        <div class="page-section mt-5 mb-5">
            <div class="container">
                <h1 class="text-center mb-3">Agende sua Consulta</h1>
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
                <button type="submit" onclick="buscaEspecialidades()" class="btn btn-success mt-2 mb-2">Buscar</button>
            </div>
        </div>

        <div id="carregando" class="mb-2 text-center"></div>
        <div id="listaProfissionais"></div>
    </div>
@endsection
@push('scripts')
    <script>
        function buscaEspecialidades() {

            let especialidade = $("#especialidade").val().replace(/ /g, '');

            $('#listaProfissionais').hide();

            $('#carregando').html('<div class="spinner-border" role="status"></div>').show();

            $.ajax({
                type: 'GET',
                url: `{{route('buscaProfissionais')}}`,
                data: {
                    especialidade: especialidade,
                },
                success: function (data) {
                    $('#carregando').hide();
                    $('#listaProfissionais').html(data).show();
                }
            });
        }

        function abrirModal(especialidade, profissional) {
            $("#professional_id").val(profissional);
            $("#specialty_id").val(especialidade);
            $('#modalAgenda').modal('show');
        }

        function salvarAgendamento() {
            $.ajax({
                type: 'POST',
                url: `{{route('agendamento.cadastroAgendamento')}}`,
                data: {
                    specialty_id: $("#specialty_id").val(),
                    professional_id: $("#professional_id").val(),
                    name: $("#name").val(),
                    source_id: $("#source_id").val(),
                    birthdate: $("#birthdate").val(),
                    cpf: $("#cpf").val(),
                    _token: `{{csrf_token()}}`
                },
                success: function (data) {
                    if (data.sucesso === true) {
                        $('#modalAgenda').modal('hide');
                        toastr.success(`Agendamento concluído com sucesso!`, 'SUCESSO!', {
                            "showDuration": "400",
                            "hideDuration": "400",
                            "timeOut": "4000",
                            "extendedTimeOut": "100",
                            "positionClass": "toast-top-right",
                        });
                        setTimeout(function() {
                            document.location.reload(true);
                        }, 1000);

                    } else {
                        toastr.warning(`Algo aconteceu e os dados não foram cadastrados, Entre em contato com o suporte!`, 'ATENÇÃO!', {
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


{{--$.toast({--}}
{{--heading: 'Error',--}}
{{--text: 'An unexpected error occured while trying to show you the toast! ..Just kidding, it is just a message, toast is right in front of you.',--}}
{{--icon: 'error'--}}
{{--})--}}
