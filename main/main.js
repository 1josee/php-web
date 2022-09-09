

// // Product page
// const heroName = document.getElementsByClassName('shop-item-title')[0].innerText
// const price = document.getElementsByClassName('shop-item-price')[0]
// .innerText




// Add to cart
var addToCartButtons = document.getElementsByClassName('shop-item-button')
for (var i = 0; i < addToCartButtons.length; i++) {
    var button = addToCartButtons[i]
    button.addEventListener('click', addToCartClicked)
}

function addToCartClicked(event){
  var button= event.target
  var shopItem = button.parentElement
  var shopItemItem = button.parentElement.parentElement
  var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText
  var priceS = shopItem.getElementsByClassName('shop-item-price')[0].innerText
  var imageSrc = shopItemItem.getElementsByClassName
  ('shop-item-image')[0].src
  var quantities = shopItem.getElementsByClassName('quantity-input')[0].value
  // var sizes = shopItem.getElementsByClassName('shop-item-size')[0].value

  // Local storage
  var cart = {
        "img" : imageSrc,
        "name" : title,
        "price" : priceS,
        "quantity" : quantities
  };  

  if(localStorage.getItem('Cart') == null){
    localStorage.setItem("Cart","[]");
  }
  var old_cart = JSON.parse(localStorage.getItem('Cart'));
  old_cart.push(cart);
  localStorage.setItem('Cart',JSON.stringify(old_cart))
}


