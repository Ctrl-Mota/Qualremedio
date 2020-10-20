<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Rules\ReCAPTCHAv3;
use App\Meds;
use App\Comment;

class CommentsController extends Controller
{
    public function storeComment(Request $request)
    {
    $commentForm = $request->all();
    $meds = Meds::where('nm_med',filter_var($commentForm['med'], FILTER_SANITIZE_STRING))->get();
    $commentFilter = [
        'slug' => Str::slug('cmmt'.rand(1,10000).date('dmY')),
        'nm_med'=> $meds->first() != null ? $meds->first()->nm_med :'',
        'name' => filter_var($commentForm['name'], FILTER_SANITIZE_STRING),
        'age' => filter_var($commentForm['age'],FILTER_SANITIZE_NUMBER_INT),
        'email' => filter_var($commentForm['email'], FILTER_VALIDATE_EMAIL),
        'grecaptcha'=> $commentForm['grecaptcha'],
        'eficiency_note' => filter_var($commentForm['flashlights'],FILTER_SANITIZE_NUMBER_INT),
        'sideEffects_note' => filter_var($commentForm['faces'],FILTER_SANITIZE_NUMBER_INT),
        'satisfaction_note' => filter_var($commentForm['stars'],FILTER_SANITIZE_NUMBER_INT),
    ];
    
    $validator = Validator::make($commentFilter, [
        'nm_med' => 'required',
        'name' => 'required|max:50|min:3',
        'age' => 'required|max:2',
        'email' =>'required',
        'satisfaction_note'=>'required',
        'grecaptcha' => ['required', new ReCAPTCHAv3],
    ]);
    if ($validator->fails()) {
        $data['validator_fail'] ='Erro na inserção do comentário!';
        return json_encode($data);
    }
    $dayVote = Comment::where('nm_med',$commentFilter['nm_med'])->where('email',$commentFilter['email'])->orderBy('created_at','desc')->get()->first();
    if($dayVote != null){
        $data_inicial = date('Y-m-d',strtotime($dayVote['created_at']));
        $data_final = date("Y-m-d");
        $diferenca = strtotime($data_final) - strtotime($data_inicial);
        $dias = floor($diferenca / (60 * 60 * 24));
        if($dias < 15){
            $data['double_vote'] ='Você só poderá votar novamente nesse remedio daqui a '.(15 - $dias).' dias';
            
        }else{
            $insert= Comment::create($commentFilter);
            if($insert){
                $avaliations = Comment::select('satisfaction_note')->where('nm_med',$commentFilter['nm_med'])->get()->avg('satisfaction_note');
               
                dd($avaliations);
                $up_vote = Meds::where('nm_med',$meds->first()->nm_med)->increment(['count_av'=> 1])->update(['note'=> $avaliations->satisfaction_note]);
               
            }

            $data['save'] = true;
            
        }
    }else{
        $insert= Comment::create($commentFilter);
        if($insert){
            $avaliations = Comment::select('satisfaction_note')->where('nm_med',$commentFilter['nm_med'])->get()->avg('satisfaction_note');
            
            Meds::where('nm_med',$commentFilter['nm_med'])->increment('count_av', 1);
            Meds::where('nm_med',$commentFilter['nm_med'])->update(['note'=> round($avaliations,2)]);
           
        }
            $data['save'] = true;
    }
    return json_encode($data);
    }
}
