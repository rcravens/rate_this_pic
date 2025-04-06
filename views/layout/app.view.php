<?php require ROOT_PATH . "/views/layout/_page_head.view.php" ?>
<?php require ROOT_PATH . "/views/layout/_nav.view.php" ?>
<?php require ROOT_PATH . "/views/layout/_header.view.php" ?>

<?php if ( isset( $_page_content ) ): ?>
	<?= $_page_content ?>
<?php endif; ?>

<?php require ROOT_PATH . "/views/layout/_page_foot.view.php" ?>