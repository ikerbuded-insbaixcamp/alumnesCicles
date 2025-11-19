<div class="card">
    <div class="card-header">{{ __('Eliminar compte') }}</div>

    <div class="card-body">
        <div class="mb-3">
            {{ __('Un cop s\'elimini el teu compte, tots els seus recursos i dades seran eliminats de manera permanent. Abans d\'eliminar el teu compte, descarrega qualsevol dada o informació que vulguis conservar.') }}
        </div>

        <div class="row mb-0">
            <div class="col-md-6">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    {{ __('Eliminar compte') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteAccountModalLabel">
            {{ __('Estàs segur que vols eliminar el teu compte?') }}
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tancar"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            {{ __('Un cop s\'elimini el teu compte, tots els seus recursos i dades seran eliminats de manera permanent. Introdueix la teva contrasenya per confirmar que vols eliminar el teu compte de manera permanent.') }}
        </div>
        <form id="deleteAccountForm" method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div>
                <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" name="password" placeholder="{{ __('Contrasenya') }}" required>

                @error('password', 'userDeletion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            {{ __('Cancel·lar') }}
        </button>
        <button type="submit" class="btn btn-danger" form="deleteAccountForm">
            {{ __('Eliminar compte') }}
        </button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
    @php $shouldOpenModal = $errors->userDeletion->isNotEmpty(); @endphp

    <script>
        let shouldOpenModal = {{ Js::from($shouldOpenModal) }};

        if (shouldOpenModal) {
            window.addEventListener('load', function() {
                let deleteAccountModal = new bootstrap.Modal('#deleteAccountModal');
                deleteAccountModal.toggle();
            });
        }
    </script>
@endPush
