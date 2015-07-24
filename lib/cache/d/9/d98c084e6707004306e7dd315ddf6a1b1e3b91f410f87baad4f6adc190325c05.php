<?php

/* header.php */
class __TwigTemplate_d98c084e6707004306e7dd315ddf6a1b1e3b91f410f87baad4f6adc190325c05 extends Twig_Template
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
        return "header.php";
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
