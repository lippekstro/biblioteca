// preciso selecionar o olho e o input
let olho = document.getElementById('btn-olho')
let senha = document.getElementById('senha')
let visivel = false

// criar um evento de click no olho
olho.addEventListener('click', () => {
    // ao clicar, abre o olho e exibe o valor do campo
    if (visivel == false) {
        olho.src = "/biblioteca/imgs/olho_aberto.png"
        senha.type = "text"
        visivel = true
    } else {
        olho.src = "/biblioteca/imgs/olho_fechado.png"
        senha.type = "password"
        visivel = false
    }
})

