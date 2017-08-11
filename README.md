LRS Bundle
==========

This Symfony bundle helps you generate the server side of a Learning Record Store, as defined by the xAPI (or Tin Can API).

To setup, you will need to:
- add the repository and require to the composer.json of your project
```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/php-xapi/lrs-bundle"
        },
        {
            "type": "vcs",
            "url": "https://github.com/php-xapi/repository-doctrine-orm"
        }
    ],
    "require": {
        ...,
        "php-xapi/lrs-bundle": "0.1.x-dev",
        "php-xapi/repository-doctrine-orm": "dev-master"

    }
```
(replace php-xapi by your own user if you have forked the project)
- launch `composer update` to download the corresponding libraries
- add the bundle to app/AppKernel.php in your application
```
        $bundles = [
            ...
            new XApi\LrsBundle\XApiLrsBundle(),
        ];
```
- update the config.yml (or config_dev.yml), the "orm" section enabling the
mapping of entities in repository-doctrine-orm with the required entites in this
bundle (MyMappings and LrsBundle terms should be customized), and the xapi_lrs 
section enabling the link to Doctrine:
```
orm:
    auto_generate_proxy_classes: '%kernel.debug%'
    entity_managers:
        MyMappings:
            mappings:
                // your mappings here
                LrsBundle:
                    mapping: true
                    type: xml
                    dir: '%kernel.root_dir%/../vendor/php-xapi/repository-doctrine-orm/metadata'
                    is_bundle: false
                    prefix: XApi\Repository\Doctrine\Mapping
xapi_lrs:
    type: orm
    object_manager_service: doctrine.orm.entity_manager
```
To enable a visual administrator for the entities, you can (optionally) enable
the easy_admin bundle (which you _will_ have to install additionally), adding
this extra section to config.yml:
```
easy_admin:
    entities:
      - XApi\LrsBundle\Entity\Statement
```
- update the routing.yml
```
xapi_lrs:
    resource: "@XApiLrsBundle/Resources/config/routing.xml"
    prefix: /lrs
```

There are still issues with the current version of this bundle requesting classes from dependencies which have removed them (documented in php-xapi/lrs-bundle/CHANGELOG.md).

