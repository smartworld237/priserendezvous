<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18/02/2019
 * Time: 11:27
 */

class AdminPriserendezvousController extends ModuleAdminController
{
    public function __construct()
    {
        $this->addRowAction('view');
        $this->addRowAction('delete');

// Set variables
        $this->table = 'devisservice';
        $this->className = 'DemandeServiceModel';
        $this->identifier = 'id_devisservice';
        //$this->lang = true;
        $this->fields_list = array(
            'id_devisservice' => array('title' => "ID", 'align' =>
                'center', 'width' => 25),
            'typeservice' => array('title' => "Service", 'align' =>
                'center', 'width' => 25),
            'client' => array('title' => "Client", 'align' =>
                'center', 'width' => 25),
        );
        $this->_select = ' a.`id_devisservice`, s.`typeservice`, c.`firstname` as client';
        $this->_join='LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (a.`id_client` = c.`id_customer`) 
         LEFT JOIN `' . _DB_PREFIX_ . 'devisservicemodel` s ON (s.`id_devisservicemodel` = a.`id_devisservicemodel`) ';
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