<div class="sidebar">

    <h3 class="sidebar-title">Avaliados mais vezes</h3>
    <div class="sidebar-item categories">
      <ul>
        @foreach ($AV_moreTimes as $med)
      <li title="{{$med['nm_med']}}"><a href="{{url('/medicamento/'.$med['slug'])}}"><span>{{\Illuminate\Support\Str::limit($med['nm_med'], 16, '...')}} ({{$med['count_av']}})</span></a></li>
            
        @endforeach
       
      </ul>

    </div>
    <div class="row Dsocialmedia">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="fab fa-facebook" target="_blank" rel="noopener"></a>
            <a href="https://twitter.com/share?ref_src={{url()->current()}}" class="fab fa-twitter"></a>
            <a href="https://api.whatsapp.com/send?text={{url()->current()}}" class="fab fa-whatsapp"></a>
    </div>
   
    {{-- <h3 class="sidebar-title">Recent Posts</h3>
    <div class="sidebar-item recent-posts">
      <div class="post-item clearfix">
        <img src="{{asset('assets/img/blog-recent-1.jpg')}}" alt="">
        <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
        <time datetime="2020-01-01">Jan 1, 2020</time>
      </div>

      <div class="post-item clearfix">
        <img src="{{asset('assets/img/blog-recent-2.jpg')}}" alt="">
        <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
        <time datetime="2020-01-01">Jan 1, 2020</time>
      </div>

      <div class="post-item clearfix">
        <img src="{{asset('assets/img/blog-recent-3.jpg')}}" alt="">
        <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
        <time datetime="2020-01-01">Jan 1, 2020</time>
      </div>

      <div class="post-item clearfix">
        <img src="{{asset('assets/img/blog-recent-4.jpg')}}" alt="">
        <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
        <time datetime="2020-01-01">Jan 1, 2020</time>
      </div>

      <div class="post-item clearfix">
        <img src="{{asset('assets/img/blog-recent-5.jpg')}}" alt="">
        <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
        <time datetime="2020-01-01">Jan 1, 2020</time>
      </div>

    </div> --}}

    {{-- <h3 class="sidebar-title">Principios ativos mais procurados</h3>
    <div class="sidebar-item tags">
      <ul>
        <li><a href="#">App</a></li>
        <li><a href="#">IT</a></li>
        <li><a href="#">Business</a></li>
        <li><a href="#">Business</a></li>
        <li><a href="#">Mac</a></li>
        <li><a href="#">Design</a></li>
        <li><a href="#">Office</a></li>
        <li><a href="#">Creative</a></li>
        <li><a href="#">Studio</a></li>
        <li><a href="#">Smart</a></li>
        <li><a href="#">Tips</a></li>
        <li><a href="#">Marketing</a></li>
      </ul>
    </div> --}}
  </div>