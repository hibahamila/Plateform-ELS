<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Gestion des Rôles</h5>
        <a id="open-create-role-modal" data-create-url="<?php echo e(route('admin.roles.create')); ?>" class="btn btn-success">Créer un Nouveau Rôle</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="roles-table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Nom du Rôle</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($role->name); ?></td>
                        <td >
                            <i class="icofont icofont-edit edit-icon action-icon" data-edit-url="<?php echo e(route('admin.roles.edit', $role->id)); ?>" style="cursor: pointer;"></i>
                            <i class="icofont icofont-ui-delete delete-icon action-icon" data-delete-url="<?php echo e(route('admin.roles.destroy', $role->id)); ?>" data-csrf="<?php echo e(csrf_token()); ?>" style="cursor: pointer; color: rgb(204, 28, 28);"></i>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views\admin\Role\index.blade.php ENDPATH**/ ?>