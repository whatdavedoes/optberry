class Option {
  constructor(id, selectId, title, displayTitle, radio, addedPrice, position, dependsOne, defaultOption, notifyText, notifyType, required){
    this.option = 'option';
      
    this.id = id;
    this.selectId = selectId;
    this.title = title;
    this.displayTitle = displayTitle;
    this.radio = radio;
    this.addedPrice = addedPrice;
    this.position = position;
    this.dependsOne = dependsOne;
    this.defaultOption = defaultOption;
    this.notifyText = notifyText;
    this.notifyType = notifyType;
    this.required = required;
      
    this.currentOption = false;
      
    this.clicks = [];
  }
    
  addClick(click) {
      this.clicks.push(click);
  }
}