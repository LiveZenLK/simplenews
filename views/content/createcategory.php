<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading"><?php echo lang('simplenews_fix_the_following_errors'); ?></h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<div class="admin-box">
	<?php //echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>
    
    <fieldset>
	<div class="form-actions">
	
	<!-- BO Hidden Values -->
	<input type="hidden" name="id" value="" /><br />
	<!-- EO Hidden Values -->
	
	<!-- BO Name -->	
    <div class="control-group">
	    <label class="control-label">simplenews_category_name</label>
        <div class="controls">
		<?php echo form_input('category_name', ''); ?>
        </div>
	</div>
	<!-- EO Name -->
	
	<!-- BO category_order -->
    <div class="control-group">
	    <label class="control-label">category_order</label>
        <div class="controls">
		<?php echo form_input('category_order', ''); ?>
        </div>
	</div>
	<!-- EO category_order -->
	
	<!-- BO category_image -->
    <div class="control-group">
	    <label class="control-label">category_image</label>
        <div class="controls">
		<?php echo form_input('category_image', ''); ?>
        </div>
	</div>
	<!-- EO category_image -->
	
	
	<input type="submit" name="submit" class="btn btn-primary" value="insert" />
	<?php echo anchor(SITE_AREA .'/content/simplenews/', lang('simplenews_cancel'), 'class="btn btn-warning"'); ?>
	</div>
	
	</fieldset>
    <?php echo form_close(); ?>
</div>