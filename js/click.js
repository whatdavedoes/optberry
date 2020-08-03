class Click {
  constructor(){
    this.start = Date.now();
    this.end = null;
  }
    
  endClick() {
      this.end = Date.now();
  }
}