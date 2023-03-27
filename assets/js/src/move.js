Array.prototype.move = function(from, to) {
    this.splice(to, 0, this.splice(from, 1)[0]);
    return this;
};
export function move(from, to) {
    this.cards.items.move(from, to);
}


