<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Comentario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('comentario.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="mb-3">
            <label for="" class="form-label">nombre</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="" aria-describedby="helpId" placeholder="">
            @error('nombre')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="" class="form-label">descripcion</label>
            <input type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="" aria-describedby="helpId" placeholder="">
            @error('descripcion')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="" class="form-label">mejora</label>
            <input type="text" class="form-control @error('mejora') is-invalid @enderror" name="mejora" id="" aria-describedby="helpId" placeholder="">
            @error('mejora')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
