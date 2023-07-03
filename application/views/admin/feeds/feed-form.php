<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix">
        <?php 

            $id = '';
            $feedType = '';
            $feed = '';
            $description = '';
            $dryMatter = '';
            $energy = '';
            $protein = '';
            $ndf = '';

            # var_dump($feedObj);

            if(isset($feedObj->id)){
                $id = $feedObj->id;
                $feedType = $feedObj->feedtype;
                $feed = $feedObj->feed;
                $description = $feedObj->description;
                $dryMatter = $feedObj->drymatter;
                $energy = $feedObj->energy;
                $protein = $feedObj->protein;
                $ndf = $feedObj->ndf;
            }

            echo form_open('admin/feeds/saveFeed', 'class="form-horizontal col-md-8"');

            echo form_hidden('id', $id);
        ?>
        <fieldset>
            <div class="form-group">
                <label class="col-sm-3 control-label">Feed Type</label>  
                <div class="col-sm-6">
                    <select class="form-control" name="feedtype" required>
                        <option value="">Select a Feed Type</option>
                        <?php
                            $feedTypes = $this->feeds_model->getFeedTypes();

                            foreach($feedTypes as $type => $label){
                                $selected = set_select('feedtype', $type, $type == $feedType);

                                echo "<option value=\"$type\" $selected>$label</option>";
                            }
                        ?>
                    </select>

                    <?php echo form_error('feedtype'); ?>
                </div>
            </div>
                                
            <div class="form-group">
                <label class="col-sm-3 control-label">Feed Name</label>
                <div class="col-sm-6">
                    <input name="feed" type="text" class="form-control" autocomplete="off" 
                        value="<?php echo set_value('feed', $feed); ?>" required />
                    <?php echo form_error('feed'); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" 
                        rows="4"><?php echo set_value('description', $description); ?></textarea>
                    <?php echo form_error('description'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Dry Matter</label>  
                <div class="col-sm-6">
                    <input name="drymatter" type="number" step="any" class="form-control" 
                        value="<?php echo set_value('drymatter', $dryMatter); ?>" required />
                    <?php echo form_error('drymatter'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Metabolizable Energy</label>  
                <div class="col-sm-6">
                    <input name="energy" type="number" step="any" class="form-control" 
                        value="<?php echo set_value('energy', $energy); ?>" required />
                    <?php echo form_error('energy'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Crude Protein</label>  
                <div class="col-sm-6">
                    <input name="protein" type="number" step="any" class="form-control" 
                        value="<?php echo set_value('protein', $protein); ?>" required />
                    <?php echo form_error('protein'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">NDF</label>  
                <div class="col-sm-6">
                    <input name="ndf" type="number" step="any" class="form-control" 
                        value="<?php echo set_value('ndf', $ndf); ?>" required />
                    <?php echo form_error('ndf'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <hr/>
                    <button class="btn btn-block btn-warning">Save Feed</button>
                </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>