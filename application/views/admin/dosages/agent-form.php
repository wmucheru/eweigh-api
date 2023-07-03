<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix">
        <?php 

            $id = '';
            $agent = '';
            $applicationMode = '';
            $proprietaryName = '';
            $dosageBasis = '';

            # var_dump($agentObj);

            if(isset($agentObj->id)){
                $id = $agentObj->id;
                $agent = $agentObj->agent;
                $applicationMode = $agentObj->mode;
                $proprietaryName = $agentObj->proprietaryname;
                $dosageBasis = $agentObj->basis;
            }

            echo form_open('admin/dosages/saveAgent', 'class="form-horizontal col-md-8"');

            echo form_hidden('id', $id);
        ?>
        <fieldset>
            <div class="form-group">
                <label class="col-sm-3 control-label">Active Agent</label>
                <div class="col-sm-6">
                    <input name="agent" type="text" class="form-control" 
                        value="<?php echo set_value('agent', $agent); ?>" required />
                    <?php echo form_error('agent'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Proprietary Name</label>
                <div class="col-sm-6">
                    <input name="proprietaryname" type="text" class="form-control" 
                        value="<?php echo set_value('proprietaryname', $proprietaryName); ?>" required />
                    <?php echo form_error('proprietaryname'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Application Mode</label>
                <div class="col-sm-6">
                    <select class="form-control" name="applicationmode" required>
                        <option value="">Select mode</option>
                        <?php
                            $modes = array('Drench', 'Pouron', 'Spray');

                            foreach($modes as $m){
                                $selected = set_select('applicationmode', $m, $m == $applicationMode);

                                echo "<option value=\"$m\" $selected>$m</option>";
                            }
                        ?>
                    </select>

                    <?php echo form_error('applicationmode'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Dosage Basis</label>
                <div class="col-sm-6">
                    <select class="form-control" name="dosagebasis" required>
                        <option value="">Select basis</option>
                        <?php
                            $types = array('weight', 'ratio');

                            foreach($types as $t){
                                $selected = set_select('dosagebasis', $t, $t == $dosageBasis);

                                echo "<option value=\"$t\" $selected>". ucwords($t) ."</option>";
                            }
                        ?>
                    </select>

                    <?php echo form_error('dosagebasis'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <hr/>
                    <button class="btn btn-block btn-warning">Save Chemical Agent</button>
                </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>