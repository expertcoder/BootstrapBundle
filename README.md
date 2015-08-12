# Bootstrap Bundle
###Symfony2 Bundle for Twitter Boostrap

At the moment, this bundle has one purpose. It will allow your allow LESS files in your
application, to have access to the variables in Twitter Bootstrap's variables.less

# Installation and configuration

Composer.json

``` json
{
    ...
    "require": {
        "realtyhub/bootstrap-bundle": "dev-master"
    }
}
```

AppKernel.php

``` php
<?php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FOS\UserBundle\FOSUserBundle(),
    );
}
```


config.yml

``` yml
    realtyhub_bootstrap:
        variables_less_path: "/path/to/variables.less"

```



# Basic Usage

Inside a Twig file

```
    {% stylesheets '@YourBundle/path/to/file.less' filter='bootstrap_variables your_prefered_less_filter' %}
        <link rel="stylesheet" href="{{ asset_url }}" />
    {% endstylesheets %}
```


### Warning

You will need to make sure that you are not accidently running the less filter before the bootstrap_variables filter.
This usually occurs is you have something like this in your config.yml

``` yml
assetic:
    filters:
        less:
            node: /usr/bin/node
            node_paths: [/usr/lib/node_modules]
            apply_to: "\.less$"
```
This filter will run before the "inlined" bootstrap_variables filter and therefore the less will not have access the the 
variables and will more than likely not complie.

This is why the alternative usage is suggested.

# Alternative Usage

config.yml

``` yml
assetic:
    filters:
        bootstrap_variables:
            resource: 'assetic.xml' #workaround for assetic to accept our filter.
                                            #see https://github.com/symfony/AsseticBundle/issues/50
            apply_to: "\.less$"
        less:
            #Adjust paths to your environment
            node: /usr/bin/node
            node_paths: [/usr/lib/node_modules]
            apply_to: "\.less$"
```

now inside of Twig file, you wont need to specify the filters and can try something like

```
    {% stylesheets '@YourBundle/path/to/file.less'  %}
        <link rel="stylesheet" href="{{ asset_url }}" />
    {% endstylesheets %}
```

# TODO

* Better intergration with braincrafted bootstrap bundle. Is it possible to automattically determine
the path to variables.less and remove the need for the configuration?