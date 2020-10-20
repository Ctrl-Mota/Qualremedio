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
          <input type="hidden" id="med_nm_recap" name="grecaptcha" value="">
            <div class="row">
              <div class="col-md-8 form-group">
                <input name="name" type="text" maxlength="50" minlength="3" class="form-control" placeholder="Nome*" required>
              </div>
              <div class="col-md-4 form-group">
                <input name="age" type="number" onkeypress="if(this.value.length==2) return false;" class="form-control" placeholder="Idade*" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group">
                <input type="email" class="form-control" name="email" placeholder="Email*" required>
                <span class="ml-2" style="color: gray; font-size: 10px">*o email é apenas para controle de avaliação, não será utilizado para nenhuma outra finalidade!</span>
              </div>
            </div>
          <div class="row">
            <div class="col-md-6">
              <fieldset class="border p-2">
                <legend class="w-auto" style="font-size:medium">Eficiência</legend>
                <div id="eficiency_note" class="rating">
                  @include('includes.flashlight-rating')
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
                <legend class="w-auto" style="font-size:x-large">Avaliação geral*</legend>
                <div id="satisfaction_note" class="rating" style="height: 35px; line-height:35px; font-size: 35px;">
                    @include('includes.star-rating')
                </div>
              </fieldset>
            </div>
          </div>
          <div class="row errorMsg" style="color: white; background-color: red; border-radius: 6px; font-size:small;opacity:0.8">
          </div>
          <div class="modal-footer">
            <div class="spinner-border ml-auto" id="loadsave" style="display:none" role="status" aria-hidden="true"></div>
              <button type="submit" id="btnsave" class="btn btn-primary">Avaliar</button>
              
          </div>
          </form>

          </div>
        </div>
      </div>
    </div>
</div>