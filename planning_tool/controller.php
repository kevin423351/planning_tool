<?php
namespace Concrete\Package\PlanningTool;

use Concrete\Core\Asset\AssetList;
use \Concrete\Package\PlanningTool\Src\Installer;
use \Concrete\Core\Package\Package;

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
        parent::install();

        // Do some install stuff of package
        $installer = new Installer();
        $installer->install();

    }

    public function upgrade()
    {
        // Run upgrade
        parent::upgrade();

        // Do some upgrade stuff of package
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
}

