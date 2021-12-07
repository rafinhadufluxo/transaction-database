# Transaction php with postgres on csv

O desafio aqui é implementar uma transação em diferentes linguagens de programação. Ao
implementar uma transação deve-se ficar atento à questão de como iniciá-la e finalizá-la.
Ou seja, algumas linguagens apenas executam a operação de commit quando for
explicitamente invocado o comando de finalização. Para compararmos, iremos dividir as
principais linguagens de programação entre os grupos e cada grupo irá apresentar como a
determinada linguagem de programação se comporta.

Segue um código exemplo de uma transação em JAVA.

``` java

public class Teste {
    public static void main(String[] args) {
        final String url = "jdbc:postgresql://localhost:5432/postgres"; //indica o caminho do banco de dados
        final String user = "usuario"; // aqui vai o nome usuario que vc quer acessar
        final String password = "123"; // aqui a senha do seu banco
        
        int id = 12;
        String autor = "ddgfdgdg";
        String query = "INSERT INTO autor(id, name) VALUES(?, ?)";
        Time time_i=getTime()
        try (Connection con = DriverManager.getConnection(url, user, password);
            PreparedStatement pst = con.prepareStatement(query)) {
            con.setAutoCommit(false);
            pst.setInt(1, id);
            pst.setString(2, autor);
            pst.executeUpdate();
            con.commit();
            System.out.println("Transação efetuada com sucesso");
        } catch (SQLException ex) {
            System.out.println("Transação não efetuada");
            Logger lgr = Logger.getLogger(Teste.class.getName());
            lgr.log(Level.SEVERE, ex.getMessage(), ex);
        }
        Time time_e=getTime()
    }
}

```

O principal ponto a ser notado é que foi acionado o comando setAutoCommit(false) para
desabilitar a operação de auto commit. Algumas linguagens implementam isso de forma
automática. Após executar operações de inserção, é acionado o comando de "salvamento" para finalizar a operação.

## Detalhes que foram atendidas :
<br>

1. Inserindo as tuplas em uma tabela usando o Postgres, os dados em um  arquivo csv.  <br>
2. A linguagem utilizada foi php com preferência na versão 7.4 por diante.  <br>
3. Não esqueça de instalar o  `sudo apt install php7.4-psql`, pois irá precisar para conexão do banco de dados do `PostgreSQL` com php assim fazendo alterações e trabalhando no seu ambiente. 


<br>

## Funções a serem implementadas:
<br>
1- Realizada a inserção dos dados na tabela utilizando uma função com transações implícitas
vs. transações explícitas (comando insert a cada nova inserção). Compare o tempo de
inserção. Explique o motivo da variação do tempo. <br>
PS: rodar 5 vezes e fazer a média e desvio padrão dos tempos de execução para
evitar perturbações de outros processos.<br>
2- Implementar uma função que cause um rollback na transação (ex: um campo mal
formado). Alguma tupla foi salva no caso da implícita e da explícita?

<br>

## Como Contribuir

Para contribuir e deixar a comunidade open source um lugar incrivel para aprender, projetar, criar e inspirar outras pessoas. Basta seguir as instruções logo abaixo:

1. Realize um Fork do projeto
2. Crie um branch com a nova feature (`git checkout -b feature/featureTransaction`)
3. Realize o Commit (`git commit -m 'Add some featureTransaction'`)
4. Realize o Push no Branch (`git push origin feature/featureTransaction`)
5. Abra um Pull Request

<br>

## Autores

- **[Bianca Gabriela Fritsch](https://github.com/bbiancaa)** - _Acadêmica do Curso de Ciência da Computação -UFFS_. 
- **[Rafinha](https://github.com/rafalup)** - _Acadêmica do Curso de Ciência da Computação -UFFS_. 
