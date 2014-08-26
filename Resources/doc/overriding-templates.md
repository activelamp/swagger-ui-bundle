Swagger UI Bundle
=================

You can override the template used through the usual way, which is creating an `app/Resources/ALSwaggerUIBundle/views/layout.html.twig` file.

Here are the various Twig blocks that you need to know about:

`al_swagger_ui_stylesheets` - This block will contain CSS includes related to theming the `div#swagger-ui-container` portion of the documentation.
`al_swagger_ui_javascripts` - This block will contain JS includes and inline scripts that effectively put the `swagger-ui` page into motion.
`al_swagger_ui_content` - This block will contain the necessary HTML fragments (authentication form, `div#swagger-ui-container`, etc) that will hold `swagger-ui`-related elements.

All these should be present in the overriding Twig template in order for the documentation page to continue to work.

Example template:

```html
{% extends "::layout.html.twig" %}

{% block stylesheets %}
{{ parent() }}
{% block al_swagger_ui_stylesheets %}{% endblock %}
<style>
/** More overrides **/
</style>
{% endblock %}

{% block javascripts %}
{{ parent() }}
{% block al_swagger_ui_javascripts %}{% endblock %}
{% endblock %}

{% block body %}
<div class="container">
{% block al_swagger_ui_content %}{% endblock %}
</div>
{% endblock %}
```
