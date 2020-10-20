@extends('master.template')
@section('recap')
  <meta name="grecaptcha-key" content="{{config('recaptcha.v3.public_key')}}">
  <script src="https://www.google.com/recaptcha/api.js?render={{config('recaptcha.v3.public_key')}}"></script>
@endsection

@section('content')
@include('assets.modals')

 <!-- ======= Breadcrumbs ======= -->
 <section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="{{route('index')}}#header">Pagina inicial</a></li>
      <li><a href="{{route('activeP',$active_princ)}}">Princípio ativo</a></li>
    </ol>
        <h2 class="medsingle" content="{{$name_med}}" >{{ucfirst($name_med)}}</h2>
  </div>
</section><!-- End Breadcrumbs -->
    <section id="blog" class="blog">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 ">
            <article title="Avaliações" >
              <div class="row">
                <div class="col-md-10">
                  <h3 style="font-size: larger;font-weight: bold">Avaliação média</h3>
                </div>
                <div class="col-md-2">
                <a href="" id="avalienow">Avalie agora</a>
                </div>
               </div>
              <div class="row mx-1 my-3">
                <div class="col-md-4">
                  <fieldset class="border p-1">
                    <legend class="w-auto" style="font-size:medium">Avaliação Geral 
                      <b title=" {{round($satisfaction_note,1)  == 0 ? 'Avaliações insuficientes para gerar uma média':round($satisfaction_note,1)}}" style="font-size:small;font-family:arial;margin-left:1em "> Nota média: {{round($satisfaction_note,1) == 0 ? '...':round($satisfaction_note,1) }}</b>
                    </legend>
                    <span name="ratefix-G" note="{{round($satisfaction_note)}}" style="{{round($satisfaction_note,1) == 0 ? 'opacity:0.6': ''}}" id="satisfaction_note" class="rating">
                      @include('includes.star-rating')
                    </span>
                  </fieldset>
                </div>
                <div class="col-md-4">
                  <fieldset class="border p-1">
                    <legend class="w-auto" style="font-size:medium">Efeito Colateral 
                      <b title=" {{round($sideEffects_note,1)  == 0 ? 'Avaliações insuficientes para gerar uma média':round($sideEffects_note,1)}}"style="font-size:small;font-family:arial;margin-left:1em ">Nota média: {{round($sideEffects_note,1) == 0 ? '...':round($sideEffects_note,1)}}</b></legend>
                    <span name="ratefix-SE" note="{{round($sideEffects_note)}}" style="{{round($satisfaction_note,1) == 0 ? 'opacity:0.6': ''}}" id="sideEffects_note" class="rating">
                      @include('includes.face-rating')
                    </span>
                  </fieldset>
                </div>
                <div class="col-md-4">
                  <fieldset class="border p-1">
                    <legend class="w-auto" style="font-size:medium">Eficiência 
                      <b title=" {{round($eficiency_note,1)  == 0 ? 'Avaliações insuficientes para gerar uma média':round($eficiency_note,1)}}" style="font-size:small;font-family:arial;margin-left:1em ">Nota média: {{round($eficiency_note,1)  == 0 ? '...':round($eficiency_note,1)}}</b></legend>
                    <span name="ratefix-E" note="{{round($eficiency_note)}}" style="{{round($satisfaction_note,1) == 0 ? 'opacity:0.6': ''}}" id="eficiency_note" class="rating">
                      @include('includes.flashlight-rating')
                    </span>
                  </fieldset>
                </div>
              </div>
           
            </article>
            <div class="row my-1 mx-1 Msocialmedia">
                  <a href="" id="share"><i class="fas fa-share-alt"></i> Compartilhar</a>
              </div>
            <article id="table" class="entry entry-single">
              <div class="table-responsive">
                <table id="dataTables" class="table-sm  table-striped" style="width: 100%" >
                  <thead class="thead-dark">
                    <tr role="row">
                      <th scope="col" title="Nome do medicamento">Medicamento</th>
                      <th scope="col" title="Substância ativa">Princípio Ativo</th>
                      <th scope="col" title="Laboratório">Detentor</th>
                      <th scope="col" title="classe terapêutica">classe terapêutica</th>
                      <th scope="col" title="Tipo de medicamento">Tipo</th>
                      <th scope="col" title="Preço inicial cadastrado na anvisa">Preço S/ imposto</th>
                      <th scope="col" title="Tarja">Tarja</th>
                    </tr>
                  </thead>
                    <tbody style="font-weight: 50">
        
                      @foreach ($meds as $med)
                      <tr role="row" class="odd parent">
                        <td scope="row">{{ucfirst(mb_strtolower($med->nm_med))}}</td>
                        <td>{{mb_strtolower($med->active_princ,'UTF-8')}} </td>
                        <td>{{mb_strtolower($med->lab)}}</td>
                        <td>{{mb_strtolower($med->therap_class)}}</td>
                        <td>{{mb_strtolower($med->type_med)}}</td>
                        <td>R$ {{str_replace('.',',',$med->cost)}}</td>
                        <td>{{$med->stripe}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
              <hr>
              <div class="d-flex justify-content-between align-items-center">
              <a href="https://consultas.anvisa.gov.br/#/medicamentos/q/?nomeProduto={{$name_med}}"><i class="fas fa-info-circle"></i> Mais detalhes no site da ANVISA</a>
              <button type="button"  title="" id="av-btn" data-toggle="modal" data-target="#modalcomment" class="btn btn-primary  mx-3">Avaliar <i class="fas fa-star"></i></button>
              <button typ="button"  id="avcheck" style="display: none;pointer-events: none" class="btn btn-success float-right mx-3" >Avaliado <i class="far fa-check-circle"></i></button>
              </div>
            </article>
             
            <article  class="entry entry-single">
              <h3 style="font-size: large">Comentarios de quem ja usou <b> {{ucfirst($name_med)}}</b></h3>
              <br>
              <div id="disqus_thread"></div>
            </article>
              {{-- <div class="blog-comments">
              </div>  --}}
            {{-- <p style="text-align: center" ><a href="#" id="loadmore">Ver Mais</p> --}}
          </div>
          <div class="col-lg-3">
            @include('includes.sidebar')
          </div>
        </div>
      </div>
    </section>

    <script src="{{asset('assets/js/medSingle.js')}}"></script>
    <script src="{{asset('assets/js/disqus-comments.js')}}"></script>
@endsection