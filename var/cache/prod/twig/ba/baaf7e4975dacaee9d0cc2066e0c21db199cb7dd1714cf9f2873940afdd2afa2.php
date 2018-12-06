<?php

/* default/index.html.twig */
class __TwigTemplate_6eb441ea4a661944f21ddbe0f3e0ee95c200241ff34eaf4645c2a2151bca06a8 extends Twig_Template
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $this->displayParentBlock("title", $context, $blocks);
        echo " - démonstrateur";
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        // line 6
        echo "<div class=\"container\">

    <div class=\"row limit\">
        <div class=\"col-4\">
            <h1>Démonstrateur</h1>

            ";
        // line 12
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) ? $context["form"] : null), 'form');
        echo "

        </div>
        <div class=\"col-8\">
          <h1>Résultats</h1>
          ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["searchResult"]) ? $context["searchResult"] : null), "items", array()));
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
    }

    // line 41
    public function block_javascripts($context, array $blocks = array())
    {
        // line 42
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

<script type=\"text/javascript\">
var wkt = '";
        // line 45
        if ($this->getAttribute($this->getAttribute((isset($context["searchResult"]) ? $context["searchResult"] : null), "items", array(), "any", false, true), 0, array(), "array", true, true)) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["searchResult"]) ? $context["searchResult"] : null), "items", array()), 0, array(), "array"), "geometry", array()), "html", null, true);
            echo " ";
        } else {
            echo " ";
            echo null;
        }
        echo "';

var items = ";
        // line 47
        if ($this->getAttribute($this->getAttribute((isset($context["searchResult"]) ? $context["searchResult"] : null), "items", array(), "any", false, true), 0, array(), "array", true, true)) {
            echo twig_jsonencode_filter($this->getAttribute((isset($context["searchResult"]) ? $context["searchResult"] : null), "items", array()));
            echo " ";
        } else {
            echo " ";
            echo null;
            echo " ";
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
        return array (  177 => 84,  159 => 69,  127 => 47,  116 => 45,  110 => 42,  107 => 41,  94 => 30,  84 => 26,  80 => 25,  76 => 24,  72 => 23,  67 => 21,  60 => 18,  56 => 17,  48 => 12,  40 => 6,  37 => 5,  30 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "default/index.html.twig", "/home/HCaillaud/workspace_gpu/gpu-search/app/Resources/views/default/index.html.twig");
    }
}
