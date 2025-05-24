<?php

namespace ValidatorPTBr;

use Illuminate\Support\ServiceProvider;

class ValidatorProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Bootstrap the application events.
     *
     * @return void
     */

    public function boot()
    {
        $rules = [
            'celular'                        => \ValidatorPTBr\Rules\Celular::class,
            'celular_com_ddd'                => \ValidatorPTBr\Rules\CelularComDdd::class,
            'celular_com_codigo'             => \ValidatorPTBr\Rules\CelularComCodigo::class,
            'celular_com_codigo_sem_mascara' => \ValidatorPTBr\Rules\CelularComCodigoSemMascara::class,
            'cnh'                            => \ValidatorPTBr\Rules\Cnh::class,
            'cnpj'                           => \ValidatorPTBr\Rules\Cnpj::class,
            'cns'                            => \ValidatorPTBr\Rules\Cns::class,
            'cpf'                            => \ValidatorPTBr\Rules\Cpf::class,
            'ddi'                            => \ValidatorPTBr\Rules\DDI::class,
            'ddi_sem_mascara'                => \ValidatorPTBr\Rules\DDISemMascara::class,
            'formato_cnpj'                   => \ValidatorPTBr\Rules\FormatoCnpj::class,
            'formato_cpf'                    => \ValidatorPTBr\Rules\FormatoCpf::class,
            'telefone'                       => \ValidatorPTBr\Rules\Telefone::class,
            'telefone_com_ddd'               => \ValidatorPTBr\Rules\TelefoneComDdd::class,
            'telefone_com_codigo'            => \ValidatorPTBr\Rules\TelefoneComCodigo::class,
            'formato_cep'                    => \ValidatorPTBr\Rules\FormatoCep::class,
            'formato_placa_de_veiculo'       => \ValidatorPTBr\Rules\FormatoPlacaDeVeiculo::class,
            'formato_pis'                    => \ValidatorPTBr\Rules\FormatoPis::class,
            'pis'                            => \ValidatorPTBr\Rules\Pis::class,
            'cpf_ou_cnpj'                    => \ValidatorPTBr\Rules\CpfOuCnpj::class,
            'formato_cpf_ou_cnpj'            => \ValidatorPTBr\Rules\FormatoCpfOuCnpj::class,
            'uf'                             => \ValidatorPTBr\Rules\Uf::class,
        ];

        foreach ($rules as $name => $class) {
            $rule = new $class;

            $extension = static function ($attribute, $value) use ($rule) {
                return $rule->passes($attribute, $value);
            };

            $this->app['validator']->extend($name, $extension, $rule->message());
        }
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
