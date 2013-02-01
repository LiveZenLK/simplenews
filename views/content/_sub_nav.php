<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/simplenews') ?>" id="list"><?php echo lang('simplenews_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Simplenews.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/simplenews/create') ?>" id="create_new"><?php echo lang('simplenews_new'); ?></a>
	</li>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/simplenews/createcategory') ?>" id="create_new"><?php echo lang('simplenews_create_category'); ?></a>
	</li>
	<?php endif; ?>
</ul>