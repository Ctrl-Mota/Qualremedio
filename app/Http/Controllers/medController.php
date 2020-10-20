<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\searchRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Comment;
use App\Meds;
use App\Rules\ReCAPTCHAv3;

class medController extends Controller
{
   public function index()
   {
      $data['top10'] = collect(['xarelto','aradois','Citrato de Sildenafila','torsilax','diovan','tadalafila','glifage','saxenda','galvus','sinvastatina']);

      $data['seohead'] = $this->seo->optimize(
         'Qual Remédio ?',//title
         'Clique e descubra quais experiencias outras pessoas já tiveram com o remédio que você procura ou pretende usar e retire suas dúvidas sobre qualquer medicamento.',//description
         'https://qualremedium.com.br',//home
         asset('assets/img/qualremedioicon.jpg'),//foto de chamada
         'qualremedioicon/jpeg',
         '800',
         '600'
         )->openGraph(
            'Qual Remédio',
            'pt_BR',
            'website'
         )->render();

    return view('assets.index',$data);
   }
   public function search(Request $request )
   {
      $searchForm = $request->all();
      if(isset($searchForm['med_nm'])){
         $nomemedicamento = filter_var($searchForm['med_nm'], FILTER_SANITIZE_STRING);

         $validator = Validator::make($searchForm, [
            'med_nm' => 'required|max:100|min:3',
            // 'grecaptcha' => ['required', new ReCAPTCHAv3],
        ]);
        if ($validator->fails()) {
           $data['validatorM'] =  false;
         return json_encode($data);
          }
         $med = Meds::where('nm_med',$nomemedicamento)->first();

         if($med != null){
            $data['redirect'] = route('single',$med['slug']);
         }else{
            $data['search_med'] = 'not_found';
         }

         return json_encode($data);
      }
      if(isset($searchForm['activeprinc'])){
         $active_princ = filter_var($searchForm['activeprinc'], FILTER_SANITIZE_STRING);

         $validator = Validator::make($searchForm, [
            'activeprinc' => 'required|max:500|min:2',
         ]);
         if ($validator->fails()) {
            $data['validatorA'] =  false;
         return json_encode($data);
         }

         $verify= Meds::where('active_princ','LIKE','%'.$active_princ.'%')->first();
         if($verify != null){
            $data['redirect']  = route('activeP',$active_princ);
         }else{
            $data['search_activeP'] = 'not_found';
         }
         return json_encode($data);
         
      }
   }
  public function activeP(Request $request,$active_princ)
  {
   $data['active_princs']= Meds::where('active_princ','LIKE','%'.$active_princ.'%')->orderBy('active_princ','asc')->get();
   if($data['active_princs']->first() == null){
      return redirect()->route('index');
   }
   $data['AV_moreTimes'] = Meds::orderBy('count_av','desc')->limit(5)->get()->toarray();

   $data['active_princ'] = $active_princ;
   $data['seohead'] = $this->seo->optimize(
      'Qual Remédio? - Princípio Ativo ',//title
      'Descubra quais remedios possuem '.$active_princ.' como princípio ativo',//description
      'https://qualremedium.com.br/principio-ativo/'.$data['active_princs']->first()->slug_AP,//canonical
      asset('assets/img/qualremedioicon.jpg'),//foto de chamada
      'qualremedioicon/jpeg',
      '800',
      '600'
      )->openGraph(
         'Qual Remedium',
         'pt_BR',
         'website'
      )
      ->render();
   return view('assets.active_princs',$data);
  }
   public function medSingle(Request $request, $slug)
   {
      $data['meds'] = Meds::where('slug',$slug)->orderBy('cost','asc')->get();
      if($data['meds']->first() == null){
         return redirect()->route('index');
      }
      $data['active_princ'] =  $data['meds']->first()->active_princ;
      $med = $data['meds']->first()->nm_med;   
      $avaliations = Comment::select('satisfaction_note','sideEffects_note','eficiency_note')->where('nm_med',$med)->get();
      $data['satisfaction_note'] =  $avaliations->avg('satisfaction_note');
      $data['sideEffects_note'] = $avaliations->avg('sideEffects_note');
      $data['eficiency_note'] = $avaliations->avg('eficiency_note');
      $data['AV_moreTimes'] = Meds::distinct('nm_med')->orderBy('count_av','desc')->limit(5)->get(['nm_med','slug','count_av'])->toarray();
      $data['name_med'] = mb_strtolower($med);
   
    $data['seohead'] = $this->seo->optimize(
      'Qual Remédio? - '.$data['name_med'],//title
      'Quem ja usou '.$data['name_med'].' ?  Veja se realmente vale a pena ou não utilizar esse remedio.',//description
      'https://qualremedium.com.br/medicamento/'.$slug,//canonical
      asset('assets/img/qualremedioicon.jpg'),//foto de chamada
      'qualremedioicon/jpeg',
      '800',
      '600'
      )->openGraph(
         'Qual Remedium',
         'pt_BR',
         'website'
      )
      ->render();
    return view('assets.med_single',$data);
   }
  
   
   
  
}