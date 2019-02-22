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

if (!defined('_PS_VERSION_')) {
    exit;
}
require_once _PS_MODULE_DIR_ . 'priserendezvous/classes/ServiceDevisModel.php';

class Priserendezvous extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'priserendezvous';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'smartworld';
        $this->need_instance = 0;
        $this->controllers = array('frontpriserendezvous');
        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Prendre un Rendez-vous');
        $this->description = $this->l('Prendre un Rendez-vous');

        $this->confirmUninstall = $this->l('Voulez vous vraiment désinstallé ce module');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('PRISERENDEZVOUS_LIVE_MODE', false);

        include(dirname(__FILE__).'/sql/install.php');
// Install admin tab
        if (!$this->installTab('IMPROVE', 'AdminPriserendezvous', 'Priserendezvous'))
            return false;

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayHome');
    }

    public function uninstall()
    {
        Configuration::deleteByName('PRISERENDEZVOUS_LIVE_MODE');

        include(dirname(__FILE__).'/sql/uninstall.php');
// Uninstall admin tab
        if (!$this->uninstallTab('AdminPriserendezvous'))
            return false;

        return parent::uninstall();
    }
    public function installTab($parent, $class_name, $name)
    {
// Create new admin tab
        $tab = new Tab();
        $tab->id_parent = (int)Tab::getIdFromClassName($parent);
        $tab->name = array();
        foreach (Language::getLanguages(true) as $lang)
            $tab->name[$lang['id_lang']] = $name;
        $tab->class_name = $class_name;
        $tab->module = $this->name;
        $tab->active = 1;
        return $tab->add();
    }
    public function uninstallTab($class_name)
    {
// Retrieve Tab ID
        $id_tab = (int)Tab::getIdFromClassName($class_name);
// Load tab
        $tab = new Tab((int)$id_tab);
// Delete it
        return $tab->delete();
    }


    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitDevisserviceModule')) == true) {
            $this->postProcess();
        }
        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output.$this->renderList();
    }
    protected function renderList(){
        $this->fields_list          = array();
        $this->fields_list['id_priserendezvous'] = array(
            'title' => $this->l('id'),
            'type' => 'text',
            'search' => false,
            'orderby' => false
        );
        $this->fields_list['client'] = array(
            'title' => $this->l('Client'),
            'type' => 'text',
            'search' => false,
            'orderby' => false
        );
        $this->fields_list['jour'] = array(
            'title' => $this->l('Jour'),
            'type' => 'text',
            'search' => false,
            'orderby' => false
        );
        $this->fields_list['hdebut'] = array(
            'title' => $this->l('Heure de debut'),
            'type' => 'text',
            'search' => false,
            'orderby' => false
        );  $this->fields_list['mdebut'] = array(
            'title' => $this->l('Minuite de debut'),
            'type' => 'text',
            'search' => false,
            'orderby' => false
        );  $this->fields_list['hfin'] = array(
            'title' => $this->l('Heure de debut'),
            'type' => 'text',
            'search' => false,
            'orderby' => false
        );  $this->fields_list['mfin'] = array(
            'title' => $this->l('Heure de debut'),
            'type' => 'text',
            'search' => false,
            'orderby' => false
        );  $this->fields_list['nom_departement'] = array(
            'title' => $this->l('Nom du Departement'),
            'type' => 'text',
            'search' => false,
            'orderby' => false
        );
        $helper = new HelperList();
        $helper->shopLinkType   = '';
        $helper->simple_header      = false;
        $helper->identifier         = 'id_priserendezvous';
        $helper->actions            = array(
            'view',
            'delete'
        );
        $helper->show_toolbar       = true;
        $helper->imageType          = 'jpg';
        /*$helper->toolbar_btn['new'] = array(
            'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&addreponseDevis'. '&token='
                . Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->l('Add new')
        );*/

        $helper->title        = 'Liste des Rendez Vous';
        $helper->table        = $this->name;
        $helper->token        = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;

        $content = $this->getListContent($this->context->language->id);

        return $helper->generateList($content, $this->fields_list);
    }
    protected function renderDetailDevis(){
        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/detail.tpl');

        return $output;
    }
    protected function getListContent($id_lang = null)
    {
        if (is_null($id_lang))
            $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');

        $sql = 'SELECT r.`*`, cr.`*`, c.`firstname` as client
            FROM `' . _DB_PREFIX_ . 'priserendezvous`r 
            LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (r.`id_client` = c.`id_customer`) 
             LEFT JOIN `' . _DB_PREFIX_ . 'priserendezvousdepartement` d ON (d.`id_priserendezvousdepartement` = cr.`id_priserendezvouscreneaux`) 
         LEFT JOIN `' . _DB_PREFIX_ . 'priserendezvouscreneaux` cr ON (cr.`id_priserendezvouscreneaux` = r.`id_priserendezvous`)
           LEFT JOIN `' . _DB_PREFIX_ . 'priserendezvousdepartement_lang` dl ON (dl.`id_priserendezvouscreneaux` = d.`id_priserendezvousdepartement`)
           where cl.id_lang='.$id_lang;



        $content = Db::getInstance()->executeS($sql);

        return $content;
    }
    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitDevisserviceModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Live mode'),
                        'name' => 'DEVISSERVICE_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Enter a valid email address'),
                        'name' => 'DEVISSERVICE_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                    ),
                    array(
                        'type' => 'password',
                        'name' => 'DEVISSERVICE_ACCOUNT_PASSWORD',
                        'label' => $this->l('Password'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return array(
            'DEVISSERVICE_LIVE_MODE' => Configuration::get('DEVISSERVICE_LIVE_MODE', true),
            'DEVISSERVICE_ACCOUNT_EMAIL' => Configuration::get('DEVISSERVICE_ACCOUNT_EMAIL', 'contact@prestashop.com'),
            'DEVISSERVICE_ACCOUNT_PASSWORD' => Configuration::get('DEVISSERVICE_ACCOUNT_PASSWORD', null),
        );
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookDisplayHome()
    {
        /* Place your code here. */
    }
}
