Swagger UI Bundle
=================

## Authentication options

`swagger-ui` supports `http` and `oauth` authentication, and both of these can be easily configured in this bundle:


### OAuth
```
  al_swagger_ui:
      oauth:
          enable: true
          app_name: "Your app name"
          client_id: "unique_client_id"
          realm: "your-realms"
```

Coupled with the correct OAuth authentication definition in the Swagger API declarations, an OAuth authentication flow will be presented in the documentation.

### HTTP
```
  al_swagger_ui:
      http:
          enable: true
          key_name: __key
          delivery: query
```

This will add an API key field in the documentation page. `delivery` can be set to either `query` or `header`, whichever is applicable to your API authentication protocol.

__Note that both of these authentication methods can be enabled at the same time.__
