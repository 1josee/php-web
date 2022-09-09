const cart = JSON.parse(localStorage.getItem('Cart'))
if ( cart === null){
    window.alert("Your Shopping Cart Is Empty")
} else{
for ( i=0;i < cart.length; i++){
    const LCName = cart[i].name
    const LCPrice = cart[i].price
    const LCImg = cart[i].img
    const LCQuantity = cart[i].quantity
    const total = LCPrice * LCQuantity 
    window.onload = addItemToCart()
    function addItemToCart(){
    let cartItems = document.getElementsByClassName('table-body')[0]
    let cartRow = document.createElement('tr')
    cartRow.classList.add('table-row')
    var cartRowContents = 
    `
    <tr class="table-row">
        <td>
            <button class="danger">
                <i class="far fa-times-circle"></i>
            </button>
        </td>
        <td name="image"><img src="${LCImg}" alt=""></td>
        <td> ${LCName}
        <input type="hidden" name="product_name[]" value="${LCQuantity} ${LCName}">
        </td>
        <td class="table-price">${LCPrice}
        <input type="hidden" name="price[]" value="${total}"</td>
        <td><input class="table-quantity-input" name="quantity" type="text" value="${LCQuantity}"></td>
    </tr>
    `
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    updateCartTotal()
}
}
}

window.onload = updateCartTotal()

const removeCartItemButtons = document.getElementsByClassName("danger")
for (let i = 0; i<removeCartItemButtons.length; i++){
    const button = removeCartItemButtons[i]
    button.addEventListener('click',removeCartItem)
}

var quantityInputs = document.getElementsByClassName('table-quantity-input')
for (var i = 0; i <quantityInputs.length; i++){
    var input = quantityInputs[i]
    input.addEventListener('change', quantityChanged) 
}

function removeCartItem(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.parentElement.remove()
    updateCartTotal() 
}

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateCartTotal()
}

function updateCartTotal(){
    var cartItemContainer = document.getElementsByClassName('table-body')[0]
    var cartRows = cartItemContainer.getElementsByClassName('table-row')
    var total = 0
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('table-price')[0]
        var quantityElement = cartRow.getElementsByClassName('table-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('$', ''))
        var quantity = Number(quantityElement.value)
        total = total + (price * quantity)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('table-subtotal')[0].innerText = '$'+ total
    document.getElementsByClassName('Last-Total')[0].innerText = '$' + total
}

// Checkout
// Checkout
const checkoutBtn = document.getElementById('checkoutBtn')
checkoutBtn.addEventListener('click', say);
function say(){
    console.log('hello')
    localStorage.clear()
}
// Export to CSV 
// const data = [
//     [LCImg, LCName, LCSize, LCPrice, LCQuantity],
// ];
// console.log(data)
// let csvContent = "data:text/csv;charset=utf-8,";

// data.forEach(function(rowArray) {
//     let row = rowArray.join(",");
//     csvContent += row + "\r\n";
// });

class TableCSVExporter {
    constructor (table, includeHeaders = true) {
        this.table = table;
        this.rows = Array.from(table.querySelectorAll("tr"));
        console.log(this);
    }

    convertToCSV () {

    }

    _findLongestRowLength () {
      
    }

    static parseCell (tableCell) {
     
    }
}
