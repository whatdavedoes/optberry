class Group {
  constructor(id, title, description, oneSelection, requireFirst) {
      this.currentGroup = false;
      
      this.title = title;
      this.id = id;
      this.description = description;
      if (oneSelection == 0) {
        this.oneSelection = false;
      } else {
        this.oneSelection = true; 
      }
      this.requireFirst = requireFirst;
      
      this.label = 'group';
      
      //start, end, label
      this.clicks = [];
      this.options = [];
  }
    
  addOption(option) {
      this.options.push(option);
  }
    
   addClick(click) {
      this.clicks.push(click);
  }
}