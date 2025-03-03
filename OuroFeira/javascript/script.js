var request;

let emailBackup;

function login() {
    var email = document.getElementById("Email").value;
    var senha = document.getElementById("Senha").value;

    localStorage.setItem('emailBackup', email);

    if ((email == "emailteste@gmail.com" && senha == "senha123") || (email == "emailcomum@gmail.com" && senha == "comum123")) {
        window.location.href = 'teladeAcessoaCompra.html';
        window.alert("LogIn feito com sucesso!!!");

    } else {
        alert("Os dados informados estao errados, digite novamente")

    }

}
//Quadrado de fundo das telas de logon,cadrasto,redefinição de senha 
document.addEventListener('DOMContentLoaded', () => {
    const textoH1 = document.getElementById('texto');
    const quadrado = document.getElementById('quadrado');

    function ajustarQuadrado() {
        const textoH1Rect = textoH1.getBoundingClientRect();
        quadrado.style.width = `${textoH1Rect.width}px`;
        quadrado.style.height = `${textoH1Rect.height}px`;
        quadrado.style.top = `${textoH1Rect.top}px`;
        quadrado.style.left = `${textoH1Rect.left}px`;
    }

    // Ajustar o quadrado na carga inicial da página
    ajustarQuadrado();

    // Ajustar o quadrado ao redimensionar a janela
    window.addEventListener('resize', ajustarQuadrado);
});




function Verificacao() {
    alert("Os dados informados estao errados, digite novamente")
}


function Verificacaoreridencinar() {
    window.location.href = 'trocaAsenha.html'
}
function cadastro() {
    var nome = document.getElementById("Nome").value;
    var Email = document.getElementById("Email").value;
    var Telefone = document.getElementById("Telefone").value;
    var Cpf = document.getElementById("Cpf").value;
    var Senha = document.getElementById("Senha").value;

    if (email == "emailteste@gmail.com" && senha == "senha123") {
        alert("Cadrasto feito com suceso,/n iremos redirecionar voce para a tela de login")
        window.location.href = 'login.html'
    } else {
        alert("Algum campo esta sem informação nesesaria, por favor prença os campos coretos")
    }
}

function retirarProduto() {

}
function EscolherProduto() {

}
function Comprar() {

}


function pagar() {








    const randomString = generateRandomString(15);

    console.log(randomString);


    var qrcode = new QRCode(document.getElementById("qrcode"), {

        text: randomString,
        width: 300,
        height: 300

    });


    window.alert("Compra feita com sucesso!!!");



}

function generateRandomString(length) {
    const charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const values = new Uint8Array(length);
    window.crypto.getRandomValues(values);

    return Array.from(values, value => charset[value % charset.length]).join('');
}

function comprovante() {

    const randomString = generateRandomString(15);
    new QRCode(document.getElementById("qrcode"), randomString);



}


function funcADM() {
    const botaoAdm = document.getElementById("botao-adm");

    // Recupera o e-mail do localStorage
    const emailBackup = localStorage.getItem('emailBackup');

    if (emailBackup === "emailteste@gmail.com") {
        botaoAdm.style.display = "block";
    } else {
        botaoAdm.style.display = "none";
    }

}




document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('listaitens');
    const galeria = document.getElementById('galeria');

    if (!select || !galeria) {
        console.error("Elementos 'listaitens' ou 'galeria' não encontrados no DOM.");
        return;
    }

    // Objeto de mapeamento: categorias para imagens e legendas
    const imagensPorCategoria = {
        comida: [
            { src: 'Imagems/comida_1.png', nome: 'Cachorro Quente', preco: 'R$ 5,00', quantidade: '25 unidades', peso: '150g' },
            { src: 'Imagems/comida_2.png', nome: 'Hamburger', preco: 'R$ 25,00', quantidade: '22 unidades', peso: '200g' },
            { src: 'Imagems/comida_3.png', nome: 'Bolo', preco: 'R$ 15,00', quantidade: '23 unidades', peso: '500g' }
        ],
        bebida: [
            { src: 'Imagems/bebida_1.png', nome: 'Água', preco: 'R$ 2,00', quantidade: '23 unidades', peso: '500ml' },
            { src: 'Imagems/bebida_2.png', nome: 'Guaraná', preco: 'R$ 4,00', quantidade: '12 unidades', peso: '2l' },
            { src: 'Imagems/bebida_3.png', nome: 'Café', preco: 'R$ 2,00', quantidade: '21 unidades', peso: '250ml' }
        ],
        artesanato: [
            { src: 'Imagems/artesanato_1.png', nome: 'Vasos de Cerâmica', preco: 'R$ 30,00', quantidade: '23 unidades', peso: '1kg' },
            { src: 'Imagems/artesanato_2.png', nome: 'Cestos', preco: '20,00', quantidade: '21 unidades', peso: '800g' },
            { src: 'Imagems/artesanato_3.png', nome: 'Artesanato Diverso', preco: 'R$ 50,00', quantidade: '21 unidades', peso: '1.5kg' }
        ]
    };

    select.addEventListener('change', () => {
        const categoriaSelecionada = select.value;
        galeria.innerHTML = ''; // Limpa a galeria antes de adicionar novas imagens

        if (imagensPorCategoria[categoriaSelecionada]) {
            imagensPorCategoria[categoriaSelecionada].forEach(item => {
                const { src, descricao, nome, preco, quantidade, peso } = item;

                const imagem = new Image();
                imagem.src = src;

                imagem.onerror = () => console.error(`Erro ao carregar imagem: ${src}`);

                const imagemContainer = document.createElement('div');
                imagemContainer.className = 'imagem-container';

                const imagemElement = document.createElement('img');
                imagemElement.src = src;
                imagemElement.alt = descricao;

                const descricaoParagrafo = document.createElement('p');
                descricaoParagrafo.className = 'descricao-imagem';
                descricaoParagrafo.innerHTML = `
                    <strong>Nome:</strong> ${nome}<br>
                    <strong>Preço:</strong> ${preco}<br>
                    <strong>Quantidade:</strong> ${quantidade}<br>
                    <strong>Peso:</strong> ${peso}<br>
                    
                `;

                imagemContainer.appendChild(imagemElement);
                imagemContainer.appendChild(descricaoParagrafo);

                galeria.appendChild(imagemContainer);
            });
        } else {
            console.warn(`Nenhuma imagem definida para a categoria: ${categoriaSelecionada}`);
        }
    });
});
function Popup() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
  }