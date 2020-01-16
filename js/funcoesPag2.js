$(document).ready(function(){
    fLocalMontarTabela();
    $xml_string=file_get_content("xml.xml");
    $xml_object=simplexml_load_string($xml_string);
    print_r($xml_object);
});

function fLocalMontarTabela(){
    var html = ""

    for(var i=0; i < emails.length; i++){
        html = "";
        html += "<tr>";
        html += "<td>" + emails[i].de + "</td>";
        html += "<td>" + emails[i].destinatarios + "</td>";
        html += "<td>" + emails[i].mensagem + "</td>";
        html += "</td>";

        if( emails[i].de == "voce" ){
            $("#ListagemEnviados").append(html);
        }
        else{
            $("#ListagemRecebidos").append(html);
        }
    }
}