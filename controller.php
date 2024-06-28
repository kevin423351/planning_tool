<?php

namespace Concrete\Package\PlanningTool;
defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Asset\AssetList;
use \Concrete\Package\PlanningTool\Src\Installer;
use \Concrete\Core\Package\Package;
use \Concrete\Package\PlanningTool\Src\Installer\Pages;
use \Concrete\Core\Page\Page;

class Controller extends Package {

    protected $pkgHandle = 'planning_tool';
    protected $appVersionRequired = '9.0.0';
    protected $pkgVersion = '1.1';

    protected $pkgAutoloaderRegistries = [
        'src/' => '\Concrete\Package\PlanningTool\Src',
    ];

    public function getPackageName() {
        return t('planning-tool');
    }

    public function getPackageDescription() {
        return t('Add a planning tool to your website!');
    }

    public function on_start()
    {
    }

    public function install()
    {
        $pkg = parent::install();
    
        $this->createPages($pkg);
        $installer = new Installer();
        $installer->install();
    }
    
    public function upgrade()
    {
        $pkg = parent::install();
        
        $this->createPages($pkg);
        $installer = new Installer();
        $installer->refreshEntities();
        $installer->upgrade();
        $installer->clearCache();
    }

    public function uninstall() {

        parent::uninstall();

        $installer = new Installer();
        $installer->uninstall();
        $installer->clearCache();
    }
    
    public function createPages($pkg) {
		$p = new Pages();
        $p->setPackage($pkg);
        $p->setPage('/dashboard/planning_tool/persons');
        $p->setPage('/dashboard/planning_tool/expertises');
        $p->setPage('/dashboard/planning_tool/appointments');
        $p->setPage('/dashboard/planning_tool/setappointments');
        $p->setPage('/dashboard/planning_tool/unavailableperson');
        $p->install();
	}
}

