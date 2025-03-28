<div class="row">
    <div class="col-sm-12">
        <div class="mb-3">
            <!-- Le bouton de retour est supprimé d'ici -->
        </div>
        <form class="ajax-form" action="{{ route('profile.sendEmailVerificationCode') }}" method="POST" data-next-page="Validation du Code" data-next-url="{{ route('profile.validateCode') }}">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">Email actuel</label>
                <input class="form-control" type="email" value="{{ $user->email }}" disabled>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Nouvel Email</label>
                <input class="form-control" type="email" name="email" required>
                <small class="form-text text-muted">Un code de validation sera envoyé à cette adresse.</small>
            </div>
            <div class="form-group mb-3 d-flex gap-2">
                <button class="btn btn-outline-secondary back-btn" type="button" data-back-tab="account">
                    <i class="fa fa-arrow-left"></i> Retour
                </button>
                <button class="btn btn-primary" type="submit">Envoyer le code de validation</button>
            </div>
        </form>
    </div>
</div>
