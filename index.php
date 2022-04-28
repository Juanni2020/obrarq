<?php
	require_once("funciones.php");
	$rst_obras = $mysqli->query("
		SELECT *, A.arquitecto AS arquitectos_obra
		FROM obras A
		LEFT JOIN registro B
			ON A.idobra = B.iditem AND B.tipoitem = 'obra'
		ORDER BY B.fecha DESC
		LIMIT 30
	;");
		while ($o = $rst_obras->fetch_assoc()):						
			$arquitectos_obra = explode(",",$o["arquitectos_obra"]);
			foreach($arquitectos_obra as $arquitecto_obra):
				$rst_arquitecto_obra = $mysqli->query("
					SELECT *
					FROM arquitectos
					WHERE idarq = $arquitecto_obra
					ORDER BY apellidos
				;");
				$fila_arquitecto_obra = $rst_arquitecto_obra->fetch_assoc();
				$arquitecto[] = $fila_arquitecto_obra["arquitecto"];
			endforeach;
			$arquitectos = implode(", ",$arquitecto);	
			unset($arquitecto);
			$rst_portada = $mysqli->query("
				SELECT imagen
				FROM imagenes
				WHERE obra = $o[idobra] AND portada = 'si'
			;");
			$p = $rst_portada->fetch_assoc();
			if($rst_portada->num_rows>0):
				$pathinfo = pathinfo($p["imagen"]);
				$imgnombre = $pathinfo['filename'];
				$imgext = $pathinfo['extension'];
				$portada = $carpeta_obras.$o["idobra"]."/thumbnails/".$imgnombre."_th.".$imgext;
			else:
				$portada = $fotoobra;
			endif;		
			$imagenobra[]="
					<a href='obra.php?obra=$o[idobra]'>
						<div class='crop' style='background-image: url($portada);'>
							<div class='datosobra' style='padding:10px; display: table-cell; vertical-align: middle; text-align: center; '>
								$o[obra]
								<br>
								$arquitectos
								<br>
								$o[anio]
							</div>
						</div>
					</a>";
		endwhile;
	$todaslasobras = implode($imagenobra," ");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Arquitectos</title>
    <style>	
		@import "arquitectos.css";
		@import "jquery-ui.css";
    </style>
    <script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script type="text/javascript" src="arquitectos_jquery.js"></script>
    <script>
		$(document).ready(function(e) {
			function contador(lugar,contenedor,item){
				cantidad = $(contenedor+" "+item).length;
				$(lugar).append(" ("+cantidad+")");
			};
			contador("a[href='obras.php']","div.w3-main","div.crop");
		});
	</script>
    </head>
    <body style="margin-top:35px;">
		<?php include("widgets/widget_encabezado.php"); ?>
		<?php include("widgets/widget_menu.php"); ?>
        <div class="w3-main" style="margin-left:300px">                                 
			<?php echo $todaslasobras; ?>
		</div>
	</body>
</html>