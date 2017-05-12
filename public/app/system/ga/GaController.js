import Helper from '../helper/helper';
import app from '../app';

app.GaController = function(params) {

    var chartData = params.chart_data;

    function chart_summary() {
        var data = {
            labels: chartData.labels,
            datasets: [
                {
                    label: "Page view",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(85,255,10,0.4)",
                    borderColor: "rgba(85,192,10,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(85,255,10,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(85,255,10,1)",
                    pointHoverBorderColor: "rgba(85,255,10,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: chartData.page_view.data,
                    spanGaps: false
                }
            ]
        };

        var ctx = document.getElementById('chart');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return Helper.formatCurrency(tooltipItems.yLabel);
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            // Create scientific notation labels
                            callback: function(value, index, values) {
                                return Helper.formatCurrency(value);
                            }
                        }
                    }]
                }
            }
        });
    }

    function chart_visit() {
        var data = {
            labels: chartData.labels,
            datasets: [
                {
                    label: "Visit",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: chartData.visit.data,
                    spanGaps: false
                }
            ]
        };

        var ctx = document.getElementById('chart-visit');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return Helper.formatCurrency(tooltipItems.yLabel);
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            // Create scientific notation labels
                            callback: function(value, index, values) {
                                return Helper.formatCurrency(value);
                            }
                        }
                    }]
                }
            }
        });
    }

    function chart_session_duration() {
        var data = {
            labels: chartData.labels,
            datasets: [
                {
                    label: "Session duration",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(25,11,10,0.4)",
                    borderColor: "rgba(25,11,10,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(25,11,10,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(25,11,10,1)",
                    pointHoverBorderColor: "rgba(25,11,10,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: chartData.session_duration.data,
                    spanGaps: false
                }
            ]
        };

        var ctx = document.getElementById('chart-session-duration');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return Helper.formatCurrency(tooltipItems.yLabel);
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            // Create scientific notation labels
                            callback: function(value, index, values) {
                                return Helper.formatCurrency(value);
                            }
                        }
                    }]
                }
            }
        });
    }


    function setup_date_picker() {
        $('.datepicker').datepicker({
            todayHighlight: true,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
        });
    }

    function init() {
        setup_date_picker();
        chart_summary();
        chart_visit();
        chart_session_duration();
    }

    return {
        init: init
    }
}