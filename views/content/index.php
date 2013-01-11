<div class="admin-box">

<!-- BOF 
	<div class="box select admin-box">
		-->
		<?php
		/*
			echo form_open(SITE_AREA . '/reports/activities/' . $vars['which'], 'class="form-horizontal constrained"');

			$form_help = '<span class="help-inline">' . sprintf(lang('activity_filter_note'),($vars['view_which'] == ucwords(lang('activity_date')) ? 'from before':'only for'),strtolower($vars['view_which'])) . '</span>';
			$form_data = array('name' => $vars['which'].'_select', 'id' => $vars['which'].'_select', 'class' => 'span3' );
			echo form_dropdown($form_data, $select_options, $filter, lang('activity_filter_head') , '' , $form_help);
			//echo form_dropdown("activity_select", $select_options, $filter,array('id' => 'activity_select', 'class' => 'span4' ) );
			unset ( $form_data, $form_help);		 
		 */
		?>
		<!-- BOF 		
	</div>	
	<br/>	
	<h2><?php //echo sprintf(lang('activity_view'),($vars['view_which'] == ucwords(lang('activity_date')) ? $vars['view_which'] . ' before' : $vars['view_which']),$vars['name']); ?></h2>
	-->

	<?php if (!isset($news) || empty($news)) : ?>
	<div class="alert alert-error fade in">
		<a class="close" data-dismiss="alert">&times;</a>
		<h4 class="alert-heading"><?php echo lang('activity_not_found'); ?></h4>
	</div>
	<?php else : ?>

	<div id="user_activities">
		<table class="table table-striped table-bordered" id="flex_table">
			<thead>
				<tr>					
					<th><?php echo lang('simplenews_actions'); ?></th>					
					<th><?php echo lang('simplenews_title'); ?></th>
					<th><?php echo lang('simplenews_category'); ?></th>					
					<th><?php echo lang('simplenews_creation_date'); ?></th>
				</tr>
			</thead>

			<tfoot></tfoot>

			<tbody>
				<?php foreach ($news as $new) : ?>
				<tr>					
					<td>
						<?php 
						if ($new->status == 1) : 
							echo 
							'<span class="label label-success">' 
								. lang('simplenews_active') . 
							'</span>
							<a href="'. site_url(SITE_AREA .'/content/simplenews/editnews/' . $new->id) . '">Edit</a>' ;																				 
						else:
							echo '<span class="label label-warning">' . lang('simplenews_inactive') . '</span>
							<a href="' . site_url(SITE_AREA .'/content/simplenews/editnews/' . $new->id) . '">Edit</a>' ;;
						endif;
					 	?>
					</td>					
					<td><?php echo $new->title; ?></td>
					<td><?php echo $new->category_id; ?></td>
					
						
					<td><?php echo date('M j, Y g:i A', strtotime($new->created_on)); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<?php echo $this->pagination->create_links(); ?>
	<?php endif; ?>

