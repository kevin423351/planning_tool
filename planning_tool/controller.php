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
        // $al = AssetList::getInstance();
        // $al->register('javascript', 'notifications', 'js/notifications.js', ['minify' => true, 'combine' => true], $this->pkgHandle);
    }

    public function install()
    {
        // Run install
        $pkg = parent::install();

        // Do some install stuff of package
        $this->createPages($pkg);
        $installer = new Installer();
        $installer->install();

    }

    public function upgrade()
    {
        // Run upgrade
        $pkg = parent::install();

        // Do some upgrade stuff of package
        $this->createPages($pkg);
        $installer = new Installer();
        $installer->refreshEntities();
        $installer->upgrade();
        $installer->clearCache();
    }

    public function uninstall() {

        // Run upgrade
        parent::uninstall();

        // Do some uninstall stuff of package
        $installer = new Installer();
        $installer->uninstall();
        $installer->clearCache();
    }
    
    public function createPages($pkg) {
		$p = new Pages();
        $p->setPackage($pkg);
        $p->setPage('/dashboard/persons/overview');
        $p->install();
	}
}

