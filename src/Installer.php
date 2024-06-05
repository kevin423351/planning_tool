<?php
namespace Concrete\Package\PlanningTool\Src;

use Concrete\Core\Localization\Localization;
use Concrete\Core\Database\DatabaseStructureManager;
use Concrete\Core\Support\Facade\DatabaseORM as dbORM;
use Concrete\Core\Package\PackageService;

use Concrete\Package\PlanningTool\Src\Installer\Blocks;

class Installer {
    
    public function install($pkg = null) {

        if (!$pkg) {
            $pkg = app()->make(PackageService::class)->getByHandle('planning_tool');
        }

        // Install block
        $b = new Blocks();
        $b->setPackage($pkg);
        $b->setBlock('planning_tool');
        $b->install();
    }

    public function upgrade($pkg = null)
    {
        if (!$pkg) {
            $pkg = app()->make(PackageService::class)->getByHandle('planning_tool');
        }
        $this->install($pkg);
    }

    public function uninstall($pkg = null)
    {
        $db = app()->make('database')->connection();
        
        $db->query("SET FOREIGN_KEY_CHECKS = 0");
        
        $db->query("DROP TABLE IF EXISTS persons");
        $db->query("DROP TABLE IF EXISTS expertises");
        $db->query("DROP TABLE IF EXISTS appointments");
        $db->query("DROP TABLE IF EXISTS timeslots");
        $db->query("DROP TABLE IF EXISTS unavailable");
        
        $db->query("SET FOREIGN_KEY_CHECKS = 1");
        $db->query("SET FOREIGN_KEY_CHECKS = 0");
    }

    public function clearCache() {
        Localization::clearCache();
    }

    public function refreshEntities()
    {
        $em = dbORM::entityManager();
        $manager = new DatabaseStructureManager($em);
        $manager->refreshEntities();
    }
}
