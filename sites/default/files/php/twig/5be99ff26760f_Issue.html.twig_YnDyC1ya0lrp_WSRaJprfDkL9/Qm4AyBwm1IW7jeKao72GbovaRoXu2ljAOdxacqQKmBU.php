<?php

/* modules/drupalmoduleupgrader/templates/Issue.html.twig */
class __TwigTemplate_365ad9365afa9ff360e459a699296ea0c7dc7a87429ad44687472f3841562ffe extends Twig_Template
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
        $tags = array("autoescape" => 1, "if" => 5, "for" => 10);
        $filters = array("join" => 25);
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('autoescape', 'if', 'for'),
                array('join'),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 2
        echo "    <details class=\"";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["issue"] ?? null), "Tag", array(0 => "error_level"), "method")));
        echo "\">
      <summary>";
        // line 3
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["issue"] ?? null), "Title", array(), "method")));
        echo "</summary>

      ";
        // line 5
        if ( !twig_test_empty($this->getAttribute(($context["issue"] ?? null), "Summary", array()))) {
            echo "<div>";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["issue"] ?? null), "Summary", array())));
            echo "</div>";
        }
        // line 6
        echo "
      ";
        // line 7
        if ( !twig_test_empty($this->getAttribute(($context["issue"] ?? null), "Documentation", array()))) {
            // line 8
            echo "      <h5>Documentation</h5>
      <ul>
        ";
            // line 10
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["issue"] ?? null), "Documentation", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["doc"]) {
                // line 11
                echo "        <li><a target=\"_blank\" href=\"";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute($context["doc"], "url", array())));
                echo "\">";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute($context["doc"], "title", array())));
                echo "</a></li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['doc'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 13
            echo "      </ul>
      ";
        }
        // line 15
        echo "
      ";
        // line 16
        if ( !twig_test_empty($this->getAttribute(($context["issue"] ?? null), "Violations", array()))) {
            // line 17
            echo "      <h5>Files Affected</h5>
      <ul>
      ";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["issue"] ?? null), "Violations", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["violation"]) {
                // line 20
                echo "        <li>";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute($context["violation"], "file", array())));
                if ($this->getAttribute($context["violation"], "line_number", array())) {
                    echo ", line ";
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute($context["violation"], "line_number", array())));
                }
                echo "</li>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['violation'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "      </ul>
      ";
        }
        // line 24
        echo "      ";
        if ($this->getAttribute(($context["issue"] ?? null), "hasTag", array(0 => "fixable"), "method")) {
            echo "<p class=\"fixable\">This issue can be fixed automatically.</p>";
        }
        // line 25
        echo "      ";
        if ( !twig_test_empty($this->getAttribute(($context["issue"] ?? null), "Detectors", array()))) {
            echo "<aside>Flagged by ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(twig_join_filter($this->getAttribute(($context["issue"] ?? null), "Detectors", array()), ", ")));
            echo "</aside>";
        }
        // line 26
        echo "    </details>
";
    }

    public function getTemplateName()
    {
        return "modules/drupalmoduleupgrader/templates/Issue.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 26,  122 => 25,  117 => 24,  113 => 22,  100 => 20,  96 => 19,  92 => 17,  90 => 16,  87 => 15,  83 => 13,  72 => 11,  68 => 10,  64 => 8,  62 => 7,  59 => 6,  53 => 5,  48 => 3,  43 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "modules/drupalmoduleupgrader/templates/Issue.html.twig", "/Users/timalenus/Sites/devdesktop/portingmodule/modules/drupalmoduleupgrader/templates/Issue.html.twig");
    }
}
