class Product {
  constructor(id, title){
    this.id = id;
    this.title = title;
    
    this.categories = [];
  }
    
  addCategory(category) {
      this.categories.push(category);
  }
}