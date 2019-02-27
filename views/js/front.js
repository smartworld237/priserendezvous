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
    $.ajax({
        url : $('#url').val(),
        type : 'GET',
        dataType : 'json',
        data:'action_name',
        success : function(resultat, statut){ // success est toujours en place, bien sûr !
            console.log(resultat);
            // swal(nameProduct, "is added to cart !", "success");
        },

        error : function(resultat, statut, erreur){

        }

    });
    var day=new Date();
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
alert(url);
currentMonth = today.getMonth();
currentYear = today.getFullYear();
selectYear = document.getElementById("year");
selectMonth = document.getElementById("month");

months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);


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
    thead=document.getElementById("week-change");
    thead.innerHTML="";
    let row = document.createElement("tr");
   /* $.ajax({
        url : url,
        type : 'GET',
        dataType : 'json',
        data:'action_name',
        success : function(resultat, statut){ // success est toujours en place, bien sûr !
            console.log(resultat);
            // swal(nameProduct, "is added to cart !", "success");
        },

        error : function(resultat, statut, erreur){

        }

    });*/
    for (let i=0;i<7;i++){
        var d2 = addDays(day, i);
        cell = document.createElement("td");
        cellText = document.createTextNode(jours[i]);
        cellText2=document.createTextNode(d2.toDateString());
        //cell.appendChild(cellText);
        cell.appendChild(cellText2);
        row.appendChild(cell);
    }
    thead.appendChild(row);

}
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