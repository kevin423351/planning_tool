<?php
namespace Concrete\Package\PlanningTool\Src\Installer;

use \Concrete\Core\Block\BlockType\BlockType;
use Concrete\Package\PlanningTool\Src\Installer\Common;

class Blocks extends Common
{
    // Define blocks by there handle
    protected $blocks = [
        //['handle' => 'my_block'],
    ];

    public function setBlock($handle) {
        $this->blocks[] = ['handle' => $handle];
    }

    public function install()
    {
        if (count($this->blocks)) {
            foreach ($this->blocks as $block) {

                $handle = $block['handle'];

                // Check if controller exists
                if (!file_exists($this->pkg->getPackagePath().'/blocks/'.$handle.'/controller.php')) {
                    continue;
                }
                // Then install
                $bt = BlockType::getByHandle($handle);
                if (!is_object($bt)) {
                    BlockType::installBlockType($handle, $this->pkg);
                }
            }
        }
    }
}
