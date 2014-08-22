Swagger UI Bundle
=================

Creates a [swagger-ui](https://github.com/wordnik/swagger-ui) page (something like [this](http://petstore.swagger.wordnik.com/)) in your Symfony2 application.

* [x] Basic functionalities
* [ ] Configurable authentication methods
* [x] Unit tests

## Installation & Usage

Install via Composer:

`$ composer require activelamp/swagger-ui-bundle:0.2.*`

Enable in `app/AppKernel.php`:

```php
<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            ...
            new ActiveLAMP\Bundle\SwaggerUIBundle\ALSwaggerUIBundle(),

```
Let it know where to find your API's resource-list JSON:

```
# app/config/config.yml

al_swagger_ui:
    resource_list: http://petstore.swagger.wordnik.com/api/api-docs
```

And finally, add the route to `app/config/routing.yml`:

```
al_swagger_ui:
    resource: @ALSwaggerUIBundle/Resources/config/routing.yml
    prefix: /docs
```
Done!

The swagger-ui page for your REST API should now be served at 
`http://yourapp.com/docs`.

### `al_swagger_ui -> resource_list` configuration

The `resource_list` option can receive 2 types of values:

1. An absolute URL to an external Swagger resource-list (demoed above).
2. A route name.

### Serving static JSON files

If you already have a set of Swagger-compliant JSON files, you can configure this bundle to serve them for you in such a way that `swagger-ui` can consume it properly:

1. Place all JSON files inside a directory (doesn't have to be public)
2. Register the routes:

```yaml
 # app/config/routing.yml
al_swagger_ui_static_resources:
    resource: @ALSwaggerUI/Resources/config/static_resources_routing.yml
    prefix: /swagger-docs
```
3. Configure the `static_resources` config:

```yaml
al_swagger_ui:
    static_resources:
        resource_dir: app/Resources/swagger-docs
        resource_list_filename:  api-docs.json
    resource_list: al_swagger_ui_static_resource_list
```

This will result in a `/swagger-docs` route to return the resource-list, and `/swagger-docs/<resource_name>` to serve API declarations.

Setting `resource_list` to `al_swagger_ui_static_resource_list` will then point `swagger-ui` to the right direction.

### Integration with NelmioApiDocBundle

If you are using [NelmioApiDocBundle](https://github.com/nelmio/NelmioApiDocBundle) to document your REST API, it is as easy as pointing `resource_list` to the route `NelmioApiDocBundle` provides that produces Swagger-compliant documentation:

```yaml
al_swagger_ui:
    resource_list: nelmio_api_doc_swagger_resource_list
```

-------

__Since `0.2.*`, setting `resource_list` to the `nelmio_api_doc...` route is no longer necessary as this will be automatically set for you as long as `NelmioApiDocBundle` is registered.__ Of course, you can still override it if somehow you need to consume a resource list from another source.

------

Head to the [Swagger support documentation](https://github.com/nelmio/NelmioApiDocBundle/tree/master/Resources/doc/swagger-support.md) for more information how to enable Swagger support in `NelmioApiDocBundle`.

## Configuration reference

```yaml
al_swagger_ui:
    resource_list:        ~ # Required
    static_resources:
        resource_dir:         null
        resource_list_filename:  api-docs.json
    js_config:
        expansion:            list
        supported_submit_methods: [get, post, put, delete]
        sorter:               null
        highlight_size_threshold:  null
        boolean_values: ['true', 'false']
```
