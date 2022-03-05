<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{

    public function buscaAgendamento(Request $request)
    {
        $agendamentos = Agenda::where('specialty_id', $request->especialidade)->get();

        return view('ajax.busca-agendamentos', compact('agendamentos'));
    }

    public function cadastroAgendamento(Request $request)
    {
        $dados = $request->input();
        $id = Agenda::create($dados);
        if (isset($id)) {
            $cadastro['sucesso'] = true;
        } else {
            $cadastro['sucesso'] = false;
        }
        return $cadastro;
    }

    public function desmarcaAgendamento(Request $request)
    {
        $agenda = Agenda::find($request->id)->delete();

        if ($agenda) {
            $delete['sucesso'] = true;
        } else {
            $delete['sucesso'] = false;
        }
        return $delete;
    }
}
