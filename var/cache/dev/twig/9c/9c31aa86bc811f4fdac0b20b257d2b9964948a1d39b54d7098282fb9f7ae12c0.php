<?php

/* default/index.html.twig */
class __TwigTemplate_6d9f5cae455e0bc72ca211bf7625f2e6866bc73265e6e66e563c2c9bec2df039 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "default/index.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "default/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "default/index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $this->displayParentBlock("title", $context, $blocks);
        echo " - démonstrateur";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "<div class=\"container\">

    <div class=\"row limit\">
        <div class=\"col-4\">
            <h1>Démonstrateur</h1>

            ";
        // line 12
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "

        </div>
        <div class=\"col-8\">
          <h1>Résultats</h1>
          ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["searchResult"]) ? $context["searchResult"] : $this->getContext($context, "searchResult")), "items", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 18
            echo "            <div id=\"document-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "id", array()), "html", null, true);
            echo "\" class=\"list-group\" style=\"margin-top : 30px\">

                <div class=\"d-flex w-100 justify-content-between title\" > 
                  <h5 class=\"mb-1\">";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()), "html", null, true);
            echo "</h5>
                </div>
                <p class=\"mb-1\">Type de document: ";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "type", array()), "html", null, true);
            echo "</p>
                <p class=\"mb-1\">Organisme producteur : ";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "organisme", array()), "html", null, true);
            echo " </p>
                <small id=\"item_name\">";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
            echo "</small>
                <small style=\"text-align : right\">Score : ";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "_score", array()), "html", null, true);
            echo "</small>
                <br /><br />
            </div>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "        </div>  
    </div>
    <div style=\"margin-top:50px;\">
      <div id=\"my_map\" class=\"my_map\">
      </div>
    </div>
</div>


";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 41
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 42
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

<script type=\"text/javascript\">
var wkt = '";
        // line 45
        if ($this->getAttribute($this->getAttribute((isset($context["searchResult"]) ? $context["searchResult"] : null), "items", array(), "any", false, true), 0, array(), "array", true, true)) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["searchResult"]) ? $context["searchResult"] : $this->getContext($context, "searchResult")), "items", array()), 0, array(), "array"), "geometry", array()), "html", null, true);
            echo " ";
        } else {
            echo " ";
            echo null;
        }
        echo "';

var items = ";
        // line 47
        if ($this->getAttribute($this->getAttribute((isset($context["searchResult"]) ? $context["searchResult"] : null), "items", array(), "any", false, true), 0, array(), "array", true, true)) {
            echo twig_jsonencode_filter($this->getAttribute((isset($context["searchResult"]) ? $context["searchResult"] : $this->getContext($context, "searchResult")), "items", array()));
            echo " ";
        } else {
            echo " [] ";
        }
        echo ";

var item_name = '';

\$(document).ready(function(){
    \$('form').attr('autocomplete', 'off');
    \$(\"[name='document_search[sup_cat]']\").parent().css('display', 'none');
});

\$(\"[name='document_search[type]']\").click(function(){
    if (\$(\"[name='document_search[type]']\").val() == 'SUP')
      \$(\"[name='document_search[sup_cat]']\").parent().css('display', 'block');
    else
      \$(\"[name='document_search[sup_cat]']\").parent().css('display', 'none');
});

/* https://github.com/bassjobsen/Bootstrap-3-Typeahead#using-json-objects-instead-of-simple-strings */
var input = \$('#document_search_organisme');
var output;

\$('#document_search_title').typeahead({
  source: function(term, cb){
    var url = ";
        // line 69
        echo twig_jsonencode_filter($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("api_autocomplete_document_title"));
        echo ";
    url += '?term='+term;
    \$.getJSON(url,function(titles){
      var result = [];
      titles.forEach(function(title){
        result.push({id: title, name: title});
      });
      cb(result);
    });
  },
  autoSelect: true
});

\$('#document_search_organisme').typeahead({
  source: function(term, cb){
    var url = ";
        // line 84
        echo twig_jsonencode_filter($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("api_autocomplete_document_organisme"));
        echo ";
    url += '?term='+term;
    \$.getJSON(url,function(organismes){
      var result = [];
      organismes.forEach(function(organisme){
        result.push({id: organisme, name: organisme});
      });
      cb(result);
    });
  },
  autoSelect: true
});


</script>
<script type=\"text/javascript\">
var viewer = gpuSearch.loadViewer(\"my_map\",items);

\$( '.list-group' ).click(function(){
    item_name = \$( this ).find('#item_name').text();
    gpuSearch.zoomOnFeature(item_name, viewer);
});
</script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "default/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 84,  199 => 69,  169 => 47,  158 => 45,  152 => 42,  143 => 41,  124 => 30,  114 => 26,  110 => 25,  106 => 24,  102 => 23,  97 => 21,  90 => 18,  86 => 17,  78 => 12,  70 => 6,  61 => 5,  42 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'base.html.twig' %}

{% block title %}{{ parent() }} - démonstrateur{% endblock %}

{% block body %}
<div class=\"container\">

    <div class=\"row limit\">
        <div class=\"col-4\">
            <h1>Démonstrateur</h1>

            {{ form(form) }}

        </div>
        <div class=\"col-8\">
          <h1>Résultats</h1>
          {% for item in searchResult.items %}
            <div id=\"document-{{ item.id }}\" class=\"list-group\" style=\"margin-top : 30px\">

                <div class=\"d-flex w-100 justify-content-between title\" > 
                  <h5 class=\"mb-1\">{{ item.title }}</h5>
                </div>
                <p class=\"mb-1\">Type de document: {{ item.type }}</p>
                <p class=\"mb-1\">Organisme producteur : {{ item.organisme }} </p>
                <small id=\"item_name\">{{ item.name }}</small>
                <small style=\"text-align : right\">Score : {{ item._score }}</small>
                <br /><br />
            </div>
          {% endfor %}
        </div>  
    </div>
    <div style=\"margin-top:50px;\">
      <div id=\"my_map\" class=\"my_map\">
      </div>
    </div>
</div>


{% endblock %}

{% block javascripts %}
{{ parent() }}

<script type=\"text/javascript\">
var wkt = '{% if searchResult.items[0] is defined %}{{ searchResult.items[0].geometry }} {%else%} {{null}}{% endif %}';

var items = {% if searchResult.items[0] is defined %}{{ (searchResult.items | json_encode | raw) }} {%else%} [] {% endif %};

var item_name = '';

\$(document).ready(function(){
    \$('form').attr('autocomplete', 'off');
    \$(\"[name='document_search[sup_cat]']\").parent().css('display', 'none');
});

\$(\"[name='document_search[type]']\").click(function(){
    if (\$(\"[name='document_search[type]']\").val() == 'SUP')
      \$(\"[name='document_search[sup_cat]']\").parent().css('display', 'block');
    else
      \$(\"[name='document_search[sup_cat]']\").parent().css('display', 'none');
});

/* https://github.com/bassjobsen/Bootstrap-3-Typeahead#using-json-objects-instead-of-simple-strings */
var input = \$('#document_search_organisme');
var output;

\$('#document_search_title').typeahead({
  source: function(term, cb){
    var url = {{ path('api_autocomplete_document_title') | json_encode() | raw }};
    url += '?term='+term;
    \$.getJSON(url,function(titles){
      var result = [];
      titles.forEach(function(title){
        result.push({id: title, name: title});
      });
      cb(result);
    });
  },
  autoSelect: true
});

\$('#document_search_organisme').typeahead({
  source: function(term, cb){
    var url = {{ path('api_autocomplete_document_organisme') | json_encode() | raw }};
    url += '?term='+term;
    \$.getJSON(url,function(organismes){
      var result = [];
      organismes.forEach(function(organisme){
        result.push({id: organisme, name: organisme});
      });
      cb(result);
    });
  },
  autoSelect: true
});


</script>
<script type=\"text/javascript\">
var viewer = gpuSearch.loadViewer(\"my_map\",items);

\$( '.list-group' ).click(function(){
    item_name = \$( this ).find('#item_name').text();
    gpuSearch.zoomOnFeature(item_name, viewer);
});
</script>
{% endblock %}


", "default/index.html.twig", "/home/HCaillaud/workspace_gpu/gpu-search/app/Resources/views/default/index.html.twig");
    }
}
