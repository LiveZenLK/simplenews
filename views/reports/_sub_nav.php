<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/simplenews') ?>" id="list"><?php echo lang('simplenews_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Simplenews.Reports.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/reports/simplenews/create') ?>" id="create_new"><?php echo lang('simplenews_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>