<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Player;
use App\Http\Requests\PlayerRequest;
use Exception;
use App\Http\Resources\Player as PlayerResource;
use App\Http\Resources\PlayerCollection;

class PlayerController extends Controller
{
    /**
     * @var \App\Models\Player
     */
    protected $model;

    public function __construct(Player $player)
    {
        $this->model = $player;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Player $player)
    {
        try {
            $players = $player->all();
            $playersCollection = new PlayerCollection($players);

            return response()->json($playersCollection, 200);

        } catch(\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno no servidor'
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerRequest $request)
    {
        try {
            $player = new Player();
            $player->fill($request->all());
            $player->save();
            $playerResource = new PlayerResource($player);

            return response()->json($playerResource, 201);
        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno do servidor'
            ], 500);
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
            $player = $this->model->findOrFail($id);
            $playerResource = new PlayerResource($player);
            return response()->json($playerResource);

        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Aviso',
                'msg'   => 'Jogador não encontrado!'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerRequest $request, $id)
    {
        try {
            $player = $this->model->find($id);
            $player->fill($request->all());
            $player->save();
            $playerResource = new PlayerResource($player);

            return response()->json($playerResource, 200);
        } catch(\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno do servidor'
            ], 500);
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
        try{
            $player = $this->model->find($id);
            if($player != null) {
                $player->delete();
                return response()->json([
                'msg' => 'Jogador deletado com sucesso!'
            ], 200);
            } else {
                return response()->json([
                    'msg' => 'Jogador não encontrado!'
                 ], 404);
            }
        } catch(\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno do servidor'
            ], 500);
        }
    }
}
