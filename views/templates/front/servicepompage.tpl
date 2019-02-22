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
        <h1>{l s='Send a Devis' d='Modules.demandedevis'}</h1>
        <p>{l s='If you would like to add a comment about your order, please write it in the field below.' d='Modules.Contactform.Shop'}</p>


            <div id="service-residentiel">
                <input name="service-residentiel" class="hidden"/>
                <h1 class="h3 center-block">{l s='Service Pompage' d='Modules.demandedevis'}</h1>
            </div>
  {*      {if $notifications}
            <div class="notification {if $notifications.nw_error}notification-error{else}notification-success{/if}">
                <ul>
                    {foreach $notifications.messages as $notif}
                        <li>{$notif}</li>
                    {/foreach}
                </ul>
            </div>
        {/if}*}
        <form class="form" action="{$devis_controller_url}" method="post">
            <div class="row">
                <h3>Exploration des besoins</h3>
                <div class="besoin1">
                <div class="form-group col-md-6 besoin">
                    <label for="pwd">{l s='Avez-vous déjà un forage d’eau ?'  mod='devisservice'} </label>
                    <div class="form-check">
                        <input class="form-check-input" name="forage" type="radio" id="localiteCheckbox1" value="forage1">
                        <label class="form-check-label" for="localiteCheckbox1">oui</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="forage" checked="" type="radio" id="localiteCheckbox2" value="forage2">
                        <label class="form-check-label" for="localiteCheckbox2">Non</label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="hidden">Dans quelle localité vous trouvez vous ? </label>
                    <div class="form-check hidden">
                        <input class="form-check-input" type="radio" name="coupureCheckbox1" id="coupureCheckbox1" value="coupure1">
                        <label for="coupureCheckbox1">oui</label>
                    </div>
                    <div class="form-check hidden">
                        <input class="form-check-input" type="radio" name="coupureCheckbox1" id="coupureCheckbox2" value="coupure2">
                        <label for="coupureCheckbox2">Non</label>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="pwd">Dans quelle localité vous trouvez vous ?</label>
                    <input type="text" name="localite2" class="form-control" id="pwd1">
                </div>
                <div class="form-group col-md-6">
                    <label for="pwd">Quels sont vos besoins journaliers en eau (quantité d’eau en litre consommée par
                        jour)</label>
                    <input type="number" name="qteDeau" class="form-control" id="pwd2">
                </div>
            </div></div>
            <div class="row">
                <h3>Dimensionnement (évaluation technique)</h3>
                <div class="contener">
                    <div class="form-group col-md-6">
                        <label for="pwd">Choix de la pompe (il sera question ici de choisir une pompe en fonction de la
                            hauteur manométrique totale du forage et du débit d’eau à fournir)</label>
                        <input type="text" name="appareils" class="form-control" id="pwd2">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pwd">Choix de la puissance crête nécessaire pour pomper l’eau</label>
                        <input type="text" name="puissance" class="form-control" id="pwd2">
                    </div>
                   {* <div class="form-group col-md-6">
                        <label for="pwd">En cas de délestage quels appareils aimeriez-vous faire fonctionner ?</label>
                        <select  class="form-control dd_select" id="appareils" name="appareils">
                            <option>choisir appareils</option>
                            <option value="ampoule">éclairage ampoule </option>
                            <option value="television">télévision</option>
                            <option value="ventilateur">ventilateurs</option>
                            <option value="ordinateur">ordinateurs</option>
                            <option value="radio">Radio</option>
                            <option value="frigo-congelateur">frigo ou congélateur</option>
                        </select>
                    </div>*}
                </div>
            </div>
            <button class="btn btn-success" type="submit" name="submitpompage">Demander un Devis</button>

        </form>
        <br>
    </div>
{/block}
