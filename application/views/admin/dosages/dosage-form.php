<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix">
        <?php 

            $id = '';
            $disease = '';
            $agent = '';
            $dosage = '';
            $county = '';

            # var_dump($dosageObj);

            if(isset($dosageObj->id)){
                $id = $dosageObj->id;
                $disease = $dosageObj->did;
                $agent = $dosageObj->aid;
                $dosage = $dosageObj->dosage;
                $county = $dosageObj->county;
            }

            echo form_open('admin/dosages/saveDosage', 'class="form-horizontal col-md-8"');

            echo form_hidden('id', $id);
        ?>
        <fieldset>
            <div class="form-group">
                <label class="col-sm-3 control-label">Disease</label>  
                <div class="col-sm-6">
                    <select class="form-control" name="disease" required>
                        <option value="">Select a Disease</option>
                        <?php
                            $diseases = $this->dosages_model->getDiseases();

                            foreach($diseases as $d){
                                $selected = set_select('disease', $d->id, $d->id == $disease);

                                echo "<option value=\"$d->id\" $selected>$d->disease</option>";
                            }
                        ?>
                    </select>

                    <?php echo form_error('disease'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Chemical Agent</label>  
                <div class="col-sm-6">
                    <select class="form-control" name="agent" id="agent" required>
                        <option value="">Select a Chemical Agent</option>
                        <?php
                            $agents = $this->dosages_model->getChemicalAgents();

                            foreach($agents as $a){
                                $selected = set_select('agent', $a->id, $a->id == $agent);

                                echo "<option value=\"$a->id\" data-basis=\"$a->basis\" $selected>$a->agent</option>";
                            }
                        ?>
                    </select>
                    <div id="dosage-basis" class="text-warning" style="font-weight:bold;"></div>

                    <?php echo form_error('agent'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Dosage</label>  
                <div class="col-sm-6">
                    <input name="dosage" type="number" step="any" class="form-control" 
                        value="<?php echo set_value('dosage', $dosage); ?>" required />
                    <?php echo form_error('dosage'); ?>

                    <div class="text-warning" style="margin-top:6px;">
                        <em>
                            Weight-based agents: (ml/kg) <br>
                            Ratio-based agents: (ml/10L water)
                        </em>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <hr/>
                    <button class="btn btn-block btn-warning">Save Dosage</button>
                </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
$(document).ready(function(){

    $('#agent').change(function(){
        var data = $(this).find('option:selected').data(),
            value = $(this).val(),
            msg = data.basis ? `Dosage-basis: ${data.basis}` : '-'

        $('#dosage-basis').text(msg)
    })
})
</script>