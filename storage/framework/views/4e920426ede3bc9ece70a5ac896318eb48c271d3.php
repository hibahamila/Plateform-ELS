
<div class="container mt-4 todo" id="roles_Permission">

    <div class="card">
        <div class="card-header">
            <h5>Informations de l'utilisateur</h5>
        </div>
        <div class="card-body">
            <h6><strong>Nom :</strong> <?php echo e($user->name); ?></h6>
            <h6><strong>Prénom :</strong> <?php echo e($user->lastname); ?></h6>
            <h6><strong>Email :</strong> <?php echo e($user->email); ?></h6>


            <hr>
            <h5>Rôles Actuels</h5>
            <?php if($user->roles->isNotEmpty()): ?>
                <div class="todo-list-container mb-3">
                    <div class="todo-list-body">
                        <ul id="roles-list" class="todo-list">
                            <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="task">
                                    <div class="task-container">
                                        <h4 class="task-label"><?php echo e($user_role->name); ?></h4>
                                        <span class="task-action-btn">
                                            <form method="POST" action="<?php echo e(route('admin.users.roles.remove', [$user->id, $user_role->id])); ?>" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <span class="action-box large delete-btn" title="Supprimer le rôle">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </form>
                                        </span>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-muted">Aucun rôle assigné.</p>
            <?php endif; ?>

            <hr>

            <h5>Permissions Actuelles</h5>
            <?php if($user->permissions->isNotEmpty() || $user->roles->isNotEmpty()): ?>
                <div class="todo-list-container mb-3">
                    <div class="todo-list-body">
                        <ul id="permissions-list" class="todo-list">
                            <?php $__currentLoopData = $user->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="task">
                                    <div class="task-container">
                                        <h4 class="task-label"><?php echo e($user_permission->name); ?></h4>
                                        <span class="task-action-btn">
                                            <form method="POST" action="<?php echo e(route('admin.users.permissions.revoke', [$user->id, $user_permission->id])); ?>" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <span class="action-box large delete-btn" title="Supprimer la permission">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </form>
                                        </span>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!$user->permissions->contains($permission)): ?>
                                        <li class="task">
                                            <div class="task-container">
                                                <h4 class="task-label"><?php echo e($permission->name); ?></h4>
                                                <span class="task-action-btn">
                                                    <form method="POST" action="<?php echo e(route('admin.users.permissions.revoke', [$user->id, $permission->id])); ?>" style="display: inline;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <span class="action-box large delete-btn" title="Supprimer la permission">
                                                            <i class="fa fa-trash"></i>
                                                        </span>
                                                    </form>
                                                </span>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-muted">Aucune permission assignée.</p>
            <?php endif; ?>

        </div>
    </div>
</div>



<?php /**PATH C:\Users\hibah\PFE\plateformeEls\resources\views\admin\user\roles.blade.php ENDPATH**/ ?>