@if(Auth::user()->id===$post->user_id)
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Elimina
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Conferma Cancellazione Dati</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Vuoi eliminare questo contenuto? Non potrai più recuperarlo.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button> 
           <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" data-bs-dismiss="modal" type="submit">Elimina Record</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  @endif
  