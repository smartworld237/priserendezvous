/**
* 2007-2019 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
$(document).ready(function () {
    var $searchWidget = $('#url');
    //var $searchBox    = $("select[class=dd_select]", $element).val()
    var searchURL     = $searchWidget.attr('data-search-controller-url');
    var day=new Date();
    //alert(formatDate(day));
   // init2(day);
    var jours2=["Monday","Tuesday","Wednesday","Jeudi","vendredi","samedi","Dimanche"];
    function init2(day) {

        var $thead=$('#week-change');
        $thead.innerHTML="";
        var $row = $thead.append("<tr>");

        for (let i=0;i<7;i++){
            var d2 = addDays(day, i);
            cell = $row.append("<td>"+d2.toDateString());
            cellText = document.createTextNode(jours[i]);
            cellText2=document.createTextNode(d2.toDateString());
            //cell.appendChild(cellText);
           // cell.append(cellText2);
            $row.append(cell);
        }
        $thead.append($row);

    }
    $('#next1').on('click',function () {

        day.setDate(day.getDate()+7);
        //alert(today);
        this.init(day);
    });
    $('#previous1').on('click',function () {
        day.setDate(day.getDate()-7);
        this.init(day);
    });
    function nextWeek() {
        day.setDate(day.getDate()+7);
        //alert(today);
        init(day);
    }
    function previousWeek() {
        day.setDate(day.getDate()-7);
        init(day);
    }
});
today = new Date();
jours = ["Dimanche","Monday","Tuesday","Wednesday","Jeudi","vendredi","samedi"];
init(today);

var url     =$('#url').val();

currentMonth = today.getMonth();
currentYear = today.getFullYear();
selectYear = document.getElementById("year");
selectMonth = document.getElementById("month");

months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

monthAndYear = document.getElementById("monthAndYear");
//showCalendar(currentMonth, currentYear);


function next() {

    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
}
function nextWeek() {
    today.setDate(today.getDate()+7);
    //alert(today);
    init(today);
}
function previousWeek() {
    today.setDate(today.getDate()-7);
    init(today);
}

function init(day) {
    let toDay = day.getDay();
    let reponse=[];
    thead=document.getElementById("week-change");
    thead.innerHTML="";
    let row = document.createElement("tr");
    for (let i=0;i<7;i++){
        var d2 = addDays(day, i);
        $('#week-change').append('<td>'+d2.toDateString()+'</td>');
       /* cell = document.createElement("td");
        cellText = document.createTextNode(jours[i]);
        cellText2=document.createTextNode(d2.toDateString());
        //cell.appendChild(cellText);
        cell.appendChild(cellText2);
        row.appendChild(cell);*/

    }
    $('#body-week > tr').remove();
    $('.loader').removeClass('hidden');
    $.ajax({
        url : url,
        type : 'GET',
        dataType : 'json',
        data:{
            action_reponse:'action_reponse'
        },
        success : function(resultat, statut){ // success est toujours en place, bien sûr !
            $.each( resultat, function( key, value ) {
                for (let i = 1; i < 2; i++) {

                    $('#body-week').append('<tr>');
                for (let j=0;j<7;j++) {
                    console.log(j + "-" + key);
                    var daz = addDays(day, j);
                   // let reponse=[];
                    $.ajax({
                        url : url,
                        type : 'GET',
                        async: false,
                        dataType : 'json',
                        data:{
                            rendevs:'rendevs',
                            jour:formatDate(daz),
                            id_crenneau:value.id_priserendezvouscreneaux
                        },
                        success : function(result, statut){ // success est toujours en place, bien sûr !
                            console.log(result);
                           //reponse = result;
                            $('#rep').text(result.length);
                            //alert($('#rep').val());
                            /*if (result.resp===false) {
                                $('tr:last').append('<td><span class="hidden">'+value.id_priserendezvouscreneaux+'</span><span class="btn btn-warning"  id="testtd">' + value.hdebut + ':' + value.mdebut + '-' + value.hfin + ':' + value.mfin+'' +
                                    '</span><span class="hidden">'+daz.toISOString()+'</span>');
                            }else {
                                $('tr:last').append('<td><span class="hidden">'+value.id_priserendezvouscreneaux+'</span><span class="btn btn-warning" disabled>' + value.hdebut + ':' + value.mdebut + '-' + value.hfin + ':' + value.mfin+'' +
                                    '</span><span class="hidden">'+daz.toISOString()+'</span>');
                            }*/
                        },

                        error : function(re, statut, erreur){

                        }

                    });
                    //alert($('#rep').text());
                    if ($('#rep').text() < 1) {
                        $('tr:last').append('<td><span class="hidden">'+value.id_priserendezvouscreneaux+'</span><span class="btn btn-warning"  id="testtd">' + value.hdebut + ':' + value.mdebut + '-' + value.hfin + ':' + value.mfin+'' +
                            '</span><span class="hidden">'+daz.toISOString()+'</span>');
                    }else {
                        $('tr:last').append('<td><span class="hidden">'+value.id_priserendezvouscreneaux+'</span><span class="btn btn-danger disabled">' + value.hdebut + ':' + value.mdebut + '-' + value.hfin + ':' + value.mfin+'' +
                            '</span><span class="hidden">'+daz.toISOString()+'</span>');
                    }
                    $('.loader').addClass('hidden');
                /*    if ( (j % 2) == 0) {
                        $('tr:last').append('<td><span class="hidden">'+value.id_priserendezvouscreneaux+'</span><span class="btn btn-warning disabled">' + value.hdebut + ':' + value.mdebut + '-' + value.hfin + ':' + value.mfin+'' +
                            '</span><span class="hidden">'+daz.toISOString()+'</span>');
                    } else {
                        $('tr:last').append('<td><span class="hidden">'+value.id_priserendezvouscreneaux+'</span><span class="btn btn-warning"  id="testtd">' + value.hdebut + ':' + value.mdebut + '-' + value.hfin + ':' + value.mfin+'' +
                            '</span><span class="hidden">'+daz.toISOString()+'</span>');
                    }*/

                }
                }
            });

        },

        error : function(resultat, statut, erreur){

        }

    });
   // thead.appendChild(row);

}
/*$('#body-week >tr>td>').click(function() {
    $test = $(this).text();
   // $('#input').val($test);
    alert($test)
}
);*/
//$("#testtd").attr("disabled", "disabled");
//$("tbody td").find("span:first").text();
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
$("#body-week").on("click", "td", function(e) {
    //e.preventDefault();
let cr=$('span:first', this).text();
let j=$('span:last', this).text();
   // $(this).find("#testtd").attr("disabled", "disabled");
    $('#testtd', this).on("click",function () {
      //  alert($("tbody td").find("span:first").text());
        alert($(this).text());
        $.ajax({
            url : url,
            type : 'GET',
            dataType : 'json',
            data:{
                action:'action',
                jour:j,
                id_crenneaux:cr
            },
            success : function(resultat, statut){ // success est toujours en place, bien sûr !
                console.log(resultat);
            },

            error : function(resultat, statut, erreur){

            }

        });
    });

});

function addDays(date, amount) {
    var tzOff = date.getTimezoneOffset() * 60 * 1000,
        t = date.getTime(),
        d = new Date(),
        tzOff2;

    t += (1000 * 60 * 60 * 24) * amount;
    d.setTime(t);

    tzOff2 = d.getTimezoneOffset() * 60 * 1000;
    if (tzOff != tzOff2) {
        var diff = tzOff2 - tzOff;
        t += diff;
        d.setTime(t);
    }

    return d;
}
// ADD A NEW ROW TO THE TABLE.s
function addRow() {
    var empTab = document.getElementById('week');

    var rowCnt = empTab.rows.length;        // GET TABLE ROW COUNT.
    var tr = empTab.insertRow(rowCnt);      // TABLE ROW.
    tr = empTab.insertRow(rowCnt);

    for (var c = 0; c < 7; c++) {
        var td = document.createElement('td');          // TABLE DEFINITION.
        td = tr.insertCell(c);

        if (c == 0) {           // FIRST COLUMN.
            // ADD A BUTTON.
            var button = document.createElement('input');

            // SET INPUT ATTRIBUTE.
            button.setAttribute('type', 'button');
            button.setAttribute('value', 'Remove');

            // ADD THE BUTTON's 'onclick' EVENT.
            button.setAttribute('onclick', 'removeRow(this)');

            td.appendChild(button);
        }
        else {
            // CREATE AND ADD TEXTBOX IN EACH CELL.
            var ele = document.createElement('input');
            ele.setAttribute('type', 'text');
            ele.setAttribute('value', '');

            td.appendChild(ele);
        }
    }
}
function showCalendar(month, year) {
    //alert("test");
    let firstDay = (new Date(year, month)).getDay();

    tbl = document.getElementById("calendar-body"); // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";

    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    let date = 1;
    for (let i = 0; i < 6; i++) {
        // creates a table row
        let row = document.createElement("tr");

        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                cell = document.createElement("td");
                cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            }
            else if (date > daysInMonth(month, year)) {
                break;
            }

            else {
                cell = document.createElement("td");
                cellText = document.createTextNode(date);
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("bg-info");
                } // color today's date
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }


        }

        tbl.appendChild(row); // appending each row into calendar body.
    }

}


// check how many days in a month code from https://dzone.com/articles/determining-number-days-month
function daysInMonth(iMonth, iYear) {
    return 32 - new Date(iYear, iMonth, 32).getDate();
}