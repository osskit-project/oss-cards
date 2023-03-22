<?php
/*
 Variables with suffix '_esc' are the variables are assigned a value from the database and escape function is used
 without suffix are just service ones without any data of DB
 */
$animation_esc = '';
$card_style_esc = '';
$classic_title = '';
$circle_class = '';
$items = '';
$link_start_esc = '';
$link_end_esc = '';
$media_style_esc = '';
$media_bg_esc = '';
$param = '';
$style = '';
$title_color_esc = '';
$title_effect_esc = '';
$card_link_start_esc = '';
$card_link_end = '';
//get items and parameters
if (!empty($data)) {
    $items = $data['items'];//card items
    $param = $data['params'];//card set parameters
    $param = (object)$param;
    //COMPUTED PARAMETERS
    //animation
    switch ($param->animation) {
        case 'none':
            $animation_esc = '';
            break;
        case 'uk-animation-fad':
        case 'uk-animation-slide-top-medium':
        case 'uk-animation-slide-bottom-medium':
        case 'uk-animation-slide-left-medium':
        case 'uk-animation-slide-right-medium':
            $animation_esc = ' uk-scrollspy="target: .oss-card; cls: '. esc_attr( $param->animation ) . '; delay: 250; repeat: true"';
            break;
        default:
            $animation_esc = ' uk-scrollspy="target: .oss-card; cls: uk-animation-fade; delay: 250; repeat: true"';
            break;
    }
    //card style
    switch ($param->card_style) {
        case 'oss-effect-classic':
        case 'oss-effect-default':
            $media_style_esc = esc_attr( $param->card_style );
            break;
        default:
            $media_style_esc = 'oss-effect-classic';
            break;
    }
    //card style
    if (!empty($param->style_card)) {
        $card_style_esc = ' style="'. esc_html( $param->style_card ) . '"';
    }
    //title effect
    if (!empty($param->title_effect)) {
        $title_effect_esc = esc_attr( $param->title_effect );
    }
    //images & icons styles
    if ($param->type == 'image') {
        if ($param->card_style == 'oss-effect-circle') {
            $media_bg_esc_esc = ' style="background:'. esc_attr( $param->circle_bg ) . '"';
        }
    }
    if ($param->type == 'icon' || $param->card_style == 'oss-effect-classic') {
        $classic_title = true;
    }
    //prevent box background if icon
    if ($param->type == 'icon') {
        $media_style_esc = '';
    }
    //title color
    if ($param->title_color) {
        $title_color_esc = ' style="color:'. esc_html( $param->title_color ) . '"';
    }
}
//render block ------
if (!empty($items)) {
    echo '<div class="oss-cards uk-flex-center '. esc_attr( $param->style_grid ) . '" uk-height-match="target: .uk-card"' . $animation_esc . '>';
    foreach ($items as $el) {
        $el = (object)$el;
        // calculated       
        if (!empty($el->link)) {
            //link for whole cart
            if ($param->link_type == 'whole-card') {
                $card_link_start_esc = '<a class="oss-card-link" href="' . esc_url( $el->link ) . '">';
                $card_link_end = '</a>';
            } else {//link for image/icon
                $link_start_esc = '<a href="' . esc_url( $el->link ) . '">';
                $link_end_esc = '</a>';
            }
        }
        echo '<div class="oss_card_wraper">';
        echo $card_link_start_esc;
        echo '<div class="oss-card uk-card uk-card-small '. esc_attr( $param->border ) . '"' . $card_style_esc . '>';
        if (!empty($el->img) || !empty($el->icon)) {
            echo $link_start_esc;
            echo '<div class="osc-media uk-card-media-top ' . $media_style_esc . '"' . $media_bg_esc . '>';
            //image mode
            if ($param->type == 'image') {
                //most common style - not circle
                if ($media_style_esc !== 'oss-effect-circle') {
                    echo '<img src="' . esc_url( $el->img ) . '" alt="' . esc_html( $el->title ) . '">';
                } else {
                    //circle style
                    echo '<div class="osc-circle uk-background-cover" style="background-image: url(' . esc_url( $el->img ) . ')"></div>';
                }
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
            echo $link_end_esc;
            //capture if classic
            if (!empty($el->title)) {
                echo '<div class="uk-card-header ' . $title_effect_esc . ' '. esc_html( $param->text_align ) . '">';
                echo '<h3 class="ok-clean"' . $title_color_esc . '>' . esc_html( $el->title ) . '</h3>';
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
        echo $card_link_end;
        echo '</div>';
    }
    echo '</div>';
}