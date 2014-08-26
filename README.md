Swagger UI Bundle
=================

Creates a [swagger-ui](https://github.com/wordnik/swagger-ui) page (something like [this](http://petstore.swagger.wordnik.com/)) in your Symfony2 application.

* [x] Basic functionalities
* [ ] Configurable authentication methods
* [x] Unit tests

# Documentation

* [Installation & Basic Usage](https://github.com/bezhermoso/swagger-ui-bundle/blob/master/Resources/doc/index.md)

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
    authentication:
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
