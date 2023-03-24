<?php
//get items and parameters
if (!empty($data)) {
    $items = $data['items'];//card items
    $param = $data['params'];//card set parameters
    $param = (object)$param;
}
//render block ------
if (!empty($items)) {
    // with animation and without
    if ( ! empty($param->animation)) {
        echo '<div class="oss-cards uk-flex-center '. esc_attr( $param->style_grid ) . '" uk-height-match="target: .uk-card" uk-scrollspy="target: .oss-card; cls: '. esc_attr( $param->animation ) . '; delay: 250; repeat: true">';
    } else {
        echo '<div class="oss-cards uk-flex-center '. esc_attr( $param->style_grid ) . '" uk-height-match="target: .uk-card">';
    }
    foreach ($items as $el) {
        $el = (object)$el;
        echo '<div class="oss_card_wraper">';
        if ($param->link_type == 'whole-card' && !empty($el->link)) {
            echo '<a class="oss-card-link" href="' . esc_url( $el->link ) . '">';
        }         
        echo '<div class="oss-card uk-card uk-card-small '. esc_attr( $param->border ) . '" style="'. esc_html( $param->style_card ) . '">';
        if (!empty($el->img) || !empty($el->icon)) {
            if ( ! empty($el->link)) {
                echo '<a href="' . esc_url( $el->link ) . '">';
            }
            echo '<div class="osc-media uk-card-media-top oss-effect-classic">';
            //image mode
            if ($param->type == 'image') {
                echo '<img src="' . esc_url( $el->img ) . '" alt="' . esc_html( $el->title ) . '">';
            } else {
                //icone mode
                echo '<div class="osc-icon-box" style="'. esc_attr( $param->style_icon_box )  . '"">';
                if ($param->icon_circle !=='osc-icon-box') {
                    echo '<div class="'. esc_attr( $param->icon_circle ) . '"  style="'. esc_attr( $param->style_icon_circle )  . '">'; 
                    echo '<i class="' . esc_attr( $el->icon ) . '"  style="'. esc_attr( $param->style_icon ) . '"></i>';
                    echo '</div>';
                } else {
                    echo '<i class="' . esc_attr( $el->icon ) . '"  style="'. esc_attr( $param->style_icon ) . '"></i>';
                }
                echo '</div>';
            }
            echo '</div>';
            if ( ! empty($el->link)) {
                echo '</a>';
            }
            //capture if classic
            if (!empty($el->title)) {
                echo '<div class="uk-card-header ' . esc_attr( $param->title_effect ) . ' '. esc_html( $param->text_align ) . '">';
                echo '<h3 class="ok-clean" style="color:'. esc_html( $param->title_color ) . '">' . esc_html( $el->title ) . '</h3>';
                echo '</div>';
            }
            //description text
            if (!empty($el->text)) {
                echo '<div class="uk-card-body '. esc_attr( $param->text_align ) . '">';
                echo esc_textarea( $el->text ) ;
                echo '</div>';
            }
            //link
            if (!empty($el->link) and $param->link_type !== 'whole-card') {
                echo '<div class="uk-card-footer '. esc_attr( $param->text_align ) . '">';
                echo '<a class="'. esc_attr( $param->link_type ) . '" href="' . esc_url( $el->link ) . '" style="'. esc_attr( $param->style_link ) . '">' . esc_html( $el->link_text ) . '</a>';
                echo '</div>';
            }
        }
        echo '</div>';
        if ($param->link_type == 'whole-card' && !empty($el->link)) {
            echo '</a>';
        } 
        echo '</div>';
    }
    echo '</div>';
}