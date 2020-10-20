@extends('master.template')

@section('content')
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
  
      <ol>
        <li><a href="{{route('index')}}#header">Pagina inicial</a></li>
      </ol>
    <h2>Resultados de {{ucfirst($active_princ)}} </h2>
    </div>
  </section><!-- End Breadcrumbs -->
      <section id="blog" class="blog">
        <div class="container">
          <div class="row ">
            <div class="col-lg-9 ">
              <article class="entry entry-single">
                <div class="table-responsive">
                  <table id="dataTables" class="table-sm  table-striped" style="width: 100%" >
                    <thead class="thead-dark">
                      <tr role="row">
                          <th scope="col">Princípio Ativo</th>
                          <th scope="col">Medicamento</th>
                        <th scope="col">Detentor</th>
                        <th scope="col">classe terapeutica</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Preço S/ imposto</th>
                        <th scope="col">Tarja</th>
                      </tr>
                    </thead>
                      <tbody style="font-weight: 50">
          
                        @foreach ($active_princs as $med)
                        <tr role="row" class="odd">
                        <td data-toggle="popover"  data-content="" >{{mb_strtolower($med->active_princ,'UTF-8')}} </td>
                        <td scope="row"><a href="{{url('/medicamento/'.$med->slug)}}">{{ucfirst(mb_strtolower($med->nm_med))}}</td>
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
              </article>
            </div>
            <div class="col-lg-3">
              @include('includes.sidebar')
            </div>
  
            </div><!-- End blog sidebar -->
  
          </div>
  
        </div>
      </section><!-- End Blog Section -->
<script src="{{asset('assets/js/active_princ.js')}}"></script>
  
@endsection