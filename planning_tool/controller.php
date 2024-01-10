<?php
namespace Concrete\Package\PlanningTool;

defined('C5_EXECUTE') or die('Access Denied.');

use \Concrete\Core\Package\Package;
use \Concrete\Core\Block\BlockType\BlockType;

class Controller extends Package
{
    protected $pkgHandle = 'planning_tool';
    protected $appVersionRequired = '9.0.0';
    protected $pkgVersion = '1.0';

    public function getPackageDescription()
    {
        return t('Add a planning tool to your site');
    }

    public function getPackageName()
    {
        return t('planning_tool');
    }

    public function install()
    {
        $pkg = parent::install();
        Theme::add('custom_theme', $pkg);
        BlockType::installBlockTypeFromPackage('custom_block_type', $pkg);
    }
    public function upgrade() {
        parent::upgrade();
        $pkg = Package::getByHandle('custom_theme');
        $bt = BlockType::getByHandle('custom_block_type');
        if (!is_object($bt)) {
            $bt = BlockType::installBlockTypeFromPackage('custom_block_type', $pkg);
        }
    }
    public function uninstall()
    {
        parent::uninstall();
        $db = \Database::connection();
        $db->query('drop table FooBar');
        $db->query('drop table FooBaz');
    }
}