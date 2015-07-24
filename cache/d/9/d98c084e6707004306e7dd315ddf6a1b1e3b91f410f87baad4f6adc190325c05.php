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
        echo "<!doctype html>
<html>
  <head>

    <!-- get popular libs from cdn / fallback -
    <script src=\"//ajax.aspnetcdn.com/ajax/jquery/jquery-2.0.0.min.js\"></script>
    <script>window.jQuery || document.write('<script src=\"core/js/jquery-2.1.1.js\">\\x3C/script>')</script>
    -->

    <script src=\"../lib/js/jquery-2.1.1.js\"></script>    
    <!-- etc etc... -->

    <script src=\"../lib/js/bootstrap.min.js\"></script>
    <link href=\"../lib/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"../lib/css/animate.css\" rel=\"stylesheet\">
    <link href=\"../lib/css/styles.css\" rel=\"stylesheet\">

    <link href=\"http://fonts.googleapis.com/css?family=Fjalla+One|Cantarell:400,400italic,700italic,700\" rel=\"stylesheet\" type=\"text/css\" />

    <!-- <script src=\"//ajax.googleapis.com/ajax/libs/threejs/r67/three.min.js\"></script> -->
    <script src=\"../slim-app.js\"></script> 
    <!-- <link href=\"core/css/vision.css\" rel=\"stylesheet\">   --> 
  </head>

  <body>

";
    }

    public function getTemplateName()
    {
        return "header.php";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
