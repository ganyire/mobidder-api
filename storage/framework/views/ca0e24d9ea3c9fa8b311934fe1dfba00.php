# <?php echo e(__("scribe::headers.auth")); ?>


<?php if(!$isAuthed): ?>
<?php echo __("scribe::no_auth"); ?>

<?php else: ?>
<?php echo $authDescription; ?>


<?php echo $extraAuthInfo; ?>

<?php endif; ?>
<?php /**PATH /var/www/html/server-bid-app/vendor/knuckleswtf/scribe/src/../resources/views//markdown/auth.blade.php ENDPATH**/ ?>