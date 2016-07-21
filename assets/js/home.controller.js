$('document').ready(
	function()
    {
        $('#homeButton').addClass("black");
        // these lines controls the slider present in the home page of the client
        // this line sets some properties of slider. transition and interval is in milliseconds
        $('.slider').slider({full_width: false, height: 100, transition: 300, interval: 4000});
        // this makes use of jQuery's hover function. on mouse in (1st argument), the slider will pause. on mouse out (2nd argument), the slider will resume.
        $('.slider').hover (
            function ()
            {
                // this function is a built-in function of materialize.js for sliders
                $('.slider').slider ('pause');
            },
            function ()
            {
                // another built-in function of materialize.js for sliders
                $('.slider').slider ('start');
            }
        );

        $('#jobStatusChart').highcharts({
            // define chart type
            chart: {
                type: 'bar'
            },
            // define chart title
            title: {
                text: 'Job Status'
            },
            // define legends in x-axis (the ones on the left side)
            xAxis: {
                categories: ['Pending', 'Processing', 'Proessed', 'Canceled']
            },
            // define legends in y-axis (the ones in the )
            yAxis: {
                allowDecimals: false, // disregard decimal points
                title: {
                    text: 'Jobs' // set title of table
                }
            },
            // the data points. used '0' as filler data
            series: [{
                name: 'Pending',
                data: [parseInt($('#totalPending').html()),0, 0, 0]
            },{
                name: 'Processing',
                data: [0, parseInt($('#totalProcessing').html()), 0, 0]
            },{
                name: 'Processed',
                data: [0, 0, parseInt($('#totalProcessed').html()), 0]
            },{
                name: 'Canceled',
                data: [0, 0, 0, parseInt($('#totalCanceled').html())]
            }],
            credits: {
                enabled: false // remove 'highcharts.com' at the bottom of the chart
            }
        });

        // output needed data from db
        var jsondata = jQuery.parseJSON($('#pieData').html());
        var dataArray = new Array();

        $.each(jsondata.values, function(k, v){
            dataArray.push([v[0], parseFloat(parseInt (v[1])/100)]);
        });

        $('#totalWork').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Total Work'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Work Percentage',
                data: dataArray
            }],
            credits: {
                enabled: false // remove 'highcharts.com' at the bottom of the chart
            }
        });

        var jsonincome = jQuery.parseJSON($('#incomeData').html());
        var incomeArray = new Array();
        $.each(jsonincome.income, function(k, v){
            incomeArray.push(parseInt(v));
        });

        $('#monthlyIncome').highcharts({
            title: {
                text: 'Monthly Income from Jobs',
                x: -20 // to center
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec']
            },
            legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
            },
            tooltip: {
                valueSuffix: ' PHP'
            },
            series: [{
                name: 'Income',
                data: incomeArray
            }],
            credits: {
                enabled: false // remove 'highcharts.com' at the bottom of the chart
            }
        });
    }
);
