var todayDate = new Date();
google.load('visualization', '1', {
    packages : [ 'table' ]
});
google.load("visualization", "1", {
    packages:["corechart"]
});
$(function() {
    $("#startdate").datepicker({
        maxDate : todayDate
    });
    $("#enddate").datepicker({
        minDate : $('#startDate').val(),
        maxDate : todayDate,
        onSelect : function(dateText, inst) {
            get_app();
        }
    });

    $("#statistics_app").tabs();
});

$("#choose_rank2").click(
    function(){
        onSelectRank('select2', outsideTable2, outsideData2, 'ranking_table2');
    });

$("#choose_rank1").click(
    function(){
        onSelectRank('select1',outsideTable, outsideData, 'ranking_table1');
    });
    
function onSelectRank(id, table, data, container){
    
    var visible = '[';
    $('#'+id+' option:selected').each(function() {
        visible += $(this).val() + ',';
    });
                      
    visible = visible.replace(/.$/, '');
    visible += ']';
    
    visible = JSON.parse(visible);
    var all = [ 0, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
    18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32,
    33, 34, 35, 36, 37, 38, 39, 40, 41, 42,43, 44, 45, 46, 47 ,48 ,49 ,50 ,51, 52, 53, 54, 55, 56, 57, 58, 59, 60 ,61, 62, 71 ];
    var hiden = all;
    for ( var i = 0; i < all.length; i++) {
        for ( var j = 0; j < visible.length; j++) {
            if (visible[j] == all[i])
                hiden.splice(i, 1);
        }
    }
    drawTable(table, data, container, hiden);
}
$(document).ready(function() {
    get_app();
});

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

function get_app() {
    $.ajax({
        //		url : "http://localhost:8888/googleplay_seo/index.php/compete/get_app",		
        //		url : "http://ec2-54-251-4-64.ap-southeast-1.compute.amazonaws.com/googleplay_seo/index.php/compete/get_app/",
        url : getRootUrl() + "/googleplay_seo/index.php/compete/get_app",
        type : "POST",
        data : {
            'startdate' : $('#startdate').val(),
            'enddate' : $('#enddate').val()
        },
		
        dataType : "json",
        success : function(result) {
            console.log(result);
            google.setOnLoadCallback(statistic(result));
        }
    });
}
var outsideData = []; // outside table data
var outsideTable;
var outsideTable2;
var outsideData2 = [];
function statistic(result) {
    var end = result.end; // start day data
    var start = result.start; // end day data
    var reg = result.reg; // reg day data
    var data = result.keyword_rank; //download counter
    var sum_start = result.sum_start;
    var sum_end = result.sum_end;
    var sum_reg = result.sum_reg;
    var keyword = result.keyword;
//    console.log(keyword.keyword);
    
    var summaryTable = new google.visualization.DataTable(); // table summary
    var insideTable = new google.visualization.DataTable(); // table inside
    var summaryTable2 = new google.visualization.DataTable(); // table summary
    var insideTable2 = new google.visualization.DataTable(); // table inside
    
    
    outsideTable = new google.visualization.DataTable(); // table outside
    outsideTable2 = new google.visualization.DataTable(); // table outside

    outsideData = [];		//outside table data
    var summaryData = []; // summary table data
    var insideData = []; // inside table data
    for ( var i = 0; i < end.length; i++) {
        summaryData[i] = new Array();
        insideData[i] = new Array();
        outsideData[i] = new Array();
        // add id to hiden columns
        summaryData[i][0] = end[i].app_id;
        summaryData[i][7] = end[i].app_specify_flag;
        insideData[i][0] = end[i].app_id;
        insideData[i][9] = end[i].app_specify_flag;
        

        // app name + latest version
        summaryData[i][1] = end[i].app_name;
        summaryData[i][2] = end[i].version_update_date;
        
        insideData[i][1] = end[i].app_name;
        insideData[i][2] = end[i].insert_date;
        insideData[i][3] = end[i].current_version;
        insideData[i][4] = end[i].version_update_date;
        //		insideData[i][5] = end[i].last_sum_key_counter;
        //		insideData[i][6] = end[i].sum_key_counter;
        //		insideData[i][7] = insideData[i][6] - insideData[i][5];
        // inside
        // get end day keyword ranking
        exist = false;
        for ( var j = 0; j < sum_end.length; j++) {
            if (sum_end[j].app_id == end[i].app_id) {
                insideData[i][6] = sum_end[j].sum_key_counter;
                summaryData[i][5] = sum_end[j].search_view_rank;
                exist = true;
                break;
            }
        }
        if (!exist) {
            insideData[i][6] = '-';
            summaryData[i][5] = '-';
        }
		
        //get summary counter registration date
        exist = false;
        for ( var j = 0; j < sum_reg.length; j++) {
            if (sum_reg[j].app_id == end[i].app_id){	
                insideData[i][5] = sum_reg[j].sum_key_counter;
                summaryData[i][3] = sum_reg[j].search_view_rank;
                exist = true;
                break;
            }
        }
        
        if (!exist) {
            insideData[i][5] = '-';
            summaryData[i][3] = '-';
        }
        //get summary counter star date
        exist = false;
        for ( var j = 0; j < sum_start.length; j++) {
            if (sum_start[j].app_id == end[i].app_id){	
                insideData[i][7] = sum_start[j].sum_key_counter;
                summaryData[i][4] = sum_start[j].search_view_rank;
                exist = true;
                break;
            }
        }
        
        if (!exist) {
            insideData[i][7] = '-';
            summaryData[i][4] = '-';
        }
        insideData[i][8] = insideData[i][7] - insideData[i][6];
        
        // outside
        outsideData[i][0] = end[i].app_id;
        outsideData[i][71] = end[i].app_specify_flag;
        
        
        outsideData[i][1] = end[i].app_name;
        outsideData[i][2] = end[i].insert_date;

        outsideData[i][5] = end[i].all_rank_paid;
        outsideData[i][9] = end[i].all_rank_free;
        outsideData[i][13] = end[i].all_rank_new_free;
        outsideData[i][21] = end[i].all_rank_grossing;
        outsideData[i][25] = end[i].category_rank_paid;
        outsideData[i][29] = end[i].category_rank_free;
        outsideData[i][33] = end[i].category_rank_new_paid;
        outsideData[i][37] = end[i].category_rank_new_free;
        outsideData[i][41] = end[i].category_rank_grossing;
       
        
        outsideData[i][45] = end[j].all_game_free;
        outsideData[i][49] = end[j].all_game_paid;
        outsideData[i][53] = end[j].all_new_game_free;
        outsideData[i][57] = end[j].all_new_game_paid;
        outsideData[i][61] = end[j].all_game_grossing;
                
        outsideData[i][65] = end[i].rating;
        outsideData[i][69] = end[i].rating_count;

        var exist = false;
        // get register day info
        for ( var j = 0; j < reg.length; j++) {
            if (reg[j].app_id == end[i].app_id) {
                outsideData[i][3] = reg[j].all_rank_paid;
                outsideData[i][7] = reg[j].all_rank_free;
                outsideData[i][11] = reg[j].all_rank_new_paid;
                outsideData[i][15] = reg[j].all_rank_new_free;
                outsideData[i][19] = reg[j].all_rank_grossing;
                outsideData[i][23] = reg[j].category_rank_paid;
                outsideData[i][27] = reg[j].category_rank_free;
                outsideData[i][31] = reg[j].category_rank_new_paid;
                outsideData[i][35] = reg[j].category_rank_new_free;
                outsideData[i][39] = reg[j].category_rank_grossing;
                
                
                outsideData[i][43] = reg[j].all_game_free;
                outsideData[i][47] = reg[j].all_game_paid;
                outsideData[i][51] = reg[j].all_new_game_free;
                outsideData[i][55] = reg[j].all_new_game_paid;
                outsideData[i][59] = reg[j].all_game_grossing;
                
                outsideData[i][63] = reg[j].rating;
                outsideData[i][67] = reg[j].rating_count;
                
                exist = true;
                break;
            }
        }
        if (!exist) {
            outsideData[i][3] = "-";
            outsideData[i][7] = "-";
            outsideData[i][11] = "-";
            outsideData[i][15] = "-";
            outsideData[i][19] = "-";
            outsideData[i][23] = "-";
            outsideData[i][27] = "-";
            outsideData[i][31] = "-";
            outsideData[i][35] = "-";
            outsideData[i][39] = "-";
            
            outsideData[i][63] = "-";
            outsideData[i][67] = "-";
            
            outsideData[i][43] = "-";
            outsideData[i][47] = "-";
            outsideData[i][51] = "-";
            outsideData[i][55] = "-";
            outsideData[i][59] = "-";

        }

        // get start day info
        exist = false;
        for ( var j = 0; j < start.length; j++) {
            if (start[j].app_id == end[i].app_id) {
                outsideData[i][4] = start[j].all_rank_paid;
                outsideData[i][8] = start[j].all_rank_free;
                outsideData[i][12] = start[j].all_rank_new_free;
                outsideData[i][20] = start[j].all_rank_grossing;
                outsideData[i][24] = start[j].category_rank_paid;
                outsideData[i][28] = start[j].category_rank_free;
                outsideData[i][32] = start[j].category_rank_new_paid;
                outsideData[i][36] = start[j].category_rank_new_free;
                outsideData[i][40] = start[j].category_rank_grossing;
                
                
                outsideData[i][44] = reg[j].all_game_free;
                outsideData[i][48] = reg[j].all_game_paid;
                outsideData[i][52] = reg[j].all_new_game_free;
                outsideData[i][56] = reg[j].all_new_game_paid;
                outsideData[i][60] = reg[j].all_game_grossing;
                
                outsideData[i][64] = start[j].rating;
                outsideData[i][68] = start[j].rating_count;

                exist = true;
                break;
            }
        }
        if (!exist) {
            outsideData[i][4] = '-';
            outsideData[i][8] = '-';
            outsideData[i][12] = '-';
            outsideData[i][20] = '-';
            outsideData[i][24] = '-';
            outsideData[i][28] = '-';
            outsideData[i][32] = '-';
            outsideData[i][36] = '-';
            outsideData[i][40] = '-';
            
            outsideData[i][44] = '-';
            outsideData[i][48] = '-';
            outsideData[i][52] = '-';
            outsideData[i][56] = '-';
            outsideData[i][60] = '-';
            
            outsideData[i][64] = '-';
            outsideData[i][68] = '-';
        }

        // caculate dif
        var s = summaryData[i][4] == '-' ? 0 : summaryData[i][4];
        var e = summaryData[i][5] == '-' ? 0 : summaryData[i][5];
        summaryData[i][6] = e - s;
        s = outsideData[i][4] == '-' ? 0 : outsideData[i][4];
        e = outsideData[i][5] == '-' ? 0 : outsideData[i][5];

        outsideData[i][6] = e - s;

        outsideData[i][10] = outsideData[i][9] - outsideData[i][8];
        outsideData[i][14] = outsideData[i][13] - outsideData[i][12];
        outsideData[i][18] = outsideData[i][17] - outsideData[i][16];
        outsideData[i][22] = outsideData[i][21] - outsideData[i][20];
        outsideData[i][26] = outsideData[i][25] - outsideData[i][24];
        outsideData[i][30] = outsideData[i][29] - outsideData[i][28];
        outsideData[i][34] = outsideData[i][33] - outsideData[i][32];
        outsideData[i][38] = outsideData[i][37] - outsideData[i][36];
        outsideData[i][42] = outsideData[i][41] - outsideData[i][40];
        
        outsideData[i][46] = outsideData[i][45] - outsideData[i][44];
        outsideData[i][50] = outsideData[i][49] - outsideData[i][48];
        outsideData[i][54] = outsideData[i][53] - outsideData[i][52];
        outsideData[i][58] = outsideData[i][58] - outsideData[i][57];
        outsideData[i][62] = outsideData[i][61] - outsideData[i][60];
        
        outsideData[i][66] = outsideData[i][65] - outsideData[i][64];
        outsideData[i][70] = outsideData[i][69] - outsideData[i][68];

    }

	
    // add columns table summary
    summaryTable.addColumn('string', 'app_id');// 0
    summaryTable.addColumn('string', 'app name');// 1
    summaryTable.addColumn('string', 'lastest update');// 2
    summaryTable.addColumn('string', 'Registration date');// 3
    summaryTable.addColumn('string', 'Start date rank');// 4
    summaryTable.addColumn('string', 'End date rank');// 5
    summaryTable.addColumn('number', 'Dif');// 6
    summaryTable.addColumn('string', 'app_specify_flag')//7
    drawTable(summaryTable, summaryData, 'summary_app_table1', [ 0, 7 ]);
    
    // add columns table summary2
    summaryTable2.addColumn('string', 'app_id');// 0
    summaryTable2.addColumn('string', 'app name');// 1
    summaryTable2.addColumn('string', 'lastest update');// 2
    summaryTable2.addColumn('string', 'Registration date');// 3
    summaryTable2.addColumn('string', 'Start date rank');// 4
    summaryTable2.addColumn('string', 'End date rank');// 5
    summaryTable2.addColumn('number', 'Dif');// 6
    summaryTable2.addColumn('string', 'app_specify_flag')//7
   
    summaryData2 = new Array();
    var j = 0;
    for(i = 0; i < summaryData.length; i++){
        if(summaryData[i][7] == '2'){
            summaryData2[j++] = summaryData[i];
        }
    }
    
    drawTable(summaryTable2, summaryData2, 'summary_app_table2', [0, 7])
   

    // table inside
    insideTable.addColumn('string', 'app-id');//0
    insideTable.addColumn('string', 'app-name');//1
    insideTable.addColumn('string', 'registration date');//2
    insideTable.addColumn('string', 'version');//3
    insideTable.addColumn('string', 'Latest update');               //4
    insideTable.addColumn('string', 'Registration date counter');   //5
    insideTable.addColumn('string', 'Start day counter');           //6
    insideTable.addColumn('string', 'End day counter');             //7
    insideTable.addColumn('number', 'Dif');                         //8
    insideTable.addColumn('string', 'app_specify_flag')             //9
    drawTable(insideTable, insideData, 'details_app_table1', [ 0 ]);

    // table inside2
    insideTable2.addColumn('string', 'app-id');//0
    insideTable2.addColumn('string', 'app-name');//1
    insideTable2.addColumn('string', 'registration date');//2
    insideTable2.addColumn('string', 'version');//3
    insideTable2.addColumn('string', 'Latest update');               //4
    insideTable2.addColumn('string', 'Registration date counter');   //5
    insideTable2.addColumn('string', 'Start day counter');           //6
    insideTable2.addColumn('string', 'End day counter');             //7
    insideTable2.addColumn('number', 'Dif');                         //8
    insideTable2.addColumn('string', 'app_specify_flag')             //9
    insideData2 = new Array();
    var j = 0;
    for(i = 0; i < insideData.length; i++){
        if(insideData[i][9] == '2'){
            insideData2[j++] = insideData[i];
        }
    }
    
    drawTable(insideTable2, insideData2, 'details_app_table2', [0, 9])
    

    addColumn(outsideTable);
    
    //    outsiteTable.addColumn('string', 'app_specify_flag')//51
    drawTable(outsideTable, outsideData, 'ranking_table1',
        [ 0, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22,
        23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37,
        38, 39, 40, 41, 42, 43, 44, 45, 46, 47 ,48 ,49 ,50 ,51, 52, 53, 54, 55, 56, 57, 58, 59, 60 ,61, 62, 71
        ]);
    addColumn(outsideTable2);
    j=0;
    for(i = 0; i < outsideData.length; i++){
        if(outsideData[i][71] == '2'){
            outsideData2[j++] = outsideData[i];
        }
    }
    drawTable(outsideTable2, outsideData2, 'ranking_table2',
        [ 0, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22,
        23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37,
        38, 39, 40, 41, 42, 43, 44, 45, 46, 47 ,48 ,49 ,50 ,51, 52, 53, 54, 55, 56, 57, 58, 59, 60 ,61, 62, 71
        ]);
        
    //    $('#graphic').html() = '';
    drawLineChart(data, 'graphic', keyword.keyword);
    console.log(data);
}

function drawLineChart(data, container, titles) {
    var chart = new google.visualization.LineChart(document
        .getElementById(container));
    
    var dataLine = google.visualization.arrayToDataTable(data);

    var options = {
        title : titles,
        pointSize: 5,
        hAxis:  {title: 'Date',  titleTextStyle: {color: '#FF0000'}},
        vAxis: {title: 'app view number', titleTextStyle: {color: '#FF0000'}, format: ''}
    };

    
    chart.draw(dataLine, options);

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
        //		var link = "http://localhost:8888/googleplay_seo/index.php/app/detail/" ;
        //		var link = "http://ec2-54-251-4-64.ap-southeast-1.compute.amazonaws.com/googleplay_seo/index.php/app/detail/";	
        var link = getRootUrl() + "/googleplay_seo/index.php/app/detail/";
        onRowClickHandler(table, data,link, 0);
    }
}

function onRowClickHandler(table, data,link, index) {
    var selection = table.getSelection();
    var app_id = '';
    for ( var i = 0; i < selection.length; i++) {
        var item = selection[i];
        var row = item.row == null ? 0 : item.row;
        app_id = data.getFormattedValue(row, index);
    }
    link += app_id;
    // go to app details
    window.location = link;
}

function addColumn(outsideTable){
    // outside table
    outsideTable.addColumn('string', 'app-id'); // 0
    outsideTable.addColumn('string', 'app-name'); // 1
    outsideTable.addColumn('string', 'registration date'); // 2
    // all paid
    outsideTable.addColumn('string', 'all paid reg'); // 3
    outsideTable.addColumn('string', 'all paid start'); // 4
    outsideTable.addColumn('string', 'all paid end'); // 5
    outsideTable.addColumn('number', 'all paid dif'); // 6
    // all free
    outsideTable.addColumn('string', 'all free reg'); // 7
    outsideTable.addColumn('string', 'all free start'); // 8
    outsideTable.addColumn('string', 'all free end'); // 9
    outsideTable.addColumn('number', 'all free dif'); // 10

    // all new paid
    outsideTable.addColumn('string', 'all new paid reg'); // 11
    outsideTable.addColumn('string', 'all new paid start'); // 12
    outsideTable.addColumn('string', 'all new paid end'); // 13
    outsideTable.addColumn('number', 'all new paid dif'); // 14

    // all new free
    outsideTable.addColumn('string', 'all new free reg'); // 15
    outsideTable.addColumn('string', 'all new free start'); // 16
    outsideTable.addColumn('string', 'all new free end'); // 17
    outsideTable.addColumn('number', 'all new free dif'); // 18

    // all grossing
    outsideTable.addColumn('string', 'all grossing reg'); // 19
    outsideTable.addColumn('string', 'all grossing start'); // 20
    outsideTable.addColumn('string', 'all grossing end'); // 21
    outsideTable.addColumn('number', 'all grossing dif'); // 22

    // category paid
    outsideTable.addColumn('string', 'category paid reg'); // 23
    outsideTable.addColumn('string', 'category paid start'); // 24
    outsideTable.addColumn('string', 'category paid end'); // 25
    outsideTable.addColumn('number', 'category paid dif'); // 26
    // category free
    outsideTable.addColumn('string', 'category free reg'); // 27
    outsideTable.addColumn('string', 'category free start'); // 28
    outsideTable.addColumn('string', 'category free end'); // 29
    outsideTable.addColumn('number', 'category free dif'); // 30

    // category new paid
    outsideTable.addColumn('string', 'category new paid reg'); // 31
    outsideTable.addColumn('string', 'category new paid start'); // 32
    outsideTable.addColumn('string', 'category new paid end'); // 33
    outsideTable.addColumn('number', 'category new paid dif'); // 34

    // category new free
    outsideTable.addColumn('string', 'category new free reg'); // 35
    outsideTable.addColumn('string', 'category new free start'); // 36
    outsideTable.addColumn('string', 'category new free end'); // 37
    outsideTable.addColumn('number', 'category new free dif'); // 38

    // category grossing
    outsideTable.addColumn('string', 'category grossing reg'); // 39
    outsideTable.addColumn('string', 'category grossing start'); // 40
    outsideTable.addColumn('string', 'category grossing end'); // 41
    outsideTable.addColumn('number', 'category grossing dif'); // 42
    
    outsideTable.addColumn('string', 'all game free reg'); // 43
    outsideTable.addColumn('string', 'all game free start'); // 44
    outsideTable.addColumn('string', 'all game free end'); // 45
    outsideTable.addColumn('number', 'all game free dif'); // 46
    
    outsideTable.addColumn('string', 'all game paid reg'); // 47
    outsideTable.addColumn('string', 'all game paid start'); // 48
    outsideTable.addColumn('string', 'all game paid end'); // 49
    outsideTable.addColumn('number', 'all game paid dif'); // 50
    
    
    outsideTable.addColumn('string', 'all new game free reg'); // 51
    outsideTable.addColumn('string', 'all new game free start'); // 52
    outsideTable.addColumn('string', 'all new game free end'); // 53
    outsideTable.addColumn('number', 'all new game free dif'); // 54
    
    
    outsideTable.addColumn('string', 'all new game paid reg'); // 55
    outsideTable.addColumn('string', 'all new game paid start'); // 56
    outsideTable.addColumn('string', 'all new game paid end'); // 57
    outsideTable.addColumn('number', 'all new game paid dif'); // 58
    
    outsideTable.addColumn('string', 'all game grossing reg'); // 59
    outsideTable.addColumn('string', 'all game grossing start'); // 60
    outsideTable.addColumn('string', 'all game grossing end'); // 61
    outsideTable.addColumn('number', 'all game grossing dif'); // 62
    
    // category grossing
    outsideTable.addColumn('string', 'rate mean reg'); // 63
    outsideTable.addColumn('string', 'rate mean start'); // 64
    outsideTable.addColumn('string', 'rate mean end'); // 65
    outsideTable.addColumn('number', 'rate mean dif'); // 66

    // category grossing
    outsideTable.addColumn('string', 'rate count reg'); // 67
    outsideTable.addColumn('string', 'rate count start'); // 68
    outsideTable.addColumn('string', 'rate count end'); // 69
    outsideTable.addColumn('number', 'rate count dif'); // 70
    
    outsideTable.addColumn('string', 'app specify flag'); // 71
    
}