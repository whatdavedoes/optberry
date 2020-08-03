class Group {
  constructor(id, title, description, oneSelection, requireFirst) {
      this.currentGroup = false;
      
      this.id = id;
      this.title = title;
      this.description = description;
      this.oneSelection = oneSelection;
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