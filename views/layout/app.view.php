<?php require __DIR__ . "/../layout/_page_head.view.php" ?>
<?php require __DIR__ . "/../layout/_nav.view.php" ?>
<?php require __DIR__ . "/../layout/_header.view.php" ?>

<?php if ( isset( $page_content ) ): ?>
	<?= $page_content ?>
<?php endif; ?>

<?php require __DIR__ . "/../layout/_page_foot.view.php" ?>