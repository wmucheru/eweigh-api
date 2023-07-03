<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="clearfix">
        <?php
            if(!empty($cattle)){
        ?>
        <div class="row">
            <div class="col-sm-3">
                <?php
                    # var_dump($cattle);

                    echo img('assets/img/cow.png', $cattle->tag, 'class="img-responsive" style="max-width:120px;"');

                    echo "<br/><p><strong>Tag: </strong>$cattle->tag</p>";
                    echo "<p><strong>Gender: </strong>$cattle->gender</p>";
                    echo "<p><strong>Breed: </strong>$cattle->breed</p>";
                    echo "<p><strong>Registered: </strong>$cattle->createdon</p>";

                    $farmerLink = anchor('admin/farmers/'.$cattle->farmerid, $cattle->user);
                    echo "<p><strong>Farmer: </strong>$farmerLink</p>";
                ?>
            </div>

            <div class="col-sm-9 page-content">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#home" data-toggle="tab">Live Weight</a>
                    </li>
                    <li>
                        <a href="#submissions" data-toggle="tab">Submissions</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <canvas id="hglw-chart" width="800" height="450"></canvas>
                    </div>

                    <div class="tab-pane" id="submissions">
                        <?php
                            $this->load->view('admin/submissions/submissions-list');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
            }
            else{
                echo '<div class="alert alert-warning">No cattle info found</div>';
            }
        ?>
    </div>
</div>
<script src="<?php echo base_url('assets/plugins/chartjs/Chart.bundle.min.js') ?>"></script>
<script>
var stats = JSON.parse(`<?php echo json_encode($stats) ?>`),
    lw = [], hg = [], dates = []

stats.map(function(s, i){
    hg.push(s.hg)
    lw.push(s.lw)
    dates.push(s.createdon)
})

new Chart(document.getElementById("hglw-chart"), {
    type: 'bar',
    data: {
        labels: dates,
        datasets: [
            { 
                data: lw,
                label: "Live Weight",
                backgroundColor: "#3cba9f"
            }, {
                data: hg,
                label: "Heart Girth",
                backgroundColor: "#e8c3b9"
            }
        ]
    },
    options: {
        title: {
            display: true,
            text: 'Live Weight (Kg) / Heart Girth (cm)'
        }
    }
});
</script>