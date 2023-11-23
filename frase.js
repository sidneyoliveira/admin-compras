function init(SeletorFrase, seletorAutor) {
    // Selecionando elementos do DOM
    const frase = document.querySelector(SeletorFrase);
    const autor = document.querySelector(seletorAutor);
    console.log(frase,autor);

    // Tratativa de erro
    if (frase && autor) {
        // Função Assincrona puxando a frase da API
        async function activeApp() {
            try {
                console.log("entrou");

                // Frase API

                // Faz um fetch na url
                const dadosResponse = await (fetch('./phrases.json'));
                // Aguarda o retorno do Fetch e transforma em JSON
                const dadosJSON = await (await dadosResponse).json();
                // Puxando as frases de forma aleatoria
                const aleatorio = dadosJSON[Math.floor(Math.random() * 200)];

                // Insere os dados no DOM
                frase.innerText = aleatorio.quote;
                autor.innerText = aleatorio.author;
                

            } catch (erro) {
                console.log(erro);
            }

        }
        activeApp();

    }
    // Ativando a função quando entra no site
    
}
// Chamando a função geral para inicar o codigo
init('.frase_mot', '.autor_mot');