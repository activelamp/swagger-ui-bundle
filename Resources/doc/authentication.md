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

Coupled with the correct OAuth authentication definition in your API declarations, 
