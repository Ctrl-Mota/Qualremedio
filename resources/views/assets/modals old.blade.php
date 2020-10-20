{{-- Modal Comment --}}
<div class="container-fluid">
<div class="modal fade" id="modalcomment" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="preload-comment" style="display: none"></div>
    <div class="modal-content">
      <div class="modal-header" style="background: transparent">
        <h5 class="modal-title">Avalie sua experiência com o <b>{{ucfirst(mb_strtolower($name_med))}}</b></h5><br>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form name="comment" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-8 form-group">
                <input name="name" type="text" maxlength="50" minlength="3" class="form-control" placeholder="Seu Nome*" required>
              </div>
              <div class="col-md-4 form-group">
                <input name="age" type="number" onkeypress="if(this.value.length==2) return false;" class="form-control" placeholder="Idade*" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group">
              <textarea rows="3" maxlength="1000" class="form-control" placeholder="Comente algo sobre {{ucfirst(mb_strtolower($name_med))}}" name="content"></textarea>
              </div>
            </div>
          <div class="row">
            <div class="col-md-6">
              <fieldset class="border p-2">
                <legend class="w-auto" style="font-size:medium">Eficiência</legend>
                <div id="cost-benefic_note" class="rating">
                  @include('includes.money-rating')
                </div>
              </fieldset>
            </div>
            <div class="col-md-6">
              <fieldset class="border p-2">
                <legend class="w-auto" style="font-size:medium">Efeitos colareais</legend>
                <div id="sideEffects_note" class="rating">
                    @include('includes.face-rating')
                </div>
              </fieldset>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-md-12">
              <fieldset class="border p-2">
                <legend class="w-auto" style="font-size:x-large">Avaliação geral</legend>
                <div id="satisfaction_note" class="rating" style="height: 35px; line-height:35px; font-size: 35px;">
                    @include('includes.star-rating')
                </div>
              </fieldset>
            </div>
          </div>
          <div class="modal-footer">
            
                <button type="submit"  class="btn btn-primary">Avaliar</button>
            </div>
          </form>

          </div>
        </div>
      </div>
    </div>
</div>
{{-- Modal Reply --}}
<div class="container-fluid">
  <div class="modal fade" id="modalreply" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="preload-reply" style="display: none"></div>
      <div class="modal-content">
        <div class="modal-header" style="background: transparent">
          <h5 class="modal-title">Responder o comentario de <b class="breply"></b></h5><br>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form name="reply" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-8 form-group">
                  <input name="name" type="text" maxlength="50" minlength="3" class="form-control" placeholder="Seu Nome*" required>
                </div>
                <div class="col-md-4 form-group">
                  <input name="age" type="number" onkeypress="if(this.value.length==2) return false;" class="form-control" placeholder="Idade*" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                <textarea name="content" rows="3" maxlength="1000" class="form-control" placeholder="Responda" ></textarea>
                </div>
              </div>
              <input type="hidden" name="sluger" value="">
            <div class="modal-footer">
                  <button type="submit"  class="btn btn-primary">Responder</button>
              </div>
            </form>
  
            </div>
          </div>
        </div>
      </div>
  </div>
