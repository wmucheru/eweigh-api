<div class="modal-dialog">



  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">ADD NEW USER</h4>
    </div>


    <div class="modal-body">

      <?php echo form_open_multipart('agency/update_houseInfo'); ?>
          <div class="form-group">
              <label class="control-label">Property</label>
              <input type="hidden" id="id" name="id" />
              <input type="hidden" id="propertyid" name="propertyid" />
              <input type="text" id="property" class="form-control" disabled="disabled" name="property" />
              <?php echo form_error('propertyid'); ?>
          </div>
          <div class="form-group">
              <label class="control-label">Tenant</label>
              <input type="hidden" id="tenantid" name="tenantid" />
              <input type="text" id="tenant" class="form-control" disabled="disabled" name="tenant" />
              <?php echo form_error('tenantid'); ?>
          </div>
          <div class="form-group">
              <label class="control-label">House Type</label>
              <input type="text" id="nyumba_type" class="form-control" name="nyumba_type" />
               <?php echo form_error('nyumba_type'); ?>
          </div>

          <div class="form-group" name="nyumba_type">
              <label class="control-label">House Number</label>
              <input type="text" class="form-control" name="nyumba_number"/>
               <?php echo form_error('nyumba_number'); ?>
          </div>

          <div class="form-group">
              <label class="control-label">Rent</label>
              <input type="text" class="form-control" name="rent"/>
               <?php echo form_error('rent'); ?>
          </div>
          <div class="form-group">
              <label class="control-label">Status</label>
              <input type="text" class="form-control" name="status"/>
               <?php echo form_error('status'); ?>
          </div>

          <div class="form-group modal-footer">
            <button type="submit" class="btn btn-warning pull-left">
              <span><i class="fa fa-floppy-o"></i></span> UPDATE
            </button>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">CANCEL</button>
          </div>

        </div>
      <?php  echo form_close(); ?>
  </div>

</div>
