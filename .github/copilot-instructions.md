# SisIGREJA - Sistema de Controle para Igrejas Evangélicas

## Arquitetura e Estrutura do Sistema

Este é um sistema legado de gestão eclesiástica desenvolvido em PHP que utiliza MySQL, seguindo padrões clássicos de desenvolvimento web com elementos de arquitetura MVC em transição.

### Componentes Principais

#### 1. Sistema de Autenticação (`autentica.php`)
- Login baseado em CPF/senha com hash MD5
- Sistema de sessões PHP com níveis de acesso (perfil, setor, nível)
- Redirecionamento automático por setor: tesouraria (`setor='2'`) ou secretaria (outros)
- Validação obrigatória de troca de senha inicial

#### 2. Ponto de Entrada (`index.php`)
- Front controller que processa `$_GET["escolha"]` e `$_POST["escolha"]` para roteamento
- Autoloader personalizado baseado em convenção `dir_classe.class.php`
- Sistema de menus dinâmicos baseado em nível de usuário
- Charset ISO-8859-1 e timezone América/Recife

#### 3. Camada de Dados (`func_class/`)
- **constantes.php**: Configurações do sistema (DB, igreja, percentuais)
- **classes.php**: Classes principais incluindo:
  - `DBRecord`: ActiveRecord pattern para manipulação de registros únicos
  - `rodape`: Sistema de paginação com Bootstrap
  - `central`: Roteador de páginas baseado em parâmetros GET/POST

#### 4. Modelos (`models/`)
- Classes específicas por domínio: `membro.class.php`, `igreja.class.php`
- Padrão de nomenclatura: `NomeClasse.class.php`
- Queries SQL diretas (sem ORM) com MySQL procedural

### Padrões de Desenvolvimento

#### Estrutura de Arquivos
```
/var/www/igreja/
??? adm/           # Administração de membros
??? controller/    # Controladores por módulo
??? models/        # Classes de modelo
??? views/         # Templates de visualização
??? func_class/    # Classes base e utilitários
??? relatorio/     # Geração de relatórios
??? tesouraria/    # Módulo financeiro
```

#### Roteamento de URLs
- Padrão: `/?escolha=pasta/arquivo.php&parametros`
- Exemplo: `/?escolha=adm/dados_pessoais.php&bsc_rol=123`
- Menus contextuais via `&menu=top_nome`

#### Banco de Dados
- MySQL com conexão via PEAR DB e PDO
- Tabelas principais: `membro`, `igreja`, `eclesiastico`, `usuario`
- Rol como chave primária para membros (evita sequência 666)
- Schema em `/Banco/BD_install_20250202.sql`

### Módulos Funcionais

#### Gestão de Membros (`adm/`)
- Cadastro completo: dados pessoais, eclesiásticos, familiares
- Sistema de cartas: recomendação, mudança, trânsito
- Controle disciplinar e situação espiritual
- Upload de fotos em `/img_membros/`

#### Sistema Financeiro (`tesouraria/`)
- Controle de dízimos e ofertas
- Provisões automáticas (missões: 40%, convenção: 10%)
- Agenda de pagamentos e recebimentos
- Relatórios por congregação e período

#### Relatórios (`relatorio/`)
- Fichas de membros e certidões
- Cartões de membro com validação
- Relatórios estatísticos por cargo/congregação
- Templates para impressão

### Convenções Específicas

#### Segurança e Validação
- Validação de CPF obrigatória (um por pessoa)
- Sistema de níveis: > 10 para funcionalidades administrativas
- Backup automático em `/bkpbanco/` com permissões Apache

#### Interface e UX
- Bootstrap 3 + jQuery para UI responsiva
- Máscaras de input (CPF, telefone, datas) via jQuery.mask
- Sistema de abas e tooltips
- Chat interno entre usuários (`chat/`)

#### Gestão de Estados
- Sessões PHP para controle de acesso
- Variáveis de sessão: `valid_user`, `nivel`, `setor`, `nome`
- Timezone e locale brasileiros configurados

### Comandos de Desenvolvimento

#### Configuração Inicial
1. Criar banco 'assembleia' e importar `/Banco/BD_install_20250202.sql`
2. Configurar permissões: `www-data` em `/img_membros/` e `/bkpbanco/`
3. Usuário padrão: CPF '111.111.111-11', senha 'admin'

#### Estrutura de Desenvolvimento
- Use o padrão de classes existente em `models/` para novos módulos
- Siga o sistema de roteamento via `escolha` parameter
- Implemente validações JavaScript + PHP server-side
- Utilize `DBRecord` para operações CRUD simples

### Observações Importantes

- Sistema legado com dependências MySQL procedural (migração para MySQLi/PDO em andamento)
- Codificação ISO-8859-1 (não UTF-8)
- Sem framework moderno - padrões internos estabelecidos
- Foco em funcionalidades específicas para gestão eclesiástica brasileira
