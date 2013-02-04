<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading"><?php echo lang('simplenews_fix_the_following_errors'); ?></h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<?php // if (isset($images) && is_array($images) && count($images)) : ?>
	
<?php if (isset($images)) { $images = (array)$images; }
	$id = isset($images['id']) ? $images['id'] : '';
?>

<?php foreach ($images as $image) : ?>
	<?php // echo $image->id; ?>
	<?php // echo $image->image_newsid; ?>	
	<?php echo $image->image_file; ?>
	<?php // echo $image->image_order; ?>
	<?php // echo $image->image_title; ?>
	<?php // echo $image->image_description; ?>	
<?php endforeach; ?>

<div class="admin-box">
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
	<div class="form-actions">
	<input type="hidden" id="" name="id" value="0" />
	<input type="hidden" id="" name="image_newsid" value="1" />
	
    <!-- BO Title -->     
    <div class="control-group">
	    <label class="control-label">Titulo</label>
        <div class="controls">
			<input type="text" id="" name="image_title" value="" />	
        </div>
	</div>
	<!-- EO Title -->
	
	<!-- BO CATEGORIES form_dropdown -->
    <!-- Using 'form_dropdown' to load the actual category of a news  -->
    <div class="control-group">
		<label class="control-label">Image_order</label>
			<input type="text" id="" name="image_order" value="" />
	</div>
	    
    <!-- BO STATUS form_textarea -->
    <div class="control-group">
	    <label class="control-label">Textarea</label>
        <div class="controls">
        	<?php echo form_textarea('image_description', ''); ?>
        </div>
	</div>   
    <!-- EO STATUS form_textarea -->
    
    <?php echo realpath( FCPATH.'assets/images/');?><br />
    <input type="file" name="image_file" size="20" value="" />
    <br /><br />
    <input type="submit" name="submit" class="btn btn-primary" value="insert" />
	
	<?php echo anchor(SITE_AREA .'/content/simplenews/', lang('simplenews_cancel'), 'class="btn btn-warning"'); ?>
	</div>
	</fieldset>		
    <?php echo form_close(); ?>
	<!-- EO IMAGE -->


    
    
</div>