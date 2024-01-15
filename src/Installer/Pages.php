<?php
namespace Concrete\Package\PlanningTool\Src\Installer;

use \Concrete\Core\Page\Page;
use \Concrete\Core\Page\Single as SinglePage;
use \Concrete\Core\Support\Facade\Application;

class Pages extends Common
{
    // Define pages by there path
    protected $pages = [
        //['path' => '/my_single_page'],
    ];

    public function setPage($path) {
        $this->pages[] = ['path' => $path];
    }

    public function install()
    {
        if (count($this->pages)) {
            foreach ($this->pages as $page) {

                $path = $page['path'];
                if (strpos($path, '/') != 0) {
                    $path = '/'.$path;
                }

                // Check if controller exists
                if (!file_exists($this->pkg->getPackagePath().'/single_pages'.$path.'.php')) {
                    continue;
                }

                // Then install
                $p = Page::getByPath($path);
                if (!$p || (int)$p->getCollectionID() == 0 ) {
                    $p = SinglePage::add($path, $this->pkg);
                }
                else {
                    // Check if page is of this package.
                    $this->checkPagePackage($path);
                }
            }
        }
    }

    private function checkPagePackage($path)
	{
        $app = Application::getFacadeApplication();
		$db = $app->make('database')->connection();

        $page = Page::getByPath($path);
        if ($page) {
            // can't update pkgID with normal method
            //$page->update(['pkgID' => $this->pkg->getPackageID()]);
            // so, do this:
            $db->executeQuery("UPDATE Pages SET pkgID = ? WHERE cID = ?", [$this->pkg->getPackageID(), $page->getCollectionID()]);
        }
	}
}
