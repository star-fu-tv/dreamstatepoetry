<?php

/* footer.php */
class __TwigTemplate_7c3c5823403de52efe80accfc37cf63454f5c5df6bf9f45617038849888340be extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<h1>WOOOO TEMPLATEY JOY</h1>
<p>Twig render ";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo " is at ";
        echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true);
        echo "</p>";
    }

    public function getTemplateName()
    {
        return "footer.php";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 2,  19 => 1,);
    }
}
