<?php

namespace Realtyhub\BootstrapBundle\Filters;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;

class BootstrapVariablesFilter implements FilterInterface
{


    public function filterLoad(AssetInterface $asset)
    {
        $content = $asset->getContent();

        //TODO - unhardcode this path
        $extra = '@import "/var/realtyhub-dynamic/vendor/twbs/bootstrap/less/variables.less";';
        $asset->setContent($extra . PHP_EOL . PHP_EOL . $content);

    }


    public function filterDump(AssetInterface $asset)
    {
    }


}