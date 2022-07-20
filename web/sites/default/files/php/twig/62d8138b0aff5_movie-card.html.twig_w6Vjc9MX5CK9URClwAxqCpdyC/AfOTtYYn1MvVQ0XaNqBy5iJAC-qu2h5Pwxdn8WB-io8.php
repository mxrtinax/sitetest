<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/blog_post_theme/templates/movie-card.html.twig */
class __TwigTemplate_ba19c94560870087902932eccd1e3530c395745fe5e241062c157662757ca3cf extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        echo "<div class=\"movie-card\">
<h1>Movie card</h1>

<p>Title: ";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 5, $this->source), "html", null, true);
        echo "</p>
<p>Description: ";
        // line 6
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null), 6, $this->source), "html", null, true);
        echo "</p>
  ";
        // line 7
        if (($context["image"] ?? null)) {
            // line 8
            echo "<img class=\"card-img\" src=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["image"] ?? null), 8, $this->source), "html", null, true);
            echo "\">
  ";
        }
        // line 10
        echo "<p>Date: ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["date"] ?? null), 10, $this->source), "html", null, true);
        echo "</p>
</div>

";
    }

    public function getTemplateName()
    {
        return "themes/custom/blog_post_theme/templates/movie-card.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 10,  54 => 8,  52 => 7,  48 => 6,  44 => 5,  39 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# [module]/templates/my-template.html.twig #}
<div class=\"movie-card\">
<h1>Movie card</h1>

<p>Title: {{ title }}</p>
<p>Description: {{ description }}</p>
  {% if image %}
<img class=\"card-img\" src=\"{{ image }}\">
  {% endif %}
<p>Date: {{ date }}</p>
</div>

", "themes/custom/blog_post_theme/templates/movie-card.html.twig", "/home/paul/Work/sitetest/web/themes/custom/blog_post_theme/templates/movie-card.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 7);
        static $filters = array("escape" => 5);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
