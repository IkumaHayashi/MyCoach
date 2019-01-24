<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use Validator;

class TrainingsController extends Controller
{
    public function index(){
        $trainings = Training::orderBy('created_at', 'asc')->get();
        return view('trainings/trainings',[
            'trainings' => $trainings
        ]);
    }

    public function new(){
        $training = Training::find(1);
        return view('trainings/new',[
            'training' => $training
        ]);
    }

    public function edit(Training $training){
        return view('trainings/edit');
    }

    public function add(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'Title' => 'required|max:100|min:1',
            'DurationMinutes' => 'required|max:120|min:1',
            'RecomendedPersonNumber' => 'required||min:1',
            'VideoUrl' => 'required||url',
        ]);

        //バリデーション： エラー
        if ($validator->fails()) {
            return redirect('/trainings/new')
            ->withInput()
            ->withErrors($validator);
        }
        //Eloquentモデル
        $training = new Training;
        $training->Title = $request->Title;
        $training->DurationMinutes = $request->DurationMinutes;
        $training->RecomendedPersonNumber = $request->RecomendedPersonNumber;
        $training->VideoUrl = $request->VideoUrl;
        $training->save();
        return redirect('/');

    }

    public function delete(Training $training){
        $training->delete();
        return redirect('/');
    }


}
