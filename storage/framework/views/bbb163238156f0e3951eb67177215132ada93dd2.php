

<div class="card">
    <div class="card-header">
        <h5>Utilisateurs</h5>
    </div>
    <div class="card-block row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="table-responsive">
                <table class="table table-styling" id="user-table">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->lastname); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <?php if($user->roles->isNotEmpty()): ?>
                                <?php echo e($user->roles->pluck('name')->implode(', ')); ?>

                                <?php else: ?>
                                    Aucun rôle
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="media">
                                    <div class="media-body text-end icon-state switch-outline" style="margin-right: 80px;">
                                        <label class="switch" style="transform: scale(0.7); ">
                                            <input type="checkbox" class="toggle-status" data-user-id="<?php echo e($user->id); ?>" <?php echo e($user->status === 'active' ? 'checked' : ''); ?>>
                                            <span class="switch-state bg-primary"></span>
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>

                                <div class="col-sm-6 col-md-4 col-xl-3">
                                    <i class="fa fa-info-circle edit-user-icon action action-icon" data-editUser-url="<?php echo e(route('admin.users.roles', $user->id)); ?>" style="cursor: pointer;"></i>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-3">
                                    <i class="icofont icofont-ui-delete delete-user-icon action-icon" data-deleteUser-url="<?php echo e(route('admin.users.destroy', $user->id)); ?>" data-csrf="<?php echo e(csrf_token()); ?>" style="cursor: pointer; color: rgb(204, 28, 28);"></i>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views/admin/user/index.blade.php ENDPATH**/ ?>