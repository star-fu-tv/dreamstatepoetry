<?php

/* edit-song.php */
class __TwigTemplate_1a2eaa27125dc9c5a32d6a8614d156b288debbad23ad74e3a0cf4c006ac3756b extends Twig_Template
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
        echo "  <nav class=\"navbar navbar-default\">
    <div class=\"container-fluid\">
      <div class=\"navbar-header\">
        <a class=\"navbar-brand\" href=\"#\">
          dream state generator
        </a>
      </div>
      <div id=\"navbar\" class=\"navbar-collapse collapse\">
        <ul class=\"nav navbar-nav\">
<!--           <li class=\"active\"><a href=\"#\">Home</a></li>
          <li><a href=\"#\">About</a></li> -->
          <li class=\"edit-song\"><a class=\"button button-primary\" href=\"#\">Edit Song</a></li>
<!-- 
          <li class=\"dropdown\">
            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Song List <span class=\"caret\"></span></a>
            <ul class=\"dropdown-menu\" id=\"songs-list\">

            </ul>
          </li> -->
        </ul>
      </div>      
    </div>
  </nav>  

<h1>WOOOO TEMPLATEY JOY</h1>
<p>Twig render ";
        // line 26
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo " is at ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["songs"]) ? $context["songs"] : null), "id", array()), "html", null, true);
        echo "  ";
        echo twig_escape_filter($this->env, (7 + 7), "html", null, true);
        echo " </p>";
    }

    public function getTemplateName()
    {
        return "edit-song.php";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 26,  19 => 1,);
    }
}
