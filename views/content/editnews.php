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
<?php // Change the css classes to suit your needs
	if( isset($defaultcheckbox) ) { $defaultcheckbox = (array)$defaultcheckbox; }
//	$id = isset($defaultcheckbox['id']) ? $defaultcheckbox['id'] : '';
?>
<?php // Change the css classes to suit your needs
//if( isset($defaultcheckboxtwo) ) { $defaultcheckboxtwo = (array)$defaultcheckboxtwo; }
//	$id = isset($defaultcheckboxtwo['id']) ? $defaultcheckboxtwo['id'] : '';
?>

<div class="admin-box">	
    	<div style="float:left; width:100%;">
		<?php
//			$datee = "Dia: %d Mês: %m Ano: %Y - %h:%i %a";
//			$time = time();
//			echo date($datee, $time);			
// 			Display the data of news.
//			echo 'created_on : ' . $news['created_on'] . '<br />';			
//			echo 'modified_on : ' . $news['modified_on'] . '<br />';
//			echo date('j M Y g:i A', strtotime($news['created_on']) );
//			echo date('j M Y g:i A', strtotime($news['modified_on']) );
//			echo date('Y-m-j_His', strtotime($news['modified_on']) );	
//			echo 'Created On  : ' . date('l \d\i\a j \d\e F \d\e Y \a\s h:i:s A', strtotime($news['created_on']));
//			echo '<br />';
//			echo 'Modified On :' . date('l \d\i\a j \d\e F \d\e Y \a\s h:i:s A', strtotime($news['modified_on']));
//			echo '<br /><br />';
//			echo 'category_id : ' . $news['category_id'] . '<br /><br />';					
//			echo 'title : ' . $news['title'] . '<br />';
//			echo 'category_id : ' . $news['category_id'] . '<br />';
//          echo 'status : ' . $news['status'] . '<br />';
//			echo 'News selected checkboxes : ' . $news['checkbox'] . '<br />';
//			echo '<br />Default Checkboxes : ' . $defaultcheckbox['checkboxes'] . '<br /><br />';

// http://localhost/bonfire/public/index.php/admin/content/simplenews/editnews/3
// http://localhost/bonfire/public/index.php/admin/content/simplenews/editnews/109
			
		?>
    	</div>
    
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    
    <fieldset>
	<div class="form-actions">
	<input type="hidden" id="" name="id" value="<?php echo set_value('id', isset($news['id']) ? $news['id'] : ''); ?>" />
	
    <!-- BO Title -->     
    <div class="control-group">
	    <label class="control-label">Titulo</label>
        <div class="controls">
		<?php echo form_input('title', isset($news['title']) ? $news['title'] : ''); ?>
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
		<?php echo form_dropdown('category_id', $array, $news['category_id']); ?>
	</div>
	<!-- EO CATEGORIES form_dropdown -->
	
	<input type="hidden" name="modified_on" value="<?php $datestring = "%Y-%m-%d %H:%i:%s"; $time = time(); echo mdate($datestring, $time); ?>" /><br />	
    
    <!-- BO STATUS set_radio -->
    <!-- Using 'set_radio' to load the status to create a check box options -->
    <div class="control-group">
	    <label class="control-label">Status (with radio)</label>
        <div class="controls">
        	<label class="radio">
				<input type="radio" name="status" id="" value="1"  
				<?php echo $news['status'] == 1 ? 'checked="checked"' : set_radio('Ativo', 1); ?> />
                <span>Ativo</span>
			</label>
                        
            <label class="radio">
				<input type="radio" name="status" id="" value="0" 
				<?php echo $news['status'] == 0 ? 'checked="checked"' : set_radio('Inativo', 0); ?> />
                <span>Inativo</span>
			</label>
		</div>
	</div>
    <!-- EO STATUS set_radio -->
    
    <!-- BO STATUS form_textarea -->
    <div class="control-group">
	    <label class="control-label">Textarea</label>
        <div class="controls">
		<?php echo form_textarea('textarea', isset($news['textarea']) ? $news['textarea'] : ''); ?>
        </div>
	</div>   
    <!-- EO STATUS form_textarea -->    
        
    <!-- BO POPULATE CHECKBOXes ;) -->
    <div class="control-group">
		<label class="control-label">Checkbox</label>
		<div class="controls">
		<?php
		
		$alldefaultcheckbox = explode("||",$defaultcheckbox['checkboxes']); //make it array using explode		
		$newscheckbox = explode("||",$news['checkbox']); //make it array using explode		
		$countalldefaultcheckbox = count($alldefaultcheckbox);

		for($i=0;$i<$countalldefaultcheckbox;$i++) : 
		    if(in_array($alldefaultcheckbox[$i],$newscheckbox)) :
		        echo '<input type="checkbox" name="checkbox[]" value="'.$alldefaultcheckbox[$i].'" checked="checked" />'.$alldefaultcheckbox[$i].'<br />';
				//echo 'created_on : ' . $news['created_on'] . '<br />';				
		    else :
		        echo '<input type="checkbox" name="checkbox[]" value="'.$alldefaultcheckbox[$i].'"> '.$alldefaultcheckbox[$i].'<br />';
			endif;
		endfor;		
		//echo form_multiselect('Multi-Select', $alldefaultcheckbox, $newscheckbox); // not working
		//echo form_checkbox('checkbox', $alldefaultcheckbox, $newscheckbox); // not working			
		?>        	
		</div>
	</div>
	<!-- EO POPULATE CHECKBOXes -->
	
	<!-- BO POPULATE Form_multiselect -->
    <div class="control-group">
		<label class="control-label">Form_multiselect (uncoment the code)</label>
		<div class="controls">
		<?php		
		/*
			$options = array(
				'small'  => 'Small Shirt',
				'med'    => 'Medium Shirt',
		        'large'   => 'Large Shirt',
		        'xlarge' => 'Extra Large Shirt',
			);
			$shirts_on_sale = array('small', 'large');
			echo form_multiselect('shirts', $options, $shirts_on_sale);		 
		 // echo form_checkbox('shirts', $options, $shirts_on_sale); // not working
		 	echo form_multiselect('shirts', $alldefaultcheckbox, $newscheckbox);
		 */		
		?>
		</div>
	</div>	
	
	<!-- BO IMAGE 
	<input id="foto" type="file" name="foto" maxlength="1000" value="" />
	<input id="foto" type="file" name="foto" maxlength="1000" value="" />
	-->
	<?php // echo form_label("foto","userfile"); ?>
	<input type="file" id="foto" name="foto" />
	<br/><br/>
	<!-- EO IMAGE -->
	
	<input type="submit" name="submit" class="btn btn-primary" value="Save" />
	<?php echo anchor(SITE_AREA .'/content/simplenews/', lang('simplenews_cancel'), 'class="btn btn-warning"'); ?>
	</div>
	</fieldset>
	
	
		
    <?php echo form_close(); ?>
    
</div>