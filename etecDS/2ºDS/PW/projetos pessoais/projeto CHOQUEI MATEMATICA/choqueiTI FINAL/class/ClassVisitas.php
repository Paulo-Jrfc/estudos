<?php
include ("ClassConexao.php");
class ClassVisitas extends ClassConexao{
    private $Id, $Ip, $Data, $Hora, $Limite;

    public function __construct(){
        $this->Id=0;
        $this->Ip=$_SERVER['REMOTE_ADDR'];
        $this->Data=date("Y/m/d");
        $this->Hora=date("H:i");
        $this->Limite=86400;
    }
    
    #Verifica se o usuário recebeu visita recentemente
    public function VerificaUsuario()
    {
        $Select=$this->Conectar()->prepare("select * from tbvisita where ip=:ip and Data=:datas order by idVisita desc");
        $Select->bindParam(":ip",$this->Ip,PDO::PARAM_STR);
        $Select->bindParam(":datas",$this->Data,PDO::PARAM_STR);
        $Select->execute();
        if($Select->rowCount() == 0){
            $this->InserindoVisitas();
        }else{
            $FSelect=$Select->fetch(PDO::FETCH_ASSOC);
            $HoraDB=strtotime($FSelect['hora']);
            $HoraAtual=strtotime($this->Hora);
            $HoraSubtracao=$HoraAtual-$HoraDB;
            //echo $HoraSubtracao;

            if($HoraSubtracao > $this->Limite){
                $this->InserindoVisitas();
            } else{
                //echo "Usuário recente";
            }
        }
        //echo "Visitantes no site: ".$Select->rowCount()."";
    }

    #Inseri a visita no banco de dados
    private function InserindoVisitas()
    {
        $Select=$this->Conectar()->prepare("insert into tbvisita values (:id , :ip , :datas , :hora)");
        $Select->bindParam(":id",$this->Id,PDO::PARAM_STR);
        $Select->bindParam(":ip",$this->Ip,PDO::PARAM_STR);
        $Select->bindParam(":datas",$this->Data,PDO::PARAM_STR);
        $Select->bindParam(":hora",$this->Hora,PDO::PARAM_STR);
        $Select->execute();
    }
}

?>