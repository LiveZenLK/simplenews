<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading"><?php echo lang('catalogsys_fix_the_following_errors'); ?></h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<?php // Change the css classes to suit your needs
	if( isset($news) ) { $news = (array)$news; }
	$id = isset($news['id']) ? $news['id'] : '';
?>

<?php // Change the css classes to suit your needs
	if( isset($categories) ) { $categories = (array)$categories; }
	$id = isset($categories['id']) ? $categories['id'] : '';
?>

<div class="admin-box">

    <h3><?php echo lang('edit')?></h3>
    
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
    <div class="form-actions">  
    
     <!-- BOF CATEGORIES -->
    <select name="category_id">    
	<?php foreach ($categories as $category) : ?>
        <option value="<?php echo $category->id ?>" <?php echo set_select('category_id', $category->id ) ?>>
            <?php echo $category->category_name ?>
        </option>
    <?php endforeach; ?>
    </select>
    <!-- EOF CATEGORIES -->
   
	<?php echo form_label('id', 'id'); ?>            
    <input type="text" name="title" id="" value="<?php echo set_value('id', isset($news['id']) ? $news['id'] : ''); ?>" />
            
    <?php echo form_label('category_id', 'category_id'); ?>
    <input type="text" name="title" id="" 
	value="<?php echo set_value('category_id', isset($news['category_id']) ? $news['category_id'] : ''); ?>" />
            
    <?php echo form_label('title', 'title'); ?>
    <input type="text" name="title" id="" 
    value="<?php echo set_value('title', isset($news['title']) ? $news['title'] : ''); ?>" />
            
	<?php echo form_label('status', 'status'); ?>
    <input type="text" name="title" id="" 
    value="<?php echo set_value('status', isset($news['status']) ? $news['status'] : ''); ?>" />
	
	<?php // echo form_label('status', 'status'); ?>
    <br/><br/>            
    <input type="submit" name="submit" class="btn btn-primary" value="Save" />
	<?php echo lang('simplenews_or'); ?> <?php echo anchor(SITE_AREA .'/content/simplenews/', lang('simplenews_cancel'), 'class="btn btn-warning"'); ?>
    
    </div>
    </fieldset>
    <?php echo form_close(); ?>
</div>