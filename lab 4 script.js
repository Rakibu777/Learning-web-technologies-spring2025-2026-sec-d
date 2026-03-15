let price = 1000

let quantity = document.getElementById("quantity")
let total = document.getElementById("total")

quantity.addEventListener("input", calculate)

function calculate() {
    let qty = quantity.value
    
    if (qty < 0) {
        quantity.value = 0
        qty = 0
    }
    
    let result = price * qty
    total.value = result
    
    if (result > 1000) {
        alert("You get a gift coupon!")
    }
}