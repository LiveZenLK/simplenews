<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading"><?php echo lang('catalogsys_fix_the_following_errors'); ?></h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<?php // Change the css classes to suit your needs
	if( isset($editnews) ) { $editnews = (array)$editnews; }
	$id = isset($result['id']) ? $result['id'] : '';
?>

<div class="admin-box">
    <h3><?php echo lang('edit')?></h3>
    
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>

        <div class="form-actions">
           
			<?php echo form_label('category_id', 'category_id'); ?>
			<select name="category_id">
                <option value="1">First</option>
                <option value="0">Second</option>
			</select>
            
			<?php echo form_label('id', 'id'); ?>
            <input type="text" name="title" id="" 
            value="<?php echo set_value('id', isset($editnews['id']) ? $editnews['id'] : ''); ?>" />
            
            <?php echo form_label('title', 'title'); ?>
            <input type="text" name="title" id="" 
            value="<?php echo set_value('title', isset($editnews['title']) ? $editnews['title'] : ''); ?>" />

            <?php echo form_label('status', 'status'); ?>
			<select name="item_featured">
                <option value="1">yes</option>
                <option value="0">no</option>
			</select>
            
            <br/><br/>            
            <input type="submit" name="submit" class="btn btn-primary" value="Save" />
				<?php echo lang('simplenews_or'); ?> <?php echo anchor(SITE_AREA .'/content/simplenews/', lang('simplenews_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>
</div>