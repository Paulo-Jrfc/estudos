package academy.devdojo.maratonajava.introducao;

public class Aula06EstruturaDeRepeticao04 {
    //Dado o valor de um carro, descura em quantas vezes ele pode ser parcelado
    // Condição valorParcela >= 1000
    public static void main(String[] args) {
        double valorTotal = 30000;
        for (int parcela = 1; parcela <= valorTotal; parcela++){
            double valorParcela = valorTotal / parcela;
            if (valorParcela < 1000){
                break;
            }
            System.out.println("Parcela " + parcela + "R$" + valorParcela);
            //Código que executa a mesma coisa, porém por extenso
//            if(valorParcela >= 1000){
//                System.out.println("Parcela " + parcela + "R$" + valorParcela);
//            }else{
//                break;
//            }
            //System.out.println("Fora do if mas dentro do for " + parcela);
        }
    }
}
