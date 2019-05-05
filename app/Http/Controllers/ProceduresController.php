<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Procedure;

class ProceduresController extends Controller
{
    public function index($trainingId){
        Log::debug("ProceduresController index");
        //$procedures = Procedure::orderBy('id', 'asc')->get();
        $procedures = Procedure::where('training_id',$trainingId)->orderBy('id', 'asc')->get();

        Log::debug($procedures);
        return $procedures;
    }

    public function update(){
        Log::debug("ProceduresController update");

        $procedures = Request::all()['procedures'];
        Log::debug($procedures);
        for ($i=0; $i < count($procedures) ; $i++) {
            Log::debug("id:".$i." trainingId : ".$procedures[$i]['training_id']);
            Log::debug(json_encode($procedures[$i]['procedure_data']));


            $procedure = Procedure::where('training_id', $procedures[$i]['training_id'])
                                  ->where('id', $i+1)->first();

            Log::debug('before procedure : ');
            Log::debug($procedure);

            $procedure->procedure_data = json_encode($procedures[$i]['procedure_data']);
            $procedure->update();
        }

        return response()->json([
            'message' => 'success!'
        ]);
    }

    public function create(){
        Log::debug("ProceduresController add");

        $request = Request::all();
        Log::debug($request);

        $procedure = new Procedure;
        $procedure->training_id = $request['trainingId'];
        $request['description'] === NULL ? $procedure->description = '' : $procedure->description = $request['description'];
        $request['procedure_data'] === NULL ? $procedure->procedure_data = '' : $procedure->procedure_data = $request['procedure_data'];
        $procedure->save();

        return response()->json([
            'message' => 'success!'
            ,'procedureId' => $procedure->id
        ]);
    }

}
