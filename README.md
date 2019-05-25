## Porque? 
  Esse projeto foi baseado no sdk em php do mercadolivre que atualmente esá com erro, e pensando nisso
  reestruurei e melhorei o sdk php. 
 
## Como criar meu app para começar
  siga esse passo a passo para criar seu primeiro app e iniciar a implementação:
  https://developers.mercadolivre.com.br/pt_br/registre-o-seu-aplicativo
   
## Como faço para instalá-lo? 

       clone repositório
       https://github.com/THAYLLER/sdk-mercadoLivre-PHP.git
 
## Como eu uso isso?

Para usar o sdk suba a pasta para o seu projeto, dentro da pasta sdk/config,  configure seus dados para que o sdk funcione,
após isso faça os includes correspondenes.

### Include
Include das libs

```php
require_once 'sdk/config/config.php';
require_once 'sdk/mercadoLivreActions.php';
require_once 'sdk/mercadoLivreAuth.php';
require_once 'sdk/mercadoLivreProducts.php';
```
Iniciando o desenvolvimento!

### Criando instancia da classe principal

```php
$sdk = new mercadoLivreAuth();
```
### Exemplos

Acesse a pasta exemplos para conferir como consumir esse sdk.

