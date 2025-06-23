// item count
const quantityInput = document.getElementById('quantity');
const warningMessage = document.getElementById('warning-message');

document.getElementById('increase-btn').addEventListener('click', function () {
    let currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity < 100) {
        quantityInput.value = currentQuantity + 1;
    }
    warningMessage.style.display = "none";
});

document.getElementById('decrease-btn').addEventListener('click', function () {
    let currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
        warningMessage.style.display = "none";
    } else {
        warningMessage.style.display = "block";
    }
});

quantityInput.addEventListener('input', function () {
    let value = parseInt(quantityInput.value);
    if (isNaN(value) || value < 1) {
        warningMessage.style.display = "block";
        quantityInput.value = 1;
    } else {
        warningMessage.style.display = "none";
    }
});