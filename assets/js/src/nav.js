
export function tabShow(i) {
    var el = this.tabs[i];
    //all cards edit false
    for(let i = 0; i < this.cards.items.length; i++) {
        this.cards.items[i].edit = false;
    }
    //all section edit = false
    for(let z = 0; z < this.tabs.length; z++) {
        this.tabs[z].use = false;
    }
    jQuery('body').removeClass('oss_show_full_width');
    jQuery('#osti_show_help, #osti_show_data').fadeOut(300);
    el.use = 'uk-active';
}

export function tabVisible(i) {
    var el = this.tabs[i];
    if (el.elem!=='icons') {
        return true;
    } else {
        if (this.cards.params.type == 'icon') {
          return true;  
        }
    }
}


