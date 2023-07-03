<div class="container">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>
    <div class="page-content clearfix">
        <?php
            # Data sources
            # var_dump($stats);
        ?>
        <div class="clearfix">
            <div class="col-sm-3 col-md-2 stat-row">
                <div class="row">
                    <div class="col-sm-12 col-xs-6 stat-box">
                        <div>
                            <h3><?php echo $stats->submissions; ?></h3>
                            <p>LW Submissions</p>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-6 stat-box">
                        <div>
                            <h3><?php echo $stats->farmers; ?></h3>
                            <p>Farmers</p>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-xs-6 stat-box">
                        <div>
                            <h3><?php echo $stats->cattle; ?></h3>
                            <p>Cattle</p>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-6 stat-box">
                        <div>
                            <h3><?php echo $stats->feeds; ?></h3>
                            <p>Feeds</p>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-6 stat-box">
                        <div>
                            <h3><?php echo $stats->dosages; ?></h3>
                            <p>Dosages</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Submissions</h3>
                    </div>
                    <div class="panel-body">
                        <div id="map" style="height:40em; width:100%;"></div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</div>
<script src="<?php echo base_url('assets/plugins/leaflet/leaflet.js'); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo config_item('google_api_key') ?>" async defer></script>
<script src="https://unpkg.com/leaflet.gridlayer.googlemutant@latest/dist/Leaflet.GoogleMutant.js"></script>
<script>
const subs = JSON.parse(`<?php echo addslashes(json_encode($submissions)); ?>`);

if(subs.length > 0){
    const map = L.map('map').setView([subs[0].lat, subs[0].lng], 3);
    const roads = L.gridLayer.googleMutant({
            type: 'roadmap'
        }).addTo(map);
    const farmerURL = '<?php echo site_url('admin/farmers') ?>';

    subs.map(function(s,i){
        const marker = L.marker([s.lat, s.lng]),
            user = s.user,
            county = s.county,
            hg = s.hg,
            lw = s.lw,
            farmerLink = `<a href="${farmerURL}/${s.farmerid}" target="_blank">${user}</a>`;

        marker.bindPopup(`<p>Farmer: ${farmerLink}<br/>County: ${county}<br/>HG: ${hg}</p><h4>LW: ${lw}</h4>`);
        map.addLayer(marker);
    });

    // map.setMaxBounds(map.getBounds())
}
</script>
