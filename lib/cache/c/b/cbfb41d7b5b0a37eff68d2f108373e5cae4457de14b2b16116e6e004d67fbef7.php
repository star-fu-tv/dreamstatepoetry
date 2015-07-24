<?php

/* slim.html */
class __TwigTemplate_cbfb41d7b5b0a37eff68d2f108373e5cae4457de14b2b16116e6e004d67fbef7 extends Twig_Template
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
        return "slim.html";
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
