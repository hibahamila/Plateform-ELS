<div class="modal fade" id="EditRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel">Modifier un rôle</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('admin.roles.update', $role->id)); ?>" method="POST" id="editRoleForm" data-role-id="<?php echo e($role->id); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row g-2">
                        <div class="mb-3 col-md-12">
                            <label for="roleName">Nom du rôle</label>
                            <input class="form-control" type="text" id="roleName" name="name" required value="<?php echo e(old('name', $role->name)); ?>" autocomplete="off">
                        </div>

                        <!-- Section Permissions avec accordéon -->
                        <div class="col-xl-12">
                            <div class="accordion" id="permissionsAccordion">
                                <!-- Section Assigner des Permissions -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#assignPermissionsSection">
                                            Permissions disponibles
                                        </button>
                                    </h2>
                                    <div id="assignPermissionsSection" class="accordion-collapse collapse show" data-bs-parent="#permissionsAccordion">
                                        <div class="accordion-body">
                                            <div class="mb-3">
                                                <select class="js-example-basic-multiple col-sm-12" name="assign_permissions[]" multiple="multiple">
                                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section Supprimer des Permissions -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#removePermissionsSection">
                                            Permissions assignées
                                        </button>
                                    </h2>
                                    <div id="removePermissionsSection" class="accordion-collapse collapse" data-bs-parent="#permissionsAccordion">
                                        <div class="accordion-body">
                                            <div class="mb-3">
                                                <?php if($role->permissions->isNotEmpty()): ?>
                                                <select class="js-example-basic-multiple col-sm-12" name="remove_permissions[]" multiple="multiple">

                                                        <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php else: ?>
                                                    <p class="text-muted">Aucune permission assigné.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-secondary" type="submit">Modifier</button>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views\admin\Role\edit.blade.php ENDPATH**/ ?>