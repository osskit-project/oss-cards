
//data------------------
import anim from './build/animation.js'
import effects from './build/card-effects.js'
import icons_fa from './build/icons-fa.js'
import icons_fa_cats from './build/icon-fa-categories.js'
// functions -------------
import { tabShow, tabVisible } from './src/nav.js'
import { addItem, del } from './src/add.js'
import { move } from './src/move.js'
import { media, delMedia } from './src/media.js'
import { editElMain, editEl, do_active_anim, active_anim , do_active_style, active_style, closeModals, activeIcon, active_tab, editNow } from './src/edit.js'
import { anim_cat_selected, pro_note1, pro_note2, ratio, circleBg, animParam, refresh, filter_fa, toString, } from './src/functions.js'
import { icon_cat_selected, icon_filter, loadMore } from './src/icon-load.js'//rm
import { icon_style, linkStyle, icon_style_box, icon_style_circle,  media_style, cardGrid, classic_title, cardbox_style, animation } from './src/style.js'
var app = new Vue({
el: '#app-cards',
    data:{ 
        cards: null,
        tabs:[

            {
                elem: "main",
                title: "Add",
                use: "uk-active",
                icon: "fas fa-id-card-alt",
            },
            {
                elem: "style",
                title: "Style",
                use: false,
                icon: "fas fa-cog",
            },
            {
                elem: "icons",
                title: "Icon Style",
                use: false,
                icon: "fab fa-fonticons",
            },
            {
                elem: "export",
                title: "Export",
                use: false,
                icon: "fas fa-code",
            },
            {
                elem: "full",
                title: "Full Width",
                use: false,
                icon: "fas fa-arrows-alt-h",
            },
            {
                elem: "sidebar",
                title: "Sidebar",
                use: false,
                icon: "fab fa-wordpress-simple",
            },
            {
                elem: "hints",
                title: "Hints",
                use: false,
                icon: "fas fa-info-circle",
            },
            {
                elem: "back",
                title: "Back",
                use: false,
                icon: "fas fa-arrow-alt-circle-left",
            },
        ],
        item:{
            edit:false,
            imgManager: false,
            img:"",
            title:"Your Title",
            icon:"fab fa-wordpress",
            icon_show:"",
            icon_color:"",
            subtitle:"Lorem Ipsum dolor",
            text:"Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            link:"",
            link_text:"Read More",
            link_icon:"",
            animation:"",
            animation_on:"",
            p1:"",//confirm delay
            p2:"",//confirm install
            p3:"",
            p4:"",
            p5:"",
            p6:"",
            p7:"",
            p8:"",
            p9:"",
        },
        display:true,
        side_tab:"",
        keyword:"",
        anim_group:"",
        animation_on:0,
        panel: 1,
        show_data: 0,
        show_cards: 1,
        osti_show_data: false,
        anim_set:{
            group:"all",
            options:["all","basic","bounce","scale","rotate","flip","blurred","elliptic","focus","swing","puff","tilt","tracking","roll","jello", "shadow"],
            els: anim,
        },     
        icon_fa:{
            search_cat: "all",
            search: "",
            icons: icons_fa,
            cats: icons_fa_cats,
        },
        effects: effects,
        loader: false,

    },
    methods: {
        active_anim,
        activeIcon,
        active_style,
        active_tab,
        addItem,
        animation,
        animParam,
        anim_cat_selected,
        cardbox_style,
        cardGrid,
        circleBg,
        classic_title,
        closeModals,
        delMedia,
        del,
        do_active_anim,
        do_active_style,
        editElMain,
        editEl,
        filter_fa,
        icon_cat_selected,
        icon_style_box,
        icon_style_circle,
        icon_filter,
        icon_style,
        linkStyle,
        loadMore,
        media_style,
        media,
        move,
        pro_note1,
        pro_note2,
        ratio,
        refresh,
        tabShow,
        tabVisible,
        toString,
        editNow,
    },
    computed: {
        iconsFiltered() {//rm
          return this.icon_fa.icons.filter((el) => {
            return el.toLowerCase().includes(this.icon_fa.search.toLowerCase());
          });
        },
        filtered_icons() {//rm
          return this.icon_set.icons.filter((el) => {
            return el.toLowerCase().includes(this.icon_set.search.toLowerCase());
          });
        },
        filteredAnimList() {
          return this.anim.filter((el) => {
            return el.value.toLowerCase().includes(this.anim_group.toLowerCase());
          });
        },
        passData() {
            let data = '';       
            if (typeof OSDATA !== 'undefined') {
                data = JSON.parse(OSDATA);
            }else{
                data = {
                    title: "", 
                    edit_mode: false, 
                    items: [], 
                    params:{
                        type: "image", 
                        card_style: "oss-effect-classic", 
                        orientation: "horizontal", 
                        grid: "uk-child-width-1-3@s", 
                        full: "", 
                        icon_size: "100", 
                        icon_color: "#0F3D58", 
                        icon_bg: "#b0bec5", 
                        icon_circle: "osc-icon-box",
                        edit: "1", 
                        border: "uk-card-default", 
                        border_color: "", 
                        card_bg: "", 
                        title_color: "", 
                        color: "", 
                        link_type: "uk-button uk-button-default", 
                        but_bg: "#D9DFEF", 
                        link_color: "", 
                        toggle_sidebar: "", 
                        animation: "uk-animation-fade", 
                        title_effect: "osc-text-tactile", 
                        ratio: "oss-ratio-3-2", 
                        circle_bg: "", 
                        text_align: "oss-text-left",  
                        activ_anim: 0, 
                        activ_style: 0, 
                        style_card:"", 
                        style_icon:"", 
                        style_icon_box:"", 
                        style_icon_circle:"", 
                        style_grid:"",  
                        style_link:"",   
                        p1:"osc-icon-box-span", 
                        p2:"", 
                        p3:"", 
                        p4:"", 
                        p5:"", 
                        p6:"", 
                        p7:"",
                    }
                };   
            }
          return data;
        },
    },
    created() {
        this.cards = this.passData;   
      },
})
