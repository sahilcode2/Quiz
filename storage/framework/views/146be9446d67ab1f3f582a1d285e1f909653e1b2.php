

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Notifications')); ?></div>

                    <div class="card-body">
                        <ul class="list-group">
                            <!-- <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item">
                                    Display notification details here
                                    <div><?php echo e($notification->title); ?></div>
                                    <div><?php echo e($notification->content); ?></div>
                                    Display associated user's name

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->

                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="notification">
                                    <button style="background-color:yellow; float: right;" onclick="showPopup('<?php echo e($notification->id); ?>', '<?php echo e($notification->title); ?>', '<?php echo e($notification->content); ?>')">View Notification</button>
                                    <h3><?php echo e($notification->title); ?></h3>
                                    <!-- <p><?php echo e($notification->description); ?></p> -->
                                    <hr>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <div id="popup" class="popup">
                                <div class="popup-content">
                                    <span class="close" onclick="closePopup()">&times;</span>
                                    <h2 id="popup-title"></h2>
                                    <p id="popup-description"></p>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\library-crud-app\resources\views/notification/index.blade.php ENDPATH**/ ?>