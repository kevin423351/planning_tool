<?php
namespace Concrete\Package\PlanningTool\Src\Installer;

class Common
{
    protected $pkg = null;

    public function setPackage($pkg) {
        $this->pkg = $pkg;
    }

    public function upgrade() {
        $this->install();
    }
}
