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

/* home/useful_link.html.twig */
class __TwigTemplate_26501d01f63b1a51868c179f6f7c29f8c753acfede1f8eecee9e10813f84d18c extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/useful_link.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/useful_link.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "home/useful_link.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<div class=\"restricted_container\">
  <br>
  <h5>Arrêté municipal portant sur la réglementation de la pêche sur les plages de La Turballe
    <a class=\"link\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("brochures/arrete_municipal.pdf"), "html", null, true);
        echo "\" target=\"_blank\" >Arrêté municipal (PDF)</a>
  </h5><hr>
  <h5>Prévision météo, force du vent et des vagues sur La Turballe.
    <a class=\"link\" href=\"https://www.windguru.cz/48503\" target=\"_blank\">Windguru</a>
  </h5><hr>
  <h5>Informations sur les marées pour le port de Saint Nazaire
    <a class=\"link\" href=\"http://www.maree.info/117\" target=\"_blank\">Marée Saint Nazaire</a>
  </h5><hr>
  <h5>Site de la Fédération Française des Pêches Sportives des Pays de la Loire
    <a class=\"link\" href=\"https://ffpspaysdeloire.webmo.fr/\" target=\"_blank\">FFPS des pays de la Loire</a>
  </h5>
</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "home/useful_link.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 7,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
<div class=\"restricted_container\">
  <br>
  <h5>Arrêté municipal portant sur la réglementation de la pêche sur les plages de La Turballe
    <a class=\"link\" href=\"{{ asset('brochures/arrete_municipal.pdf') }}\" target=\"_blank\" >Arrêté municipal (PDF)</a>
  </h5><hr>
  <h5>Prévision météo, force du vent et des vagues sur La Turballe.
    <a class=\"link\" href=\"https://www.windguru.cz/48503\" target=\"_blank\">Windguru</a>
  </h5><hr>
  <h5>Informations sur les marées pour le port de Saint Nazaire
    <a class=\"link\" href=\"http://www.maree.info/117\" target=\"_blank\">Marée Saint Nazaire</a>
  </h5><hr>
  <h5>Site de la Fédération Française des Pêches Sportives des Pays de la Loire
    <a class=\"link\" href=\"https://ffpspaysdeloire.webmo.fr/\" target=\"_blank\">FFPS des pays de la Loire</a>
  </h5>
</div>
{% endblock %}
", "home/useful_link.html.twig", "/home/christophe/Documents/docDev/symfony/sct/templates/home/useful_link.html.twig");
    }
}
