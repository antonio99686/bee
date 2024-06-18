// Código JavaScript para manipulação do carrinho
const cartItemsList = document.getElementById('cart-items');
const checkoutButton = document.getElementById('checkout');

// Função para adicionar um item ao carrinho
function addToCart(productName, price) {
  const item = document.createElement('li');
  item.textContent = `${productName} - R$${price.toFixed(2)}`;
  cartItemsList.appendChild(item);
}

// Simulação de adição de produtos ao carrinho
addToCart('Maçãs', 2.99);
addToCart('Leite', 3.49);
addToCart('Pão', 1.99);

// Função de finalizar compra
checkoutButton.addEventListener('click', () => {
  alert('Compra finalizada! Obrigado por comprar conosco.');
  cartItemsList.innerHTML = ''; // Limpar o carrinho
});
    