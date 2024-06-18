    
        const carrinho = [];
        let total = 0;

        function adicionarProduto(nome, preco) {
            const produto = { nome, preco };
            carrinho.push(produto);
            total += preco;
            atualizarCarrinho();
        }

        function atualizarCarrinho() {
            const carrinhoElement = document.getElementById("carrinho");
            const totalElement = document.getElementById("total");
            
            carrinhoElement.innerHTML = "";
            
            for (const produto of carrinho) {
                const li = document.createElement("li");
                li.textContent = `${produto.nome}: R$ ${produto.preco.toFixed(2)}`;
                carrinhoElement.appendChild(li);
            }

            totalElement.textContent = total.toFixed(2);
        }

        function exibirRecibo() {
            alert("Recibo da Compra:\n\n" + carrinho.map(p => `${p.nome}: R$ ${p.preco.toFixed(2)}`).join("\n") + "\n\nTotal: R$ " + total.toFixed(2));
        }