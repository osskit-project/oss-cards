<section id="oss-top-bar" class="uk-grid osc-top-bar">
    <div>
        <label for="st-orientation"><?php esc_html_e('Card Type', 'oss-cards') ?></label>
        <select id="st-orientation" v-model="cards.params.type" v-on:change="ratio()">
            <option value="image">Image</option>
            <option value="icon">Icon</option>
        </select>
    </div>
    <div>
        <label for="st-orientation"><?php esc_html_e('Layout', 'oss-cards') ?></label>
        <select id="st-orientation" v-model="cards.params.orientation" v-on:change="ratio()">
            <option value="horizontal">Horizontal</option>
            <option value="vertical">Vertical</option>
        </select>
    </div>
    <div v-if="cards.params.orientation=='horizontal'">
        <label for="st-grid"><?php esc_html_e('Items in Row', 'oss-cards') ?></label>
        <select id="st-grid" v-model="cards.params.grid" v-on:change="ratio()">
            <option value="uk-child-width-1-2@s">2</option>
            <option value="uk-child-width-1-3@s">3</option>
            <option value="uk-child-width-1-4@s">4</option>
        </select>
    </div>
    <div v-if="cards.params.orientation=='vertical'">
        <input id="st-full" type="checkbox" v-model="cards.params.full">
        <label for="st-full"><?php esc_html_e('Full Width', 'oss-cards') ?></label>
    </div>
    <div class="oss_shortcode_block">
        <span>Shortcode</span> 
        <input class="osc_copy_shortcode" type="text" value="[oss_cards id=<?php echo $post->ID ?>]"> 
        <i class="fas fa-copy osc_copy_shortcode_click"></i>   
    </div>
    <div class="osc_refresh" v-on:click="ratio()"><?php esc_html_e('Refresh', 'oss-cards') ?><i class="fas fa-redo-alt"></i>
</section>
<div v-if="display" class="uk-container uk-container-center">
    <div class="oci-empty"
         v-if="!cards.items.length"><?php esc_html_e('You have no cards yet.  Fill the form on left and click button - Add Item', 'oss-cards') ?>
        <br><?php esc_html_e('You can add as many cards as you wish, and edit or delete them then', 'oss-cards') ?>
    </div>
    <transition-group v-if="show_cards" tag="div" name="list" class="oss-cards uk-flex-center" :class="[cardGrid()]" uk-height-match="target: .uk-card" :uk-scrollspy="animation()">
        <div class="osc-wraper" v-for="(el, index) in cards.items" :key="index">
            <div class="icongroup-wrapper">
            <span v-if="cards.params.edit" class="oci-icon-group">
                <span class="oss_del" v-on:click="del(index)"><i class="fas fa-trash"></i></span>
                <span v-if="cards.params.orientation=='horizontal'" v-on:click="move(index,index-1)" :disabled="index==0"><i class="fas fa-arrow-left"></i></span>
                <span v-if="cards.params.orientation=='horizontal'" v-on:click="move(index,index+1)" :disabled="index==(cards.items.length-1)"><i class="fas fa-arrow-right"></i></span>
                <span v-if="cards.params.orientation=='vertical'" v-on:click="move(index,index-1)" :disabled="index==0"><i class="fas fa-arrow-up"></i></span>
                <span v-if="cards.params.orientation=='vertical'" v-on:click="move(index,index+1)" :disabled="index==(cards.items.length-1)"><i class="fas fa-arrow-down"></i></span>
                <span v-on:click="editEl(index)"><i class="fas fa-edit"></i></span>
            </span>
            </div>
            <div class="oss-card uk-card uk-card-small" :class="cards.params.border" :style="cardbox_style()" v-on:click="editEl(index)">
                <div class="osc-media uk-card-media-top" :class=" media_style()" :style="circleBg()">
                    <template v-if="cards.params.type=='image'">
                        <img v-if="cards.params.card_style!=='oss-effect-circle'" :src="el.img" :alt="el.title">
                        <div v-if="cards.params.card_style=='oss-effect-circle'" class="osc-circle uk-background-cover" :style="{ backgroundImage: `url(${el.img})` }"></div>
                    </template>
                    <div v-if="cards.params.type=='icon'" class="osc-icon-box" :style="icon_style_box()">
                        <i v-if="cards.params.icon_circle=='osc-icon-box'" :class="el.icon" :style="icon_style()"></i>
                        <div v-if="cards.params.icon_circle!=='osc-icon-box'" :class="cards.params.icon_circle" :style="icon_style_circle()">
                            <i :class="el.icon" :style="icon_style()"></i>
                        </div>
                    </div>
                    <template v-if="!classic_title() && el.subtitle">
                        <div class="osc-heading-box" :class="cards.params.title_effect" v-if="cards.params.card_style!=='oss-effect-classic'">
                            <h3 :style="{color: cards.params.title_color}">{{el.title}}</h3>
                            <p :style="{color: cards.params.title_color}">{{el.subtitle}}</p>
                        </div>
                    </template>
                </div>
                <div v-if="classic_title() && el.title" class="uk-card-header" :class="[cards.params.text_align, cards.params.title_effect]">
                    <h3 class="uk-card-title" :style="{color: cards.params.title_color}">{{el.title}}</h3>
                </div>
                <div class="uk-card-body" :class="cards.params.text_align">
                    {{el.text}}
                </div>
                <div v-if="el.link && cards.params.link_type!=='whole-card'" class="uk-card-footer" :class="cards.params.text_align">
                    <span :class="cards.params.link_type" :style="linkStyle()">{{el.link_text}}</span>
                </div>
            </div>
        </div>
    </transition-group>
    <div v-if="pro_note1()" class="oss-info-box-alert uk-card uk-card-default uk-margin" :class="cards.params.orientation">
      <div uk-grid>
        <div class="uk-width-auto">
          <div class="oss-info-icon-box-alert" style="font-size: 42px; background: #f00; padding: 20px; color:#fff"> 
            <i class="fas fa-exclamation-triangle"></i>
          </div>
        </div>
        <div class="uk-width-expand oss-info-text-box">
            <?php esc_html_e('You have selected an Animation Premium. It displays in backend as a Demo, but will be replaced in frontend with with default.', 'oss-cards') ?> <br><?php esc_html_e('To use it get version Premiun , thus you will help further development', 'oss-cards') ?>
        </div>
      </div>
    </div>
    <div v-if="pro_note2()" class="oss-info-box-alert uk-card uk-card-default" :class="cards.params.orientation">
      <div uk-grid>
        <div class="uk-width-auto">
          <div class="oss-info-icon-box-alert" style="font-size: 42px; background: #f00; padding: 20px; color:#fff"> 
            <i class="fas fa-exclamation-triangle"></i>
          </div>
        </div>
        <div class="uk-width-expand oss-info-text-box">
            <?php esc_html_e('You have selected a Card Style Premium. It displays in backend as a Demo, but will be replaced in frontend with default.', 'oss-cards') ?>
            <br><?php esc_html_e('To use it get version Premiun , thus you will help further development.', 'oss-cards') ?>
        </div>
      </div>
    </div>

    <div class="oci-info uk-margin" :class="cards.params.orientation">
        <p><strong><?php esc_html_e('Notes', 'oss-cards') ?></strong></p>
        <ul>
            <li><?php esc_html_e('Preview can slightly differ from frontend because of area width of preview here and areas where you going to use. ', 'oss-cards') ?></li>
        </ul>
    </div>
</div>
<!-- HINTS WINDOW -->
<div id="osti_show_help">
    <span id="close_data" v-on:click="closeModals()"><i class="fas fa-times-circle"></i></span>
    <h3 class="uk-heading-divider"><?php esc_html_e('Hints & Help', 'oss-cards') ?></h3>
    <ul uk-accordion>
        <li>
            <a class="uk-accordion-title" href="#"><?php esc_html_e('Edit Card', 'oss-cards') ?></a>
            <div class="uk-accordion-content">
                <p><?php esc_html_e('To edit a card not necessary click icon edit, whole card is edit trigger. Icon marked just you know that you can edit card', 'oss-cards') ?></p>
                <img src=" <?php echo OSS_ASSETS_URL . 'images/docs/doc-2.jpg' ?>" alt="">
            </div>
        </li>
        <li>
            <a class="uk-accordion-title" href="#"><?php esc_html_e('External Images URL', 'oss-cards') ?></a>
            <div class="uk-accordion-content">
                <p><?php esc_html_e('You can use external images as well. For this you no need to use media library, just enter its URL in the field(see screenshot)', 'oss-cards') ?>
                    <br><?php esc_html_e('Remember - Some can have copyright, use your own from another sites or images under necessary licences', 'oss-cards') ?>
                </p>
                <img src=" <?php echo OSS_ASSETS_URL . 'images/docs/doc-3.jpg' ?>" alt="">
            </div>
        </li>
        <li>
            <a class="uk-accordion-title" href="#"><?php esc_html_e('Widget usage', 'oss-cards') ?></a>
            <div class="uk-accordion-content">
                <p><?php esc_html_e('You can use widget to display your Cards as well.', 'oss-cards') ?>
                    <br><?php esc_html_e('Use it if your theme has widgets in the necessary areas.', 'oss-cards') ?>
                    <br><?php esc_html_e('Go to widgets find OSS Cards Widget, add and select in dropdown.', 'oss-cards') ?>
                    <br><?php esc_html_e('This method is useful if you want to use cards outside content area, for example in sidebar, footer etc', 'oss-cards') ?>
                </p>
                <img src=" <?php echo OSS_ASSETS_URL . 'images/docs/doc-1.jpg' ?>" alt="">
            </div>
        </li>
        
    </ul>
</div>
<div class="osc_copyed_alert"><?php esc_html_e('Shortcode Is Copied', 'oss-cards') ?></div>