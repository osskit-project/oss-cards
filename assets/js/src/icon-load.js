export function icon_cat_selected(ind){
    var str = this.icon_set.cat;
    var arr = str.split(' ');
    for(let i = 0; i < arr.length; i++) {
        if (this.icon_set.icons[ind].includes(arr[i].toLowerCase())) {
            return true;
        }
    }
    if (str == 'all') {
        return true;
    }
}
export function icon_filter(ind){
  if (this.icon_set.data[ind].includes(this.icon_set.search.toLowerCase())) {
      return true;
  }
  if (this.icon_set.search == '') {
      return true;
  }
}
export function loadMore() {
      this.icon_set.busy = true;
      setTimeout(() => {
        for (var i = 0, j = 10; i < j; i++) {
          this.data.push({ name: count++ });
        }
        this.busy = false;
      }, 1000);
} 
// export function 