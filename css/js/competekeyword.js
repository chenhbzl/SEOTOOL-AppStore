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
            get_keyword();
        }
    });
    get_keyword();
});

function get_keyword() {
    $.ajax({
        //        url : "http://localhost:8888/googleplay_seo/index.php/compete/get_keyword",
        //		url : "http://ec2-54-251-4-64.ap-southeast-1.compute.amazonaws.com/googleplay_seo/index.php/compete/get_keyword",
        url : getRootUrl() + "/SEO_TOOL/gp_seo2/index.php/appCode/keywordInfo",
	
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
function statistics(result) {
    var graphic = result.graphic;
    var summary = result.summary;
    var detail = result.detail;
    
    var summaryTable = new google.visualization.DataTable();// keywword compete
    var summaryTable2 = new google.visualization.DataTable();// keywword compete
    
    var detailTable = new google.visualization.DataTable();// keywword compete
    var detailTable2 = new google.visualization.DataTable();// keywword compete
    
    
    addSummaryColumn(summaryTable);
    addSummaryColumn(summaryTable2);
    drawTable(summaryTable, summary, 'summary_table1', [ 0 , 8]);
    drawTable(summaryTable2, summary, 'summary_table2', [ 0 , 8]);

    addDetailAddColumn(detailTable);
    addDetailAddColumn(detailTable2);
    drawTable(detailTable, detail, 'detail_table1', [ 0 , 8]);
    drawTable(detailTable2, detail, 'detail_table2', [ 0 , 8]);


    //draw line chart
    drawLineChart(graphic, 'graphic', 'keyword search ranking');
}

function addDetailAddColumn(detailTable){
    
    detailTable.addColumn('string', 'keyword_id'); 			// 0
    detailTable.addColumn('string', 'Keyword ranking'); 	//1
    detailTable.addColumn('string', 'Keyword'); 			//2
    detailTable.addColumn('string', 'Register day'); 		// 3
    detailTable.addColumn('string', 'Registration date summary counter'); 		// 4
    detailTable.addColumn('string', 'Last summary counter'); 	// 5
    detailTable.addColumn('string', 'Current summary counter');	// 6
    detailTable.addColumn('number', 'Dif'); 			//7			
    detailTable.addColumn('string', 'specific_flag'); 		//8			
}

function addSummaryColumn(summaryTable){
    // data
    summaryTable.addColumn('string', 'keyword_id'); // 0
    summaryTable.addColumn('string', 'Keyword ranking'); // 1
    summaryTable.addColumn('string', 'Keyword'); // 2
    summaryTable.addColumn('string', 'register day'); // 3
    summaryTable.addColumn('string', 'register day ranking');// 4
    summaryTable.addColumn('string', 'start day ranking'); // 5
    summaryTable.addColumn('string', 'end day ranking'); // 6
    summaryTable.addColumn('number', 'Dif'); // 7
    summaryTable.addColumn('string', 'specific_flag'); // 8
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
        var link = getRootUrl() + "/SEO_TOOL/gp_seo2/index.php/appCode/competeApp/";
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
            title: 'search view number', 
            titleTextStyle: {
                color: '#FF0000'
            },
            format: '',
             viewWindow:{
                min: 0
            }
        }
    };

    var chart = new google.visualization.LineChart(document
        .getElementById(container));
    chart.draw(dataLine, options);

}