<div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouvel utilisateur</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-bookmark needs-validation" id="createUserForm" method="POST" action="<?php echo e(route('admin.users.store')); ?>" novalidate>
                    <?php echo csrf_field(); ?>
                    <div class="row g-2">
                        <div class="mb-3 col-md-12 mt-0">
                            <label for="first_name">Prénom</label>
                            <input class="form-control" id="first_name" name="name" type="text" required placeholder="Prénom" autocomplete="off" />
                            <div class="invalid-feedback">Veuillez entrer un prénom.</div>
                        </div>
                        <div class="mb-3 col-md-12 mt-0">
                            <label for="last_name">Nom</label>
                            <input class="form-control" id="last_name" name="lastname" type="text" required placeholder="Nom" autocomplete="off" />
                            <div class="invalid-feedback">Veuillez entrer un nom.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="phone">Numéro de téléphone</label>

                                <div class="input-group">
                                    <span class="input-group-text" id="country-code">
                                        <i class="flag-icon flag-icon-tn"></i>
                                        <span class="ms-1">TN</span>
                                    </span>

                                    <input
                                        type="tel"
                                        class="form-control"
                                        id="phone"
                                        name="phone"
                                        placeholder="92 125 420"
                                        aria-describedby="country-code phoneHelpText"
                                        required
                                    >

                                    <div class="invalid-feedback">
                                        Veuillez entrer un numéro de téléphone valide.
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="mb-3 col-md-12 mt-0">
                            <label for="email">Adresse Email</label>
                            <input class="form-control" id="email" name="email" type="email" required autocomplete="off" />
                            <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
                        </div>
                        <div class="mb-3 col-md-12 mt-0">
                            <label for="role_id">Rôle</label>
                            <select class="form-control" id="role_id" name="roles" required>
                                <?php if(auth()->user()->hasRole('admin')): ?>

                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($role->name === 'professeur'): ?>
                                            <option value="<?php echo e($role->id); ?>" selected><?php echo e($role->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php elseif(auth()->user()->hasRole('super-admin')): ?>
                                    <option value="" disabled selected>Sélectionnez un rôle</option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">Veuillez sélectionner un rôle.</div>
                        </div>

                        <input type="hidden" name="password_auto_generate" value="1">
                    </div>
                    <button class="btn btn-primary" type="submit">Enregistrer</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/user/create.blade.php ENDPATH**/ ?>