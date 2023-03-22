export function anim_cat_selected(i){
    var selected = this.anim_set.group;
    if(this.anim_set.els[i].cat == selected) {
        return true;
    }
    if(selected == 'all') {
        return true;
    }
}
export function pro_note1(){
    switch (this.cards.params.animation) {
      case '':
      case 'uk-animation-fade':
      case 'uk-animation-slide-top-medium':
      case 'uk-animation-slide-bottom-medium':
      case 'uk-animation-slide-left-medium':
      case 'uk-animation-slide-right-medium':
        return false;
        break;
      default:
        return true;
    }
}
export function pro_note2(){
    switch (this.cards.params.card_style) {
      case 'none':
      case 'oss-effect-classic':
      case 'oss-effect-default':
        return false;
        break;
      default:
        return true;
    }
}
export function cardGrid() {
    let r = '';
    if (this.cards.params.orientation == 'horizontal') {
        if (this.cards.params.type =='image' && this.cards.params.card_style!=='oss-effect-circle') {
            r = this.cards.params.ratio;
        }
        return 'uk-grid ' + this.cards.params.grid + ' ' + r;
    } else {
        if (this.cards.params.full) {
           return 'oci-full-width'; 
        } else {
            return 'oci-fixed-width'; 
        }
    }
    var el = this.cards.items[i];
    this.cards.items[i].img = '';
}
export function ratio(){
  this.display = false;
  setTimeout(() => this.display = true, 500);
  setTimeout(() => {
  jQuery('.oss-cards').ossRatio();
  }, 500);
}
export function circleBg(){
    if (this.cards.params.card_style=='oss-effect-circle') {
        return 'background:' + this.cards.params.circle_bg;
    }
}
export function animParam(v){
    if (v !=='none') {
      this.cards.params.animation = v;  
    }
}
export function refresh(){
    this.show_cards = 0;
    setTimeout(() => this.show_cards = 1, 500);
}
export function filter_fa(ind){
  if (this.icon_fa.search!== '') {
    this.icon_fa.search_cat == 'all';
    if (this.icon_fa.icons[ind].includes(this.icon_fa.search.toLowerCase())) {
      return true;
    }
  }else{
      if (this.icon_fa.search_cat == 'all') {
        return true;
      } else {
        var arr = this.icon_fa.search_cat.split(' ');
        for(let i = 0; i < arr.length; i++) {
              if (this.icon_fa.icons[ind].includes(arr[i].toLowerCase())) {
                return true;
            }
        }
    }
  }
}
export function toString(){
    return JSON.stringify(this.cards);
}