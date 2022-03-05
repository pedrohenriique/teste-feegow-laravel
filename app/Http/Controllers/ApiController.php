<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public static function sendRequest($url)
    {
        return Http::withHeaders([
            'x-access-token' => getenv('TOKEN_API'),
            'Content-Type' => 'application/json',
        ])->get(getenv('MIX_URL_API') . $url);
    }


    public function buscaEspecialidades()
    {
        $especialidades = self::sendRequest('specialties/list');
        return view('pages.especialidades.index', compact('especialidades'));
    }

    public function buscaProfissionais()
    {
        $especialidade = $_GET['especialidade'];
        $profissionais = self::sendRequest('professional/list?ativo=' . true . '&especialidade_id=' . $especialidade);
        $origens = self::sendRequest('patient/list-sources');
        $total = count($profissionais['content']);
        $nomeEspecialidade = $profissionais['content'][0]['especialidades'][0]['nome_especialidade'];

        return view('ajax.busca-profissionais', compact(['profissionais', 'total', 'nomeEspecialidade', 'especialidade', 'origens']));
    }


    public function buscaAgendamentoEspecialidades()
    {
        $especialidades = self::sendRequest('specialties/list');
        return view('pages.agendamentos.index', compact('especialidades'));
    }

    public function buscaEmpresa()
    {
        return self::sendRequest('company/list-unity');
    }
}
