{include file='stat_layout_top.tpl'}          
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">SHORT URL</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/">GO SHORT URL</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Statistic</h1>
            <div id="no_stat"></div>
            <div class="row placeholders">
                <div class="col-xs-6 col-sm-3 placeholder">
                    <div id="cities_chart_div"></div>
                </div>
                <div class="col-xs-6 col-sm-3 placeholder">
                    <div id="browsers_chart_div"></div>
                </div>
                <div class="col-xs-6 col-sm-3 placeholder">
                    <div id="stat_info">
                        <div class="head">
                            <div class="left">
                                <div><b>Hits (all) :</b></div>
                                <div><b>Hits (today) :</b></div>
                                <div><b>Hosts (all) :</b></div>
                                <div><b>Hosts (today) :</b></div>
                            </div>
                            <div class="right">
                                <div>{$hitsCount['all']}</div> 
                                <div>{$hitsCount['today']}</div>
                                <div>{$hostsCount['all']}</div>
                                <div>{$hostsCount['today']}</div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="http://getbootstrap.com/assets/js/vendor/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url : '/getStatData?url_id=' + '{$short_link_id}' + '&noCache=' + (new Date().getTime()) + Math.random() ,
                    dataType: "json",
        }).done(function (data) {
            if(data.success==true) {
                        window['stat_data'] = data.stat_data;
            } else {
                        $(".placeholders").hide();
                        $("#no_stat").html('No statistic ...');
                    }
                }).fail(function () {
            alert('Unknown error.');
        });
    });
</script>

{literal}
<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawCityChart);
    google.charts.setOnLoadCallback(drawBrowserChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawCityChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(window['stat_data']['cities']);

        // Set chart options
        var options = {'title':'Visits by cities',
                       'width':400,
                       'height':300,
                       'slices': {
                        0: { color: '#191970' },
                        1: { color: '#C71585' },
                        2: { color: '#8A2BE2' }
                       }};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('cities_chart_div'));
        chart.draw(data, options);
    }


    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawBrowserChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(window['stat_data']['browsers']);

        // Set chart options
        var options = {'title':'Visits by browsers',
                       'width':400,
                       'height':300,
                       'slices': {
                        0: { color: '#191970' },
                        1: { color: '#C71585' },
                        2: { color: '#8A2BE2' }
                       }};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('browsers_chart_div'));
        chart.draw(data, options);
    }
</script>
{/literal}
{include file='stat_layout_bottom.tpl'}    
