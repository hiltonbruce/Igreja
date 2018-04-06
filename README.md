Igreja
======

###Controle administrativo e financeiro para Igrejas Evangélicas

 O sistema está em franca expansão e atualmente conta com os módulos de cadastro de membros, controle de disciplinados, cartas de: recomendação, em trânsito e mudança, controle de entrega de cartão de membro, emissão de cartão de membros, não cadastra rol's com a sequência de três seis (666), para evitar a duplicidade de cadastro critica a existência de nomes já cadastrados e dar a possibilidade de usá-lo ou não, exige o uso de CPF para o cadastro permitindo apenas o uso de um número por pessoa e na ausência deste número ainda dá a possibilidade, embora não recomendada, do número do rol em substituição bastando deixar em branco o espaço para o CPF, listagem de membros: totais, por congregações, cargo eclesiástico, ...

  O programa tem uma estrutura coesa totalmente baseado em Software Livre, com uso de linguagens de programação isentas de cobranças de quaisquer tipo de licença e sem nenhuma restrição de uso. Visando a implantação de intranet's para acesso locais ou externos o detentor do sistema tem total liberdade para expandi-lo.


__Desenvolvimento__

 Recomenda-se a implantação em Linux Debian Server, pela estabilidade e segurança oferecido por esta plataforma. Requer ainda servidor de Web Apache, banco de dados MySQL, módulo PHP5 ativo, pacote PEAR DB e recomendamos ainda a instalação do PHPMyadmin e o MySQL Admin, este último, principalmente, para o backup dos dados. Lembrando, sem ser redundante, todas as ferramentas são de uso livre, sem custos com licenças ou limitação de uso. Todas essas ferramentas são instaladas neste mesmo servidor Web.
 A concepção do sistema dispensa a instalação de qualquer programa nas estações que farão uso dele e para tanto requer o uso de qualquer navegador de internet, embora remendamos o uso do firefox® versão 40.0 ou superior pelo respeito que este navegador tem aos padrões W3C, responsável este por ditar a padronização da WEB.
 Já estamos realizando estudos e o sistema ira migrar 100% para o modelo MVC, simplificando, isto lhe dará independência quanto ao desenvolvedor, continuidade, adaptação as suas necessidades, não havendo necessidade de entrar em contato conosco para implantação ou personalização que você achar conveniente. Para tanto quem vier a implantar as alterações, que não nós, deverá obrigatoriamente ter conhecimento deste padrões.

  A total falta de um sistema personalizado, moderno, isento de pretensões exclusivamente financeiras, e pensado para facilitar e automatizar os trabalhos corriqueiros da secretária da igreja e auxiliar a direção nas tomadas de decisões.

  Atualmente os módulos estão concentrados no apoio aos serviços desenvolvidos na secretária executiva e Tesouraria da igreja e ainda notamos a ausência de alguns serviços importantes, tais como: cartas convites, circulares e alguns relatórios, os passos, após a conclusão das demais necessidades da secretária executiva, será sua integração a administração patrimonial, escola bíblica, financeira, agenda entre outros.

  O desenvolvimento atual está concentrado na conclusão para um funcionamento mínimo da tesouraria e estamos testando para finalizar e assim criar os demais modulos acessórios, como por exemplo: a edição do plano de contas da igreja, espinha dorsal de qualquer administração contábil.

  Esperamos que os usuários deste sistema possa enviar sua opinião e sugestões para que seja analisada e talvez disponibilizado nas novas atualizações.

  O Senhor Jesus esteve presente durante todo desenvolvimento me dando o rumo em meio a tantos códigos. Espero no Deus de Abraão, Isaque e Jacó que o uso deste software ajude a abençoar sua igreja, facilitando trabalhos e lhe permitindo mais tempo e dedicação nas outras áreas da obra de Deus.

   Deus abençoe a igreja!

#### Gerência do projeto
- Joseilton C Bruce

#### Equipe técnica
- Joseilton C Bruce - Bayeux - PB - Brasil

###Pastas de armazenamento de dados
   Deve ser criada a pasta /img_membros com privilégio para o Apache, usuário 'www-data' no Debian Linux, salvar e apagar as fotos dos membros.
   A pasta /bkpbanco deve ser dado, também para o apache, o privilégio de salvar e apagar arquivos nela.

##Banco de Dados
 A biblioteca pear-DB deve está instalada no servidor onde estará o sistema, no caso das versões Debian o php-db, caso contrário a aplicação não irá autenticar.
 Utilizando o PHPMyadmin, você deve antes criar o banco de dados 'assembleia' e depois importar a estrutura do banco que está no diretório /Banco, nele existe alguns dados mínimos para a inicialização da aplicação.
 Dá permissão de drop na tabela transcheck para o usuario igreja.
 O usuario de acesso ao banco está no script /func_class/constantes.php (user:'usuarioBanco' e password:'senha').
 O usuario da aplicação é: ''111.111.111-11'' e a senha:'admin'

## Licença

#### __Tipo MIT__
 Copyright (c) 2013 Autor:Joseilton Costa Bruce

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.
