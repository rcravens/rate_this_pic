<?php path()->require_root( "/views/layout/_page_head.view.php" ) ?>
<?php path()->require_root( "/views/layout/_nav.view.php" ) ?>
<?php path()->require_root( "/views/layout/_header.view.php" ) ?>

<?php if ( isset( $_page_content ) ): ?>
	<?= $_page_content ?>
<?php endif; ?>

<?php path()->require_root( "/views/layout/_page_foot.view.php" ) ?>