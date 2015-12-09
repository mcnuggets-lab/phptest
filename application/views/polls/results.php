<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h1>Result:</h1>
            <div id="chart_div" style="height:500px; width:500px;"></div>
            <br />
            <p>
                <a href="<?php echo site_url("/polls/") ?>" class="pull-left btn btn-default">Start over</a>
                <?php if ($input_type == 'radio' && !(empty($chosen))) { ?>
                    <a href="<?php echo site_url("/polls/".$chosen) ?>" class="pull-right btn btn-default">Next question</a>
                <?php } ?>
            </p>
        </div>
    </div>
</div>









<!---------------------------------------------------------------------------------------------------->

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", { packages: ["corechart"] });
</script>

<script>

    "use strict"        

    var data = google.visualization.arrayToDataTable([
        ['Choice', 'votes'],
        <?php foreach ($choices as $choice_item):
            echo "['".$choice_item['choice_text']."',".$choice_item['votes']."],";
        endforeach; ?>
            ]);

    function decodeEntities(html) {
        var txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }

    var title = decodeEntities("<?php echo $question_item['question_text'] ?>");

    var options = {
        title: title,
        legend: { position: 'none' },
        bar: { groupWidth: '61.8%' },
        chartArea: { width: '80%', height: '80%', backgroundColor: { stroke: '#000', strokeWidth: 1 } },
        vAxis: { viewWindow: { min: 0 } },
		<?php if ($chart_type == 'ColumnChart' || $chart_type == 'BarChart') { ?>
        animation: { startup: true, easing: 'in', duration: 1000 },
		<?php } else if ($chart_type == 'PieChart') { ?>
		is3D: true,
		<?php } ?>
    };

    var chart = new google.visualization.<?php echo $chart_type; ?>(document.getElementById('chart_div'));
    chart.draw(data, options);






</script>