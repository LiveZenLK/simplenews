
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($simplenews) ) {
    $simplenews = (array)$simplenews;
}
$id = isset($simplenews['id']) ? $simplenews['id'] : '';
?>
<div class="admin-box">
    <h3>simplenews</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>



        <div class="form-actions">
            <br/>
            <input type="submit" name="submit" class="btn btn-primary" value="Edit simplenews" />
            or <?php echo anchor(SITE_AREA .'/reports/simplenews', lang('simplenews_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Simplenews.Reports.Delete')) : ?>

            or <a class="btn btn-danger" id="delete-me" href="<?php echo site_url(SITE_AREA .'/reports/simplenews/delete/'. $id);?>" onclick="return confirm('<?php echo lang('simplenews_delete_confirm'); ?>')" name="delete-me">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('simplenews_delete_record'); ?>
            </a>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
