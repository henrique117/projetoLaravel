<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Topico;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TopicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topicos = Topico::all();
        return $this->success($topicos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'topico' => 'required|max:255'
        ]);
        if ($validated) {
            try {
                $topico = new Topico();
                $topico->topico = $request->get('topico');
                $topico->save();
                return $this->success($topico);
            } catch (\Throwable $th) {
                return $this->error("Erro ao cadastrar tópico!", 401, $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $topico = Topico::findOrFail($id);
            return $this->success($topico);
        } catch (\Thorwable $th) {
            return $this-error("Tópico nao encontrado!", 401, $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'topico' => 'required|max:255'
        ]);
        if ($validated) {
            try {
                $topico = new Topico();
                $topico->topico = $request->get('topico');
                $topico->save();
                return $this->success($topico);
            } catch (\Throwable $th) {
                return $this->error("Tópico não encontrado!", 401, $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $topico = Topico::findOrFail($id);
            $topico->delete();
            return $this->success($topico);
        } catch (\Thorwable $th) {
            return $this-error("Tópico nao encontrado!", 401, $th->getMessage());
        }
    }
}