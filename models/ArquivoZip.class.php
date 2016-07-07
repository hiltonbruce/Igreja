<?php 

class ArquivoZip {
 /**
 * Description of ArquivoZip
 *
 * @author Edvaldo Farias - Programador Web .Net
 */

	/// <summary>
	/// Criar um arquivo ZIP com qualquer arquivo dentro, possibilita o download do arquivo.
	/// </summary>
	
	/// <param name="lista_Arquivo">Array de arquivo que serão salvo, com caminho e extensão do mesmo</param>
	/// <param name="isDownload">FLAG que verificar se o download será necessário</param>
	/// <param name="apagarZipDownload">FLAG que verificar se será necessário apagar o arquivo, só funcionar caso isDownload seja TRUE</param>
	/// <returns></returns>
	function Backup_fotos($lista_Arquivo, $isDownload = false, $apagarZipDownload = false){

		$caminho = 'bkpbanco/'; // <param name="caminho">Caminho aonde será salvo o arquivo</param>
		$nomeZip = 'imgMembros'.date('YmdHis');// <param name="nomeZip">Nome do arquivo ZIP (Caso o arquivo já exista, ele será usado)</param>

		$zip = new ZipArchive();
		if( $zip->open( $caminho . '/' . $nomeZip . '.zip' , ZipArchive::CREATE )  === true){

			foreach ($lista_Arquivo as &$value) {
				$zip->addFile( 'img_membros/'.$value , $value );			
			}

			echo 'Quant. de arquivos incluidos:  '. $zip->numFiles . '<br />';
			$zip->close();

			if($isDownload){
			//Caso seja necessário o download do arquivo
			//	DownloadArquivo($apagarZipDownload, $caminho, $nomeZip);
			}
		}
	}


	/// <summary>
	/// Realizar o download do arquivo ZIP
	/// </summary>
	/// <param name="nomeZip">Nome do arquivo ZIP</param>
	/// <param name="caminho">Caminho aonde está o arquivo</param>
	/// <param name="apagarZipDownload">FLAG que verificar se será necessário apagar o arquivo, só funcionar caso isDownload seja TRUE</param>
	/// <returns></returns>
	function DownloadArquivo($apagarZipDownload, $caminho, $nomeZip){
		header('Content-type: application/zip');
		header('Content-disposition: attachment; filename="' . $nomeZip . '.zip"');
		readfile($caminho . '/' . $nomeZip . '.zip');


		if($apagarZipDownload){
		//Apagar o zip após o download do arquivo.
		//Caso seja setado [true] na variavel [$apagarZipDownload]
			unlink($caminho . '/' . $nomeZip . '.zip');
		}
	}

	/// <summary>
	/// Verificar se existe o arquivo ZIP no caminho especificado
	/// </summary>
	/// <param name="nomeZip">Nome do arquivo ZIP</param>
	/// <param name="caminho">Caminho aonde está o arquivo</param>
	/// <returns></returns>
	function VerificarArquivo($caminho, $nomeZip){
		return $zip->open( $caminho . '/' . $nomeZip . '.zip' );
	}
}