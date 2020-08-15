class Category {
  constructor(title, id, displayTitle, label_clr, btn_clr, btn_hvr_clr, btn_txt_clr, btn_txt_hvr_clr) {
      this.currentCategory = false;
      this.title = title;
      this.id = id;
      this.displayTitle = displayTitle;
      this.label_clr = label_clr;
      this.btn_clr = btn_clr;
      this.btn_hvr_clr = btn_hvr_clr;
      this.btn_txt_clr = btn_txt_clr;
      this.btn_txt_hvr_clr = btn_txt_hvr_clr;
      this.label = 'category';
      
      //start, end, label
      this.clicks = [];
      this.groups = [];
  }
    
  addGroup(group) {
      this.groups.push(group);
  }
    
  addClick(click) {
      this.clicks.push(click);
  }
}