<?php
$alphabet = array ('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$flippedAlphabet = array_flip($alphabet);
if($_POST['swap']) {
	$encodeThis = strtoupper($_POST['encodeThis']);
	$decodeThis = strtoupper($_POST['decodeThis']);
	$swap = array_map('strtoupper',$_POST['swap']);
	if($_POST['decoderRing']) {
		$decoderRing = $_POST['decoderRing'];
		$swap = explode(".",$decoderRing);
	} else {
		$decoderRing = implode(".",$swap);
	}
	$flippedSwap = array_flip($swap);
}

function cipherEncode($string) {
	global $flippedAlphabet;
	global $swap;
	$messageToEncode = str_split(strtoupper($string));
	foreach($messageToEncode AS $msgCharacter) {
		if(ctype_alnum($msgCharacter)) {
			$encodedMessage .= $swap[$flippedAlphabet[$msgCharacter]];
		} else {
			$encodedMessage .= $msgCharacter;
		}
	}
	return $encodedMessage;
}

function cipherDecode($string) {
	global $alphabet;
	global $flippedSwap;
	$messageToDecode = str_split(strtoupper($string));
	foreach($messageToDecode AS $msgCharacter) {
		if(ctype_alnum($msgCharacter)) {
			$decodedMessage .= $alphabet[$flippedSwap[$msgCharacter]];
		} else {
			$decodedMessage .= $msgCharacter;
		}
	}
	return $decodedMessage;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>simpleCipher</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Fira+Mono:400,700' rel='stylesheet' type='text/css'>
	<style>
		body{margin-top:60px;margin-bottom:60px;font-family: 'Fira Mono';}
	</style>
</head>
<body>
	<div class="container theme-showcase" role="main">
		<div class="page-header">
			<h1>Simple Cipher</h1>
		</div>
		<form action="<?=$_SERVER['PHP_SELF'];?>" class="form-horizontal" method="post">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="form-group">
						<label for="decoderRing" class="sr-only">Decoder Ring</label>
						<input type="text" class="form-control" id="decoderRing" name="decoderRing" value="<?=$decoderRing;?>" placeholder="Decoder Ring">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
					<div class="form-group">
						<label for="swapA" class="col-sm-6 control-label">A</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapA" name="swap[]" value="<?=$swap[0];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapB" class="col-sm-6 control-label">B</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapB" name="swap[]" value="<?=$swap[1];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapC" class="col-sm-6 control-label">C</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapC" name="swap[]" value="<?=$swap[2];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapD" class="col-sm-6 control-label">D</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapD" name="swap[]" value="<?=$swap[3];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapE" class="col-sm-6 control-label">E</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapE" name="swap[]" value="<?=$swap[4];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapF" class="col-sm-6 control-label">F</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapF" name="swap[]" value="<?=$swap[5];?>">
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label for="swapG" class="col-sm-6 control-label">G</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapG" name="swap[]" value="<?=$swap[6];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapH" class="col-sm-6 control-label">H</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapH" name="swap[]" value="<?=$swap[7];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapI" class="col-sm-6 control-label">I</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapI" name="swap[]" value="<?=$swap[8];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapJ" class="col-sm-6 control-label">J</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapJ" name="swap[]" value="<?=$swap[9];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapK" class="col-sm-6 control-label">K</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapK" name="swap[]" value="<?=$swap[10];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapL" class="col-sm-6 control-label">L</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapL" name="swap[]" value="<?=$swap[11];?>">
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label for="swapM" class="col-sm-6 control-label">M</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapM" name="swap[]" value="<?=$swap[12];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapN" class="col-sm-6 control-label">N</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapN" name="swap[]" value="<?=$swap[13];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapO" class="col-sm-6 control-label">O</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapO" name="swap[]" value="<?=$swap[14];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapP" class="col-sm-6 control-label">P</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapP" name="swap[]" value="<?=$swap[15];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapQ" class="col-sm-6 control-label">Q</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapQ" name="swap[]" value="<?=$swap[16];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapR" class="col-sm-6 control-label">R</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapR" name="swap[]" value="<?=$swap[17];?>">
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label for="swapS" class="col-sm-6 control-label">S</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapS" name="swap[]" value="<?=$swap[18];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapT" class="col-sm-6 control-label">T</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapT" name="swap[]" value="<?=$swap[19];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapU" class="col-sm-6 control-label">U</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapU" name="swap[]" value="<?=$swap[20];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapV" class="col-sm-6 control-label">V</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapV" name="swap[]" value="<?=$swap[21];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapW" class="col-sm-6 control-label">W</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapW" name="swap[]" value="<?=$swap[22];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapX" class="col-sm-6 control-label">X</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapX" name="swap[]" value="<?=$swap[23];?>">
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label for="swapY" class="col-sm-6 control-label">Y</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapY" name="swap[]" value="<?=$swap[24];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swapZ" class="col-sm-6 control-label">Z</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapZ" name="swap[]" value="<?=$swap[25];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swap0" class="col-sm-6 control-label">0</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap0" name="swap[]" value="<?=$swap[26];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swap1" class="col-sm-6 control-label">1</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap1" name="swap[]" value="<?=$swap[27];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swap2" class="col-sm-6 control-label">2</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap2" name="swap[]" value="<?=$swap[28];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swap3" class="col-sm-6 control-label">3</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap3" name="swap[]" value="<?=$swap[29];?>">
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label for="swap4" class="col-sm-6 control-label">4</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap4" name="swap[]" value="<?=$swap[30];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swap5" class="col-sm-6 control-label">5</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap5" name="swap[]" value="<?=$swap[31];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swap6" class="col-sm-6 control-label">6</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap6" name="swap[]" value="<?=$swap[32];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swap7" class="col-sm-6 control-label">7</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap7" name="swap[]" value="<?=$swap[33];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swap8" class="col-sm-6 control-label">8</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap8" name="swap[]" value="<?=$swap[34];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="swap9" class="col-sm-6 control-label">9</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap9" name="swap[]" value="<?=$swap[35];?>">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<h2>Encode Your Message</h2>
					<div class="form-group">
						<textarea name="encodeThis" id="encodeThis" rows="8" class="form-control" placeholder="Enter your message to encode..."><?=$encodeThis;?></textarea>
					</div>
<? if($encodeThis > "") { ?>
					<div class="well">
						<h3>Encoded Message:</h3>
						<?=cipherEncode($encodeThis);?>
					</div>
<? } ?>
				</div>
				<div class="col-sm-6">
					<h2>Decode Your Message</h2>
					<div class="form-group">
						<textarea name="decodeThis" id="decodeThis" rows="8" class="form-control" placeholder="Enter your message to decode..."><?=$decodeThis;?></textarea>
					</div>
<? if($decodeThis > "") { ?>
					<div class="well">
						<h3>Decoded Message:</h3>
						<?=cipherDecode($decodeThis);?>
					</div>
<? } ?>
				</div>
			</div>
			</form>
		</div>
		</body>
		<script src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
		<script src='https://cdn.jsdelivr.net/bootstrap/3.3.5/js/bootstrap.min.js'></script>
		</html>