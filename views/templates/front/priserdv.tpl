{*
* 2007-2015 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{extends file='page.tpl'}
{block name='content'}

    <div class="container">
        {$test}
        <h1>{l s='Prendre un rendez-vous' d='Modules.demandedevis'}</h1>
        <div class="row">
            <div class="col-md-3 pull-right form-inline">
<input type="hidden" id="url" value="{$prise_controller_url}">
                {*<button type="submit" name="action">test</button>*}
                <button type="submit" class="btn btn-primary col-sm-6 disabled" name="action" id="previous" onclick="previousWeek()"><i class="fa fa-arrow-circle-left"></i> Previous</button>

                <button class="btn btn-primary col-sm-6" id="next" onclick="nextWeek()">Next <i class="fa fa-arrow-circle-right"></i></button>
            </div>
            <table class="table table-bordered" id="week">
                <thead id="week-change"  style="background-color: #0f6ab4;color: #0a0a0a"></thead>
                <tbody id="body-week">
                <tr id="body-tr"></tr>
                </tbody>

            </table>

        </div>
        <div class="row">
            <h3 class="card-header col-md-3" id="monthAndYear"></h3>
            <div class="col-md-3 pull-right form-inline">

                <button class="btn btn-outline-primary col-sm-6" id="previous" onclick="previous()"><i class="fa fa-arrow-circle-left"></i> Previous</button>

                <button class="btn btn-outline-primary col-sm-6" id="next" onclick="next()">Next <i class="fa fa-arrow-circle-right"></i></button>
            </div>
        </div>

        <table class="table table-bordered table-responsive-sm" id="calendar">
            <thead  style="background-color: #0f6ab4;color: #0a0a0a">
        {*    <tr style="border: 1px solid #999;">
                <th scope="col">#</th>
                <th scope="col">Lundi</th>
                <th scope="col">Mardi</th>
                <th scope="col">Mercredi</th>
                <th scope="col">Jeudi</th>
                <th scope="col">Vendredi</th>
                <th scope="col">Samedi</th>
                <th scope="col">Dimanche</th>
            </tr>*}
   {*     <tr>
            <th>Sun</th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
        </tr>*}
            </thead>
            <tbody id="calendar-body">

            </tbody>

        </table>

        <br/>
        <form class="form-inline">
            <label class="lead mr-2 ml-2" for="month">Jump To: </label>
            <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
                <option value=0>Jan</option>
                <option value=1>Feb</option>
                <option value=2>Mar</option>
                <option value=3>Apr</option>
                <option value=4>May</option>
                <option value=5>Jun</option>
                <option value=6>Jul</option>
                <option value=7>Aug</option>
                <option value=8>Sep</option>
                <option value=9>Oct</option>
                <option value=10>Nov</option>
                <option value=11>Dec</option>
            </select>


            <label for="year"></label><select class="form-control col-sm-4" name="year" id="year" onchange="jump()">
                <option value=1990>1990</option>
                <option value=1991>1991</option>
                <option value=1992>1992</option>
                <option value=1993>1993</option>
                <option value=1994>1994</option>
                <option value=1995>1995</option>
                <option value=1996>1996</option>
                <option value=1997>1997</option>
                <option value=1998>1998</option>
                <option value=1999>1999</option>
                <option value=2000>2000</option>
                <option value=2001>2001</option>
                <option value=2002>2002</option>
                <option value=2003>2003</option>
                <option value=2004>2004</option>
                <option value=2005>2005</option>
                <option value=2006>2006</option>
                <option value=2007>2007</option>
                <option value=2008>2008</option>
                <option value=2009>2009</option>
                <option value=2010>2010</option>
                <option value=2011>2011</option>
                <option value=2012>2012</option>
                <option value=2013>2013</option>
                <option value=2014>2014</option>
                <option value=2015>2015</option>
                <option value=2016>2016</option>
                <option value=2017>2017</option>
                <option value=2018>2018</option>
                <option value=2019>2019</option>
                <option value=2020>2020</option>
                <option value=2021>2021</option>
                <option value=2022>2022</option>
                <option value=2023>2023</option>
                <option value=2024>2024</option>
                <option value=2025>2025</option>
                <option value=2026>2026</option>
                <option value=2027>2027</option>
                <option value=2028>2028</option>
                <option value=2029>2029</option>
                <option value=2030>2030</option>
            </select></form>
    </div>
{/block}
