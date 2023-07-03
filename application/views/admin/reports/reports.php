<div class="container">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix">
        <style>
            .stat-box > div{
                margin-bottom:0;
            }
        </style>
        <div class="row">
            <div class="col-sm-2 stat-box">
                <div>
                    <h3><?php echo $stats->submissions; ?></h3>
                    <p>LW Submissions</p>
                </div>
            </div>

            <div class="col-sm-2 stat-box">
                <div>
                    <h3><?php echo $stats->farmers; ?></h3>
                    <p>Farmers</p>
                </div>
            </div>
            
            <div class="col-sm-2 stat-box">
                <div>
                    <h3><?php echo $stats->cattle; ?></h3>
                    <p>Cattle</p>
                </div>
            </div>

            <div class="col-sm-2 stat-box">
                <div>
                    <h3><?php echo $stats->feeds; ?></h3>
                    <p>Feeds</p>
                </div>
            </div>

            <div class="col-sm-2 stat-box">
                <div>
                    <h3><?php echo $stats->dosages; ?></h3>
                    <p>Dosages</p>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix page-content">
        <ul class="nav nav-tabs" role="tablist">
            <li class="active">
                <a href="#county" role="tab" data-toggle="tab">County Statistics</a>
            </li>
            <li>
                <a href="#cattle" role="tab" data-toggle="tab">Cattle Distribution</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="county">
                <?php
                    # var_dump($county_stats);
                ?>
                <div class="row">
                    <div class="col-sm-3" id="county-list-holder">
                        <ul id="county-list"></ul>
                    </div>

                    <div class="col-sm-6">
                        <h4 class="text-center" id="county-name" style="margin-top:0;"></h4>
                        <div id="map"></div>
                    </div>

                    <div class="col-sm-3">
                        <div id="county-stats"></div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="cattle">
                <div class="row clearfix">
                    <div class="col-sm-6" style="height:500px; width:100%;">
                        <?php
                            # var_dump($breeds);
                        ?>
                        <canvas id="pie-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/plugins/chartjs/Chart.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/chartjs/chartjs-plugin-colorschemes.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/leaflet/leaflet.js'); ?>"></script>
<script>
    const breeds = JSON.parse(`<?php echo json_encode($breeds) ?>`);
    const countyData = JSON.parse(`<?php echo json_encode($countyData) ?>`);
    let geoJSON;

    if (document.getElementById('map')) {
        var center = [-1.3031934, 36.5672003];
        var map = L.map('map', {
            draggable: false,
            scrollWheelZoom: false,
            zoomControl: false
        }).setView(center, 5);

        $.ajax({
            url: '<?php echo base_url('content/data/kenya.geojson') ?>',
            method: 'get',
            success: function (data) {
                //console.log(data);
                data = typeof data === 'string' ? JSON.parse(data) : data

                var defaultStyle = {
                    weight: 2,
                    opacity: 1,
                    color: '#fff',
                    dashArray: '3',
                    fillColor: '#ccc',
                    fillOpacity: 1
                };

                geoJSON = L.geoJson(data, {
                    style: defaultStyle,
                    onEachFeature: function (feature, layer) {
                        var str = `${feature.properties.COUNTY_NAM}<br/>`;
                        // layer.bindPopup(str);
                    }
                }).addTo(map);

                map.fitBounds(geoJSON.getBounds());

                // Render info
                listCounties();
                renderMapInfo(countyData[0]);
                buildBreedChart();
            },
            error: function (e) {
                console.log(e);
            }
        });

        function renderInfo(counties, fillColor){
            if (geoJSON) {
                geoJSON.eachLayer(function (layer) {
                    layer.setStyle({ fillColor: '#ccc' })

                    counties.map(function (c, i) {
                        if (c === layer.feature.properties.COUNTY_COD) {
                            layer.setStyle({ fillColor: fillColor })
                        }
                    })
                })
            }
        }
    }

    function listCounties(){
        var cList = $('#county-list'), lStr = '';

        countyData.map(function(c){
            lStr += `<li data-id="${c.id}">${c.county}</li>`
        })

        cList.html(lStr);
        cList.find('li').on('click', function(e){
            var id = $(this).data('id');
            var county = countyData.filter(function(c){
                return Number.parseInt(c.id) == id }
            )[0];
            renderMapInfo(county);
        })
    }

    function renderMapInfo(county){
        var statBox = function(number, label){
            return `<div class="stat-box">
                <div>
                    <h3>${number}</h3>
                    <p>${label}</p>
                </div>
            </div><br/>`;
        }

        var stats = statBox(county.submissions, 'Submissions') + 
            statBox(county.farmers, 'Farmers') +
            statBox(county.cattle, 'Cattle');
        $('#county-stats').html(stats);

        $('#county-name').html(county.county);
        $(`#county-list li`).removeClass('active');
        $(`#county-list li[data-id=${county.id}]`).addClass('active');

        if (geoJSON) {
            geoJSON.eachLayer(function (layer) {
                layer.setStyle({ fillColor: '#ccc' })

                countyData.map(function (c, i) {
                    if (Number.parseInt(county.id) === layer.feature.properties.COUNTY_COD) {
                        layer.setStyle({ fillColor: '#a55a43' })
                    }
                })
            })
        }
    }

    function buildBreedChart(){
        var labels = [], data = []

        breeds.map(function(b,i){
            labels.push(b.breed);
            data.push(b.count);
        })

        new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: "No. of Cattle",
                    data: data
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Cattle Breed Distribution'
                },
                plugins: {
                    colorschemes: {
                        scheme: 'office.Slate6'
                    }
                }
            }
        })
    }
</script>