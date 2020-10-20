@extends('master.template')
@section('hero')
    <!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-cntent-center align-items-center">
  <div id="heroCarousel" class="container carousel carousel-fade " data-ride="carousel"  data-interval="6000">
    {{-- transformar isso em uma coleção para ser trazida do DB --}}
    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="carousel-container">
        <h2 class="animated fadeInDown">Conheça outras experiências</h2>
        <p class="animated fadeInUp">Mais de 8 Mil medicamentos distintos para você ter a visão de quem ja se medicou.</p>
        <a href="#search-med" class="btn-get-started animated fadeInUp scrollto">Pesquise <i class="fas fa-arrow-down"></i></a>
      </div>
    </div>
    <div class="carousel-item ">
      <div class="carousel-container">
        <h2 class="animated fadeInDown">Seja Bem vindo</h2>
        <p class="animated fadeInUp">Aqui você participa da primeira rede de compartilhamento de experiências com qualquer um dos medicamentos brasileiro registrados na anvisa.</p>
        {{-- <a href="#about" class="btn-get-started animated f adeInUp scrollto">Leia Mais</a> --}}
      </div>
    </div>
<!-- Slide 2-->
<div class="carousel-item">
      <div class="carousel-container">
        <h2 class="animated fadeInDown">Todos Medicamentos são registrados pela ANVISA</h2>
        <p class="animated fadeInUp">Todos os medicamentos apresentados são fiscalizados pela anvisa e possuem seu registro válido.</p>
        <a href="http://portal.anvisa.gov.br/medicamentos" class="btn-get-started animated fadeInUp scrollto">Veja mais</a>
      </div>
    </div>
    <!-- Slide 3 -->
    

    <!-- Slide 4 -->
    <div class="carousel-item">
      <div class="carousel-container">
        <h2 class="animated fadeInDown">Seja responsável!</h2>
        <p class="animated fadeInUp">Antes de dar uma avaliação ou comentário, tenha consciência sobre o que irá escrever, a saúde de outro está em jogo.</p>
        {{--<a href="#about" class="btn-get-started animated fadeInUp scrollto">Read More</a>--}}
      </div>
    </div>
    

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

  </div>
</section>
@endsection

@section('content')
<section id="search-med" class="contact">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2><a style="color: #f6b024">Qual Remédio</a> deseja encontrar</h2>
    </div>

    <div class="row mt-1 d-flex" data-aos="fade-right" data-aos-delay="100" id="formsearch">
      <div class="col-lg-12 my-3 mt-lg-0" data-aos="fade-left" data-aos-delay="100">
        <form name="nomemed" data-grecaptcha-action="message" method="POST" class="php-email-form">
          @csrf
          {{-- <input type="hidden" id="med_nm_recap" name="grecaptcha" value=""> --}}
          <div class="form-row justify-content-center" style="background: transparent">
            <div class="col-md-9 form-group">
              <input type="text" name="med_nm" class="form-control" id="nm_medicamento" placeholder="Pesquisa por nome"  maxlength="100" minlength="3" required/>
              <div class="validateM"></div>
            </div>
            <div class="col-md-1">
              <button type="submit" class="btnsearch" id="btnnomemed"><i class="fas fa-search"></i></button>
              <div class="spinner-border loadnomemed ml-auto" style="display:none" role="status" aria-hidden="true"></div>
            </div>
          </div>
        </form>
      </div>

      <div class="col-lg-12 my-3 mt-lg-0" data-aos="fade-left" data-aos-delay="100">
        <form name="activeprinc"  method="POST" role="form" class="php-email-form">
          @csrf
          <div class="form-row justify-content-center">
            <div class="col-md-9 form-group">
              <input type="text" name="activeprinc" class="form-control" id="name" placeholder="Pesquisa por Princípio Ativo"  maxlength="500"  minlength="2" required/>
              <div class="validateA"></div>
            </div>
            <div class="col-md-1">
              <button type="submit" class="btnsearch" id="btnactiveprinc"><i class="fas fa-search"></i></button>
            <div class="spinner-border loadactiveprinc ml-auto" style="display:none" role="status" aria-hidden="true"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<section id="top10" class="services">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Top 10 mais utilizados</h2>
            <p>Aqui estão listados os 10 medicamentos mais utilizados em 2020 no Brasil</p>
        </div>
        <div class="row">
            @foreach ($top10 as $med)
            @php
                $medi = App\Meds::where('nm_med', $med)->first();
                $slug = $medi['slug'];

            @endphp
            <div class="col-md-6 align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="icon-box">
                <i class="fas fa-pills"></i>
                <h4><a href="{{url('/medicamento/'.$slug)}}">{{$loop->iteration.'. '.ucfirst(mb_strtolower($medi['nm_med']))}}</a></h4>
                <p><strong>Princípio Ativo: </strong>{{$medi['active_princ']}}<br><strong> Classe Terapêutica: </strong>{{ucfirst(mb_strtolower($medi['therap_class']))}}</p>
                </div>
            </div>
           
    @endforeach
  </div>
</div>
</section>
       <!-- ======= Icon Boxes Section ======= -->
  <section id="tarjas" class="icon-boxes">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up">
          <div class="icon-box">
            <div class="icon"><i class="icofont-blood-drop"></i></div>
            <h4 class="title"><a href="">Tarja branca</a></h4>
            <p class="description">Os medicamentos sem tarja podem ser comprados sem a receita do médico, traz poucos riscos à saúde, tem nível baixo de toxinas.</p>
          </div>
        </div>
      </button>
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
          <div class="icon-box" style="background-color:red">
            <div class="icon"><i class="icofont-blood-drop"></i><i class="icofont-blood-drop"></i></div>
            <h4 class="title"><a href="">Tarja vermelha</a></h4>
            <p class="description" style="color:white">Essa cor indica que o medicamento é genérico, mas possui mesma composição química que o remédios mais caros, tendo igual princípio ativo; ele também vem com a letra G em cima da tarja amarela e sendo a letra na cor preta.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
          <div class="icon-box"style="background-color:yellow ">
            <div class="icon"><i class="icofont-blood-drop"></i><i class="icofont-blood-drop"></i></div>
            <h4 class="title" ><a href="" style="color:red">Tarja amarela e vermelha</a></h4>
            <p class="description">Este tipo pode exigir retenção ou não da receita médica, isso quer dizer que o farmacêutico pode reter sua receita ou não, após a venda da mesma. Seu efeito no organismo é mais lento e não traz riscos tão danosos à saúde como os de tarja preta, mas pode trazer alguns efeitos colaterais, causando mal-estar em alguns pacientes.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
          <div class="icon-box"style="background-color:black  ">
            <div class="icon"><i class="icofont-blood-drop"></i><i class="icofont-blood-drop"></i><i class="icofont-blood-drop"></i></div>
            <h4 class="title"><a href="">Tarja preta</a></h4>
            <p class="description" style="color:white">As tarjas pretas recebem esse nome por causa da faixa da mesma cor que envolve a caixa do medicamento; ele indica que seu uso deve ser feito sob prescrição e receita médica e os efeitos colaterais são danosos à saúde, pois atinge o SNC sistema nervoso central. Seu efeito é prolongado dentro do organismo e pode trazer dependência química, tem ação sedativa, e pode causar morte.</p>
          </div>
        </div>

      </div>
    </div>
</section>
<script src="{{asset('assets/js/index.js')}}"></script>

@endsection
