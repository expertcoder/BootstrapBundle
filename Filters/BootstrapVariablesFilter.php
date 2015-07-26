<?php

namespace Realtyhub\BootstrapBundle\Filters;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;

use Symfony\Component\DependencyInjection\Container;

class BootstrapVariablesFilter implements FilterInterface
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;

    }

    public function filterLoad(AssetInterface $asset)
    {
        $content = $asset->getContent();

        $variablesLessPath = $this->container->getParameter('realtyhub_bootstrap.variables_less_path');

        //Append this import statment at the start, which should
        //include variables.less
        $extra = '@import "'.$variablesLessPath.'";';
        $asset->setContent($extra . PHP_EOL . PHP_EOL . $content);

    }


    public function filterDump(AssetInterface $asset)
    {
    }


}