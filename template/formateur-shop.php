<h3>Être mis en avant - Boutique</h3>
<style>
.lp-content-area{
    min-width:100%!important;
}
.container{
    max-width:100%!important;
}

@media screen and (min-width:1024px ) and (max-width:1352px)  {
    .elementor-row{
        flex-wrap:wrap!important;
    }
    .elementor-column.elementor-col-33, .elementor-column[data-col="33"]{
        width:50%;
    }
}
</style>
<?php

if (class_exists("\\Elementor\\Plugin")) {
    $post_ID = 10989;
    $pluginElementor = \Elementor\Plugin::instance();
    $contentElementor = $pluginElementor->frontend->get_builder_content($post_ID);
}

echo $contentElementor;

hideLearnpresTabNav();
