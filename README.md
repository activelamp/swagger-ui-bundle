Swagger UI Bundle
=================

Creates a [swagger-ui](https://github.com/wordnik/swagger-ui) page (something like [this](http://petstore.swagger.wordnik.com/)) in your Symfony2 application.

* [x] Basic functionalities
* [x] Configurable authentication methods
* [x] Unit tests

# Documentation

* [Installation & Usage](https://github.com/activelamp/swagger-ui-bundle/blob/master/Resources/doc/installation-and-usage.md)
* [Authentication](https://github.com/activelamp/swagger-ui-bundle/blob/master/Resources/doc/authentication.md)
* [Overriding templates](https://github.com/activelamp/swagger-ui-bundle/blob/master/Resources/doc/overriding-templates.md)

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
    auth_config:
        oauth:
            enable:               false
            client_id:            null
            realm:                null
            app_name:             null
        http:
            enable:               false
            key_name:             null
            delivery:             null
```
