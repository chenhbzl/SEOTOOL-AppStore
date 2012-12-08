/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

google.load('visualization', '1', {
    packages : [ 'table' ]
});
google.load("visualization", "1", {
    packages:["corechart"]
});

jQuery(function() {
    jQuery("#startdate").datepicker({
        maxDate : '+0',
        dateFormat: 'yy-mm-dd'
    });
    $("#enddate").datepicker({
        minDate : $('#startDate').val(),
        dateFormat: 'yy-mm-dd',
        maxDate : '+0',
        onSelect : function(dateText, inst) {
            get_app();
        }
    });
    get_app();
});

function get_app() {
    $.ajax({
        url : getRootUrl() + "/SEO_TOOL/gp_seo2/index.php/appCode/appInfo",
	
        type : "POST",
        data : {
            'startdate' : $('#startdate').val(),
            'enddate' : $('#enddate').val()
        },
        dataType : "json",
        success : function(result) {
            console.log(result);
            google.setOnLoadCallback(statistics(result));
        }
    });
}
function statistics(result){
    var graphic = result.graphic;
    var summary = result.summary;
    var detail = result.detail;
    
    var summaryTable = new google.visualization.DataTable();// keywword compete
    var summaryTable2 = new google.visualization.DataTable();// keywword compete
    var detailTable = new google.visualization.DataTable();// keywword compete
    var detailTable2 = new google.visualization.DataTable();// keywword compete
    
    
    addAppSummaryColumn(summaryTable);
    addAppSummaryColumn(summaryTable2);
    
    
    drawTable(summaryTable, summary, 'summary_app_table1', [ 0, 7 ]);
    drawTable(summaryTable2, summary, 'summary_app_table2', [ 0, 7 ]);
    
    addAppDetailColumn(detailTable);
    addAppDetailColumn(detailTable2);
    
    drawTable(detailTable, detail, 'detail_app_table1', [ 0, 9 ]);
    drawTable(detailTable2, detail, 'detail_app_table2', [ 0, 9 ]);
    
    
    //draw chart
    drawLineChart(graphic, 'graphic', 'title');
}

function addAppSummaryColumn(summaryTable){
    summaryTable.addColumn('string', 'app_id');// 0
    summaryTable.addColumn('string', 'app name');// 1
    summaryTable.addColumn('string', 'lastest update');// 2
    summaryTable.addColumn('string', 'Registration date ranking');// 3
    summaryTable.addColumn('string', 'Start date rank');// 4
    summaryTable.addColumn('string', 'End date rank');// 5
    summaryTable.addColumn('number', 'Dif');// 6
    summaryTable.addColumn('string', 'app_specify_flag')//7
    
}

function addAppDetailColumn(detailTable){
    detailTable.addColumn('string', 'app-id');//0
    detailTable.addColumn('string', 'app-name');//1
    detailTable.addColumn('string', 'registration date');//2
    detailTable.addColumn('string', 'version');//3
    detailTable.addColumn('string', 'Latest update');               //4
    detailTable.addColumn('string', 'Registration date counter');   //5
    detailTable.addColumn('string', 'Start day counter');           //6
    detailTable.addColumn('string', 'End day counter');             //7
    detailTable.addColumn('number', 'Dif');                         //8
    detailTable.addColumn('string', 'app_specify_flag')             //9
}

function drawTable(data, summaryData, container, hiden) {

    if (data.getNumberOfRows() != 0)
        data.removeRows(0, data.getNumberOfRows());
    data.addRows(summaryData);
    var view = new google.visualization.DataView(data);
    view.hideColumns(hiden);
    var con = document.getElementById(container);
    var table = new google.visualization.Table(con);
    table.draw(view, {
        showRowNumber : true
    });

    // add listener when click on table row
    google.visualization.events.addListener(table, 'select', selectHandler);
    function selectHandler(e) {
        var link = getRootUrl() + "/SEO_TOOL/gp_seo2/index.php/appCode/appDetail/";
        onRowClickHandler(table, data, link, 0);
    }

}

function onRowClickHandler(table, data, link, index) {
    var selection = table.getSelection();
    var keyword_id = '';
    for ( var i = 0; i < selection.length; i++) {
        var item = selection[0];
        var row = item.row == null ? 0 : item.row;
        keyword_id = data.getFormattedValue(row, index);
    }
    link += keyword_id;
    // go to compete application
    window.location = link;
}


function drawLineChart(data, container, titles) {
    var chart = new google.visualization.LineChart(document
        .getElementById(container));
    
    var dataLine = google.visualization.arrayToDataTable(data);

    var options = {
        title : titles,
        pointSize: 5,
        hAxis:  {
            title: 'Date',  
            titleTextStyle: {
                color: '#FF0000'
            }
        },
        vAxis: {
            title: 'app view number', 
            titleTextStyle: {
                color: '#FF0000'
            }, 
            format: '',
            viewWindow:{
                min: 0
            }
        }
    };

    
    chart.draw(dataLine, options);

}

function getRootUrl() {
    var defaultPorts = {
        "http:":80,
        "https:":443
    };

    return window.location.protocol + "//" + window.location.hostname
    + (((window.location.port)
        && (window.location.port != defaultPorts[window.location.protocol]))
    ? (":"+window.location.port) : "");
}