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
	<!-- <input type="hidden" name="created_on" id="" value="<?php echo date('Y-m-j H:i:s'); ?>" /> -->
    <input type="hidden" name="modified_on" id="" value="<?php echo date('Y-m-j H:i:s'); ?>" />  
	<!-- EO Hidden Values -->
		
	<!-- BO Title -->
    <div class="control-group">
	    <label class="control-label">Titulo</label>
        <div class="controls">
		<?php echo form_input('title', ''); ?>
        </div>
	</div>
	<!-- EO Title -->
    
    <!-- BO CATEGORIES form_dropdown -->
    <!-- Using 'form_dropdown' to load the actual category of a news  -->
    <div class="control-group">
		<label class="control-label">Category</label>
		<?php
		foreach ($categories as $category) : 
		$array[$category->id] = $category->category_name;
		endforeach;
		?>
		<?php echo form_dropdown('category_id', $array, ''); ?>
	</div>
	<!-- EO CATEGORIES form_dropdown -->
    
    <!-- BO STATUS set_radio -->
    <!-- Using 'set_radio' to load the status to create a check box options -->
    <div class="control-group">
	    <label class="control-label"><?php echo lang('simplenews_status'); ?></label>
        <div class="controls">
        	<label class="radio">
				<input type="radio" name="status" id="" value="1" />
                <span><?php echo lang('simplenews_active'); ?></span>
			</label>
                        
            <label class="radio">
				<input type="radio" name="status" id="" value="0"
                <span><?php echo lang('simplenews_inactive'); ?></span>
			</label>
		</div>
	</div>
    <!-- EO STATUS set_radio -->
    
    <!-- BO STATUS form_textarea -->
    <div class="control-group">
	    <label class="control-label">Textarea</label>
        <div class="controls">
		<?php echo form_textarea('textarea', ''); ?>
        </div>
	</div>   
    <!-- EO STATUS form_textarea -->  
        
    <!-- BO POPULATE CHECKBOXes ;) -->
    <div class="control-group">
		<label class="control-label">Checkbox</label>
		<div class="controls">
		<?php
		
		$alldefaultcheckbox = explode("||",$defaultcheckbox->checkboxes); //make it array using explode		
		$countalldefaultcheckbox = count($alldefaultcheckbox);
				
		for($i=0;$i<$countalldefaultcheckbox;$i++) : 
		    if(in_array($alldefaultcheckbox[$i], $alldefaultcheckbox)) :
		        echo '<input type="checkbox" name="checkbox[]" value="'.$alldefaultcheckbox[$i].'" />'.$alldefaultcheckbox[$i].'<br />';
			endif;
		endfor;		
		?>        	
		</div>
	</div>
	<!-- EO POPULATE CHECKBOXes -->
	
	<input type="submit" name="submit" class="btn btn-primary" value="insert" />
	<?php echo anchor(SITE_AREA .'/content/simplenews/', lang('simplenews_cancel'), 'class="btn btn-warning"'); ?>
	</div>
	
	</fieldset>
    <?php echo form_close(); ?>
</div>