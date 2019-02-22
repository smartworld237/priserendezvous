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
        <h1>{l s='Send a Devis' d='Modules.Devisservice.Shop'}</h1>
        <p>{l s='If you would like to add a comment about your order, please write it in the field below.' mod='devisservice'}</p>


            <div id="service-residentiel">
                <input name="service-residentiel" class="hidden"/>
                <h1 class="h3 center-block">{l s='Service Backup'  mod='devisservice'}</h1>
            </div>
        <form class="form" action="{$devis_controller_url}" method="post">
            <div class="row">
                <h3>{l s='Exploration des besoins' mod='devisservice'}</h3>
                <div class="form-group col-md-6">
                    <label for="pwd">{l s='Votre localité est-elle alimentée par le courant électrique ?' mod='devisservice'} </label>
                    <div class="form-check">
                        <input class="form-check-input" name="localite" checked="" type="radio" id="localiteCheckbox1" value="localite1">
                        <label class="form-check-label" for="localiteCheckbox1">{l s='oui' mod='devisservice'}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="localite" type="radio" id="localiteCheckbox2" value="localite2">
                        <label class="form-check-label" for="localiteCheckbox2">{l s='Non' mod='devisservice'}</label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>{l s='Etes-vous victime des coupures intempestives du courant électrique ?' mod='devisservice' } </label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="coupureCheckbox1" id="coupureCheckbox1" value="coupure1">
                        <label for="coupureCheckbox1">{l s='oui' mod='devisservice'}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="coupureCheckbox1" id="coupureCheckbox2" value="coupure2">
                        <label for="coupureCheckbox2">{l s='Non' mod='devisservice'}</label>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="pwd">{l s='Combien de temps peut durer une coupure de courant électriques ?' mod='devisservice'}</label>
                    <input type="number" name="qte_electrique" class="form-control" id="pwd1">
                </div>
                <div class="form-group col-md-6">
                    <label for="pwd">{l s='Dans quelle localité vous trouvez vous ?' mod='devisservice'}</label>
                    <input type="text" name="localite2" class="form-control" id="pwd2">
                </div>
            </div>
            <div class="row">
                <h3>{l s='Dimensionnement (évaluation technique)' mod='devisservice'}</h3>
                <div class="contener">
                    <div class="form-group col-md-6">
                        <label for="pwd">{l s='En cas de délestage quels appareils aimeriez-vous faire fonctionner ?' mod='devisservice'}</label>
                        <select  class="form-control dd_select" id="pwd1" name="appareils">
                            <option>{l s='choisir appareils' mod='devisservice'}</option>
                            <option value="ampoule">{l s='éclairage ampoule' mod='devisservice'} </option>
                            <option value="television">{l s='télévision' mod='devisservice'}</option>
                            <option value="ventilateur">{l s='ventilateurs' mod='devisservice'}</option>
                            <option value="ordinateur">{l s='ordinateurs' mod='devisservice'}</option>
                            <option value="radio">{l s='Radio' mod='devisservice'}</option>
                            <option value="frigo-congelateur">{l s='frigo ou congélateur' mod='devisservice'}</option>
                        </select>
                    </div>
                </div>
            </div>
            <button class="btn btn-success" type="submit" name="submitbackup">{l s='Demander un Devis' mod='devisservice'}</button>

        </form>
        <br>
    </div>
{/block}
