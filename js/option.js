class Option {
  constructor(id, selectId, title, displayTitle, radio, addedPrice, position, dependsOne, dependsCase, dependsTwo, notifyText, notifyType){
    this.option = 'option';
      
    this.id = id;
    this.selectId = selectId;
    this.title = title;
    this.displayTitle = displayTitle;
    this.radio = radio;
    this.addedPrice = addedPrice;
    this.position = position;
    this.dependsOne = dependsOne;
    this.dependsCase = dependsCase;
    this.dependsTwo = dependsTwo;
    this.notifyText = notifyText;
    this.notifyType = notifyType; 
      
    this.currentOption = false;
      
    this.clicks = [];
  }
    
  addClick(click) {
      this.clicks.push(click);
  }
}