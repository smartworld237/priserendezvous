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
                <input type="hidden" id="rep">
            <input type="hidden" id="url" value="{$prise_controller_url}">
                {*<button type="submit" name="action">test</button>*}
                <button type="submit" class="btn btn-primary col-sm-6" name="action" id="previous" onclick="previousWeek()"><i class="fa fa-arrow-circle-left"></i> Previous</button>

                <button class="btn btn-primary col-sm-6" id="next" onclick="nextWeek()">Next <i class="fa fa-arrow-circle-right"></i></button>
            </div>

            <table class="table table-bordered" id="week">
                <thead id="week-change"  style="background-color: #0f6ab4;color: #0a0a0a"></thead>
                <tbody id="body-week">
                <tr id="body-tr"></tr>

                </tbody>

            </table>
            <div class="loader center-block hidden"></div>
        </div>
        <br>
        <br>
        {*<div class="row">
            <h3 class="card-header col-md-3" id="monthAndYear"></h3>
            <div class="col-md-3 pull-right form-inline">

                <button class="btn btn-outline-primary col-sm-6" id="previous" onclick="previous()"><i class="fa fa-arrow-circle-left"></i> Previous</button>

                <button class="btn btn-outline-primary col-sm-6" id="next" onclick="next()">Next <i class="fa fa-arrow-circle-right"></i></button>
            </div>
        </div>

        <table class="table table-bordered table-responsive-sm" id="calendar">
            <thead  style="background-color: #0f6ab4;color: #0a0a0a">
            </thead>
            <tbody id="calendar-body">

            </tbody>

        </table>

    </div>*}
{/block}
