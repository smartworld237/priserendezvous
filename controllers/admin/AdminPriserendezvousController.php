<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18/02/2019
 * Time: 11:27
 */
require_once _PS_MODULE_DIR_ . 'priserendezvous/classes/PriserendezvousModel.php';
class AdminPriserendezvousController extends ModuleAdminController
{
    public function __construct()
    {
        $this->addRowAction('view');
        $this->addRowAction('delete');

// Set variables
        $this->table = 'Priserendezvous';
        $this->className = 'PriserendezvousModel';
        $this->identifier = 'id_priserendezvous';
        //$this->lang = true;
        $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');
        $this->fields_list = array(
            'id_priserendezvous' => array('title' => "ID", 'align' =>
                'center', 'width' => 25),
            'nom_departement' => array('title' => "Departement", 'align' =>
                'center', 'width' => 25),
            'client' => array('title' => "Client", 'align' =>
                'center', 'width' => 25),

            'jour' => array('title' => "Jour", 'align' =>
                'center', 'width' => 25),

            'hdebut' => array('title' => "Heure debut", 'align' =>
                'center', 'width' => 15),

            'mdebut' => array('title' => "Minuite Fin", 'align' =>
                'center', 'width' => 15),

            'hfin' => array('title' => "Heure Fin", 'align' =>
                'center', 'width' => 15),

            'mfin' => array('title' => "Minuite Fin", 'align' =>
                'center', 'width' => 15),
        );
        $this->_select = ' a.`*`, cr.`*`,dl.`*`, c.`firstname` as client';
        $this->_join='LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (a.`id_client` = c.`id_customer`) 
         LEFT JOIN `' . _DB_PREFIX_ . 'priserendezvouscreneaux` cr ON (a.`id_priserendezvouscreneaux` = cr.`id_priserendezvouscreneaux`)
           LEFT JOIN `' . _DB_PREFIX_ . 'priserendezvousdepartement` d ON (cr.`id_priserendezvousdepartement` = d.`id_priserendezvousdepartement`)
            LEFT JOIN `' . _DB_PREFIX_ . 'priserendezvousdepartement_lang` dl ON (dl.`id_priserendezvousdepartement` = d.`id_priserendezvousdepartement`)';
        $this->_where='and dl.id_lang='.$id_lang;
        $this->bulk_actions = array(
            'delete' => array(
                'text' => 'Delete selected',
                'confirm' => 'Would you like to delete the selected items?',
            )
        );

        // Enable bootstrap
        $this->bootstrap = true;
    // Call of the parent constructor method
        parent::__construct();
    }
    public function l1($string)
    {
        if (is_null($this->_module)) {
            $this->_module = new Devisservice();
        }

        return $this->_module->l($string, __class__);
    }
    public function renderView()
    {
        $tpl = $this->context->smarty->createTemplate(
            dirname(__FILE__).
            '/../../views/templates/admin/detail.tpl');
        $tpl->assign('customer', $this->object->getClient());
        $tpl->assign('adress', $this->object->getAdresse());
        $tpl->assign('detailDevisService', $this->object->getService());
        return $tpl->fetch();
    }
}