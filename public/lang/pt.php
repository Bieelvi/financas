<?php 

declare(strict_types=1);

function translate(string $optionText) {
    $textArray = [
        "Bieelvi Finance" => "Finanças Bieelvi",
        "Finance" => "Finanças",
        "Page Logo Alt" => "Logo da página: é um porquinho com uma moeda logo em cima com contornos em preto.",
        "Reports" => "Relatórios",
        "Farmer" => "Fazendário",
        "Products" => "Produtos",
        "Sign In" => "Entrar",
        "Sign Up" => "Inscrever-se",
        "Profile" => "Perfil",
        "Logout" => "Sair",
        "Close" => "Fechar",
        "Confirm" => "Confirmar",
        "Product" => "Produto",
        "Select a product" => "Selecione um produto",
        "Type" => "Tipo",
        "Select a type" => "Selecione um tipo",
        "Initial value" => "Valor inicial",
        "Final value" => "Valor final",
        "Initial date" => "Data inicial",
        "Final date" => "Data final",
        "Search" => "Pesquisar",
        "Exemple 100" => "Exemplo R$ 100,00",
        "Exemple 200" => "Exemplo R$ 200,00",
        "Value" => "Valor",
        "Date" => "Data",
        "Observation" => "Observação",
        "Observations" => "Observações",
        "Back" => "Voltar",
        "Edit" => "Editar",
        "Register" => "Registrar",
        "Gain" => "Ganho",
        "Spent" => "Gasto",
        "Farmer list" => "Lista do fazendário",
        "Clean filter" => "Limpar filtro",
        "Filter" => "Filtro",
        "Actions" => "Ações",
        "No comments" => "Sem nenhuma observação",
        "Delete product" => "Deletar produto",
        "Are you sure you want to delete this farm?" => "Você tem certeza que deseja deletar este fazendário?"
    ];

    if (isset($textArray[$optionText])) {
        return $textArray[$optionText];
    }

    return $optionText;    
}