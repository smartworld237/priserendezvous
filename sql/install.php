<?php
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
*/
$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'priserendezvous` (
    `id_priserendezvous` int(11) NOT NULL AUTO_INCREMENT,
     `id_priserendezvouscreneaux` int(11) NOT NULL,
      `id_client` int(11) NOT NULL,
      `jour` date NOT NULL,
    PRIMARY KEY  (`id_priserendezvous`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'priserendezvouscreneaux` (
    `id_priserendezvouscreneaux` int(11) NOT NULL AUTO_INCREMENT,
      `hdebut` int(11) NOT NULL,
       `hfin` int(11) NOT NULL,
        `mdebut` int(11) NOT NULL,
         `mfin` int(11) NOT NULL,
         `id_priserendezvousdepartement` int(11) NOT NULL,
    PRIMARY KEY  (`id_priserendezvouscreneaux`)
    
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'priserendezvousdepartement` (
    `id_priserendezvousdepartement` int(11) NOT NULL AUTO_INCREMENT,
    `telephone` text NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP ,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY  (`id_priserendezvousdepartement`)
    
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'priserendezvousdepartement_lang` (
  `id_priserendezvousdepartement` int(11) NOT NULL auto_increment,
  `id_lang` int(11) NOT NULL ,
      `nom_departement` text NOT NULL,
      
  PRIMARY KEY (`id_priserendezvousdepartement`,`id_lang`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';
foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
