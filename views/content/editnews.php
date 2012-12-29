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
if( isset($checkboxes) ) { $checkboxes = (array)$checkboxes; }
	$id = isset($checkboxes['id']) ? $news['id'] : '';
?>
<?php // Change the css classes to suit your needs
if( isset($checkboxestwo) ) { $checkboxestwo = (array)$checkboxestwo; }
	$id = isset($checkboxestwo['id']) ? $checkboxestwo['id'] : '';
?>



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
	echo form_multiselect('shirts', $options, 'large');
*/
?>
<div class="admin-box">
	<h3><?php echo lang('edit')?></h3>
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
					
			echo 'title : ' . $news['title'] . '<br />';
			echo 'category_id : ' . $news['category_id'] . '<br />';
            echo 'status : ' . $news['status'] . '<br />';
//			echo '<br /><br />';
//			echo 'Default checkboxes : ' . $defaultcheckbox->checkboxes . '<br /><br />';
			echo 'Item checkboxes : ' .	$news['checkbox'] . '<br /><br />';
			echo '<br />';
			$ex = explode(',', $news['checkbox']);
			foreach ($ex as $exs) :
				echo 'Selectmultiple : ' . $exs . '<br /><br /><br />';
			endforeach;			
//			echo 'selectmultiple : ' . $news['selectmultiple'] . '<br />';
            echo 'checkbox : ' . $news['checkbox'] . '<br /><br /><br /><br />';
			
		?>
    </div>
    
	<?php foreach ($categories as $category) : ?>
		<?php $array[$category->id] = $category->category_name; ?>
	<?php endforeach; ?>    
	<?php $selected = array('2', '3'); ?>   
	<br /><br /><br /><br />
	<?php echo form_multiselect('1shirts', $array, $selected); ?>
	
	

	<?php // echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
    <div class="form-actions">

    <input type="hidden" id="" name="id" value="<?php echo set_value('id', isset($news['id']) ? $news['id'] : ''); ?>"  />

    <!-- BOF Title form_input -->     
    <div class="control-group">
	    <label class="control-label">Titulo</label>
        <div class="controls">
		<?php echo form_input('title', isset($news['title']) ? $news['title'] : ''); ?>
        </div>
	</div>
    
    <!-- BOF CATEGORIES form_dropdown -->
    <!-- Using 'form_dropdown' to load the actual category of a news  -->
    <div class="control-group">
	<?php // echo form_label('Category', 'category_id'); ?>
    	<label class="control-label">Category</label>
		<?php foreach ($categories as $category) : ?>
			<?php $array[$category->id] = $category->category_name; ?>
		<?php endforeach; ?>
		<?php echo form_dropdown('category_id', $array, $news['category_id']); ?>
	</div>
	<!-- EOF CATEGORIES form_dropdown -->
    
    <!-- BOF STATUS set_radio -->
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
    <!-- EOF STATUS set_radio -->
    
    <!-- BOF STATUS form_textarea -->
    <div class="control-group">
	    <label class="control-label">Textarea</label>
        <div class="controls">
		<?php echo form_textarea('textarea', isset($news['textarea']) ? $news['textarea'] : ''); ?>
        </div>
	</div>   
    <!-- EOF STATUS form_textarea -->  

    <!-- BOF SELECT MULTIPLE  -->      
    <input type="hidden" id="" name="selectmultiple" 
    value="<?php echo set_value('selectmultiple', 
    isset($news['selectmultiple']) ? $news['selectmultiple'] : ''); ?>"  />
    <!-- EOF SELECT MULTIPLE  -->
    
    <!-- BOF POPULATE CHECKBOXes -->    
	    
	<?php
		
	// $checkboxesdefaults = $defaultcheckbox->checkboxes;
	// $checkboxesdefaults = $defaultcheckboxtwo->checkboxes;
	
	//$checkboxesdefaults = $defaultcheckbox['checkboxes'];
	//$checkboxesdefaultstwo = $defaultcheckboxtwo['checkboxes'];
	
	echo $defaultcheckbox->checkboxes;
	echo $defaultcheckboxtwo->checkboxes;
	
	echo $news['category_id'];

	/*
	foreach ($categories as $category) :
	$array[$category->id] = $category->category_name;
	endforeach;
	$selected = array('2'); 
	echo '<br /><br /><br /><br />';
	echo form_multiselect('1shirts', $array, $selected);
	*/	
	 ?>
    <!-- EOF CHECKBOX  -->
    
    <!-- BOF checkbox -->
    <!-- Using 'set_checkbox' to load the status to create a check box options -->
    <div class="control-group">
		<label class="control-label">Checkbox</label>
		<div class="controls">
        	<!--
        	<label class="checkbox">
            	<input type="checkbox" name="checkbox" id="" value="1" <?php echo $news['status'] == 1 ? 'checked="checked"' : set_checkbox('Ativo', 1); ?> />
                <span>Ativo</span>
			</label>            
            <label class="checkbox">
            	<input type="checkbox" name="checkbox" id="" value="0" 
				<?php echo $news['status'] == 0 ? 'checked="checked"' : set_checkbox('Inativo', 0); ?> />
				<span>Inativo</span>
			</label>
			-->
		</div>
	</div>
	<!-- EOF Checkbox -->
	
	<input id="foto" type="file" name="foto" maxlength="1000" value="
	<?php echo set_value('foto', isset($news['foto']) ? $news['foto'] : ''); ?>"  />
	<br/><br/>
	<input type="submit" name="submit" class="btn btn-primary" value="Save" />
	<?php echo lang('simplenews_or'); ?> <?php echo anchor(SITE_AREA .'/content/simplenews/', lang('simplenews_cancel'), 'class="btn btn-warning"'); ?>
	</div>
    
    </fieldset>
    <?php echo form_close(); ?>
</div>