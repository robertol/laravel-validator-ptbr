# laravel-validator-ptbr: Validações brasileiras para Laravel.

Esta biblioteca adiciona validações brasileira ao Laravel, como CPF, CNPJ, Placa de Carro, CEP, Telefone, Celular e afins.

:brazil::brazil::brazil:

## Versões

<table>
     <tr>
        <td>^11.0</td>
        <td>^11.0</td>
    </tr>
     <tr>
        <td>^12.0</td>
        <td>^12.0</td>
    </tr>
</table>

## Instalação

Navegue até a pasta do seu projeto, por exemplo:

```
cd /etc/www/projeto
```

E então execute:

```
composer require robertol/laravel-validator-ptbr
```

Caso esteja utilizando uma versão desta biblioteca anterior a `5.2`, você deve o provider em `config/app.php`.
```php
'providers' => [
    // ... outros pacotes
    ValidatorPTBr\ValidatorProvider::class
]
```
Agora, para utilizar a validação, basta fazer o procedimento padrão do `Laravel`.

A diferença é que será possível usar os seguintes métodos de validação:

|           REGRA          |                                                                       Descrição                                                                                              |
|:-------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------:|
| ddi                      | Valida se o campo está no formato com DDI (**`+55`**).                                                                                                                       |
| ddi_sem_mascara          | Valida se o campo está no formato `*55*`.                                                                                                                                    |
| celular                  | Valida se o campo está no formato (**`99999-9999`** ou **`9999-9999`**).                                                                                                     |
| celular_com_ddd          | Valida se o campo está no formato (**`(99)99999-9999`** ou **`(99)9999-9999`** ou **`(99) 99999-9999`** ou **`(99) 9999-9999`**).                                            |
| celular_com_codigo       | Valida se o campo está no formato `+99(99)99999-9999` ou +99(99)9999-9999.                                                                                                   |
| cnpj                     | Valida se o campo é um CNPJ válido. É possível gerar um CNPJ válido para seus testes utilizando o site [geradorcnpj.com](http://www.geradorcnpj.com/).                       |
| cnpj_alpha               | Valida se o campo é um CNPJ Alfanumérico válido. É possível gerar um CNPJ Alfanumérico valido em [geradorbrasil.com](https://geradorbrasil.com/gerador-de-cnpj-alfanumerico) |
| cpf                      | Valida se o campo é um CPF válido. É possível gerar um CPF válido para seus testes utilizando o site [geradordecpf.org](http://geradordecpf.org).                            |
| cns                      | Valida se o campo é um CNS válido. Use o site [geradornv.com.br](https://geradornv.com.br/gerador-cns/) para testar.                                                         |
| formato_cnpj             | Valida se o campo tem uma máscara de CNPJ correta (**`99.999.999/9999-99`**).                                                                                                |
| formato_cpf              | Valida se o campo tem uma máscara de CPF correta (**`999.999.999-99`**).                                                                                                     |
| formato_cep              | Valida se o campo tem uma máscara de correta (**`99999-999`** ou **`99.999-999`**).                                                                                          |
| telefone                 | Valida se o campo tem umas máscara de telefone (**`9999-9999`**).                                                                                                            |
| telefone_com_ddd         | Valida se o campo tem umas máscara de telefone com DDD (**`(99)9999-9999`**).                                                                                                |
| telefone_com_codigo      | Valida se o campo tem umas máscara de telefone com DDD (**`+55(99)9999-9999`**).                                                                                             |
| formato_placa_de_veiculo | Valida se o campo tem o formato válido de uma placa de veículo (incluindo o padrão MERCOSUL).                                                                                |
| formato_pis              | Valida se o campo tem o formato de PIS.                                                                                                                                      |
| formato_cnpj_alpha       | Valida se o campo tem o formato de CNPJ Alfanumérico.                                                                                                                        |
| pis                      | Valida se o PIS é válido.                                                                                                                                                    |
| cpf_ou_cnpj              | Valida se o campo é um CPF ou CNPJ .                                                                                                                                         |
| formato_cpf_ou_cnpj      | Valida se o campo contém um formato de CPF ou CNPJ.                                                                                                                          |
| uf                       | Valida se o campo contém uma sigla de Estado válido (UF).                                                                                                                    |

## Testando as validações do PtBrValidator

Com isso, é possível fazer um teste simples

```php

$validator = \Validator::make(
    ['telefone' => '(77)9999-3333'],
    ['telefone' => 'required|telefone_com_ddd']
);

dd($validator->fails());

```

Você pode utilizá-lo também com a instância de `Illuminate\Http\Request`, através do método `validate`.

Veja:

```php

use Illuminate\Http\Request;

// URL: /testando?telefone=3455-1222

Route::get('testando', function (Request $request) {

    try{

        $dados = $request->validate([
            'telefone' => 'required|telefone',
            // outras validações aqui
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        dd($e->errors());
    }

});

```

### Customizando as mensagens

Todas as validações citadas acima já contam mensagens padrões de validação, porém, é possível alterar isto usando o terceiro parâmetro de `Validator::make`. Este parâmetro deve ser um array onde os índices sejam os nomes das validações e os valores devem ser as respectivas mensagens.

Por exemplo:

```php
Validator::make($valor, $regras, ['celular_com_ddd' => 'O campo :attribute não é um celular'])
```

Ou através do método `messages` do seu Request criado pelo comando `php artisan make:request`.

```php
public function messages() {

    return [
        'campo.telefone' => 'Telefone não válido!'
    ];
}
```

### Acessando as Regras separadamente

Caso tenha necessidade de acessar alguma regra separadamente, você poderá ter acesso as seguintes classes:

```
\ValidatorPTBr\Rules\Celular::class,
\ValidatorPTBr\Rules\CelularComDdd::class,
\ValidatorPTBr\Rules\CelularComDddSemMascara::class,
\ValidatorPTBr\Rules\CelularComCodigo::class,
\ValidatorPTBr\Rules\CelularComCodigoSemMascara::class,
\ValidatorPTBr\Rules\Cnh::class,
\ValidatorPTBr\Rules\Cnpj::class,
\ValidatorPTBr\Rules\CnpjAlpha::class,
\ValidatorPTBr\Rules\Cns::class,
\ValidatorPTBr\Rules\Cpf::class,
\ValidatorPTBr\Rules\DDI::class,
\ValidatorPTBr\Rules\DDISemMascara::class,
\ValidatorPTBr\Rules\FormatoCnpj::class,
\ValidatorPTBr\Rules\FormatoCnpjAlpha::class,
\ValidatorPTBr\Rules\FormatoCpf::class,
\ValidatorPTBr\Rules\Telefone::class,
\ValidatorPTBr\Rules\TelefoneComDdd::class,
\ValidatorPTBr\Rules\TelefoneComCodigo::class,
\ValidatorPTBr\Rules\FormatoCep::class,
\ValidatorPTBr\Rules\FormatoPlacaDeVeiculo::class,
\ValidatorPTBr\Rules\FormatoPis::class,
\ValidatorPTBr\Rules\Pis::class,
\ValidatorPTBr\Rules\CpfOuCnpj::class,
\ValidatorPTBr\Rules\FormatoCpfOuCnpj::class,
\ValidatorPTBr\Rules\Uf::class,
```

Por exemplo, se você deseja validar o formato do campo de um CPF, você pode utilizar a classe `ValidatorPTBr\Rules\FormatoCpf` da seguinte forma:

```php
use Illuminate\Http\Request;
use ValidatorPTBr\Rules\FormatoCpf;

// testando?cpf=valor_invalido

Route::get('testando', function (Request $request) {

    try{

        $dados = $request->validate([
            'cpf'  => ['required', new FormatoCpf]
            // outras validações aqui
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        dd($e->errors());
    }

});
```

## Changelog

- 9.1.0 - Validação `cns` (cartão nacional de saúde) adicionada.
- 8.0.3 - Validação `uf` adicionada.
- 8.0.2 - Validação `cpf_ou_cnpj`
- 5.2.1 - Validação `cpf_ou_cnpj`




## Sugestões

[Eloquent Filter](https://github.com/robertol/eloquent-filter): Essa biblioteca foi desenvolvida com o propósito de criar facilmente filtros de pesquisa para APIs REST. Com esta biblioteca, você vai economizar várias linhas de códigos, bem como manter um padrão global para filtros de pesquisa em sua aplicação escrita em Laravel.


## Doações

[Paypal](https://www.paypal.com/donate/?business=KCAGBVD5TJLUL&no_recurring=0&item_name=Ajude+a+sustentar+algu%C3%A9m+que+apoia+o+open-source+%3A%29&currency_code=BRL)
