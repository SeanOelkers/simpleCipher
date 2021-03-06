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
	if(count($swap) != count($flippedSwap)) {
		$repeats = array_diff_key($swap, array_unique($swap));
		$repeatedSubstitutions = implode(",",$repeats);
		$warning = 1;
	}
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

<? if($decoderRing) { ?>
			<div class="row text-center">
			<?=$repeatedSubstitutions?"<div class='alert alert-danger'><strong>Warning</strong>: You've repeated these characters in your Decoder Ring: [".$repeatedSubstitutions."]<br>Your message <strong>will</strong> encode/decode with mistakes!</div>":""?>
				<div class="alert alert-success">
					<strong>Current Decoder Ring</strong>:<br><?=$decoderRing;?>
				</div>
			</div>
<? } ?>

			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="form-group form-inline">
						<label for="decoderRing" class="sr-only">Decoder Ring</label>
						<input type="text" class="form-control" size="80" id="decoderRing" name="decoderRing" value="" placeholder="Decoder Ring">
						<button class="btn btn-primary" type="button" onclick="clearRing()">Clear</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
					<div class="form-group <?=in_array($swap[0], $repeats)?"has-error":""?>">
						<label for="swapA" class="col-sm-6 control-label">A</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapA" name="swap[]" value="<?=$swap[0];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[1], $repeats)?"has-error":""?>">
						<label for="swapB" class="col-sm-6 control-label">B</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapB" name="swap[]" value="<?=$swap[1];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[2], $repeats)?"has-error":""?>">
						<label for="swapC" class="col-sm-6 control-label">C</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapC" name="swap[]" value="<?=$swap[2];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[3], $repeats)?"has-error":""?>">
						<label for="swapD" class="col-sm-6 control-label">D</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapD" name="swap[]" value="<?=$swap[3];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[4], $repeats)?"has-error":""?>">
						<label for="swapE" class="col-sm-6 control-label">E</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapE" name="swap[]" value="<?=$swap[4];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[5], $repeats)?"has-error":""?>">
						<label for="swapF" class="col-sm-6 control-label">F</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapF" name="swap[]" value="<?=$swap[5];?>">
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group <?=in_array($swap[6], $repeats)?"has-error":""?>">
						<label for="swapG" class="col-sm-6 control-label">G</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapG" name="swap[]" value="<?=$swap[6];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[7], $repeats)?"has-error":""?>">
						<label for="swapH" class="col-sm-6 control-label">H</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapH" name="swap[]" value="<?=$swap[7];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[8], $repeats)?"has-error":""?>">
						<label for="swapI" class="col-sm-6 control-label">I</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapI" name="swap[]" value="<?=$swap[8];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[9], $repeats)?"has-error":""?>">
						<label for="swapJ" class="col-sm-6 control-label">J</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapJ" name="swap[]" value="<?=$swap[9];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[10], $repeats)?"has-error":""?>">
						<label for="swapK" class="col-sm-6 control-label">K</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapK" name="swap[]" value="<?=$swap[10];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[11], $repeats)?"has-error":""?>">
						<label for="swapL" class="col-sm-6 control-label">L</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapL" name="swap[]" value="<?=$swap[11];?>">
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group <?=in_array($swap[12], $repeats)?"has-error":""?>">
						<label for="swapM" class="col-sm-6 control-label">M</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapM" name="swap[]" value="<?=$swap[12];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[13], $repeats)?"has-error":""?>">
						<label for="swapN" class="col-sm-6 control-label">N</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapN" name="swap[]" value="<?=$swap[13];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[14], $repeats)?"has-error":""?>">
						<label for="swapO" class="col-sm-6 control-label">O</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapO" name="swap[]" value="<?=$swap[14];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[15], $repeats)?"has-error":""?>">
						<label for="swapP" class="col-sm-6 control-label">P</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapP" name="swap[]" value="<?=$swap[15];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[16], $repeats)?"has-error":""?>">
						<label for="swapQ" class="col-sm-6 control-label">Q</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapQ" name="swap[]" value="<?=$swap[16];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[17], $repeats)?"has-error":""?>">
						<label for="swapR" class="col-sm-6 control-label">R</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapR" name="swap[]" value="<?=$swap[17];?>">
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group <?=in_array($swap[18], $repeats)?"has-error":""?>">
						<label for="swapS" class="col-sm-6 control-label">S</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapS" name="swap[]" value="<?=$swap[18];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[19], $repeats)?"has-error":""?>">
						<label for="swapT" class="col-sm-6 control-label">T</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapT" name="swap[]" value="<?=$swap[19];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[20], $repeats)?"has-error":""?>">
						<label for="swapU" class="col-sm-6 control-label">U</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapU" name="swap[]" value="<?=$swap[20];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[21], $repeats)?"has-error":""?>">
						<label for="swapV" class="col-sm-6 control-label">V</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapV" name="swap[]" value="<?=$swap[21];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[22], $repeats)?"has-error":""?>">
						<label for="swapW" class="col-sm-6 control-label">W</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapW" name="swap[]" value="<?=$swap[22];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[23], $repeats)?"has-error":""?>">
						<label for="swapX" class="col-sm-6 control-label">X</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapX" name="swap[]" value="<?=$swap[23];?>">
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group <?=in_array($swap[24], $repeats)?"has-error":""?>">
						<label for="swapY" class="col-sm-6 control-label">Y</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapY" name="swap[]" value="<?=$swap[24];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[25], $repeats)?"has-error":""?>">
						<label for="swapZ" class="col-sm-6 control-label">Z</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swapZ" name="swap[]" value="<?=$swap[25];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[26], $repeats)?"has-error":""?>">
						<label for="swap0" class="col-sm-6 control-label">0</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap0" name="swap[]" value="<?=$swap[26];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[27], $repeats)?"has-error":""?>">
						<label for="swap1" class="col-sm-6 control-label">1</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap1" name="swap[]" value="<?=$swap[27];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[28], $repeats)?"has-error":""?>">
						<label for="swap2" class="col-sm-6 control-label">2</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap2" name="swap[]" value="<?=$swap[28];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[29], $repeats)?"has-error":""?>">
						<label for="swap3" class="col-sm-6 control-label">3</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap3" name="swap[]" value="<?=$swap[29];?>">
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group <?=in_array($swap[30], $repeats)?"has-error":""?>">
						<label for="swap4" class="col-sm-6 control-label">4</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap4" name="swap[]" value="<?=$swap[30];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[31], $repeats)?"has-error":""?>">
						<label for="swap5" class="col-sm-6 control-label">5</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap5" name="swap[]" value="<?=$swap[31];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[32], $repeats)?"has-error":""?>">
						<label for="swap6" class="col-sm-6 control-label">6</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap6" name="swap[]" value="<?=$swap[32];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[33], $repeats)?"has-error":""?>">
						<label for="swap7" class="col-sm-6 control-label">7</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap7" name="swap[]" value="<?=$swap[33];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[34], $repeats)?"has-error":""?>">
						<label for="swap8" class="col-sm-6 control-label">8</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap8" name="swap[]" value="<?=$swap[34];?>">
						</div>
					</div>
					<div class="form-group <?=in_array($swap[35], $repeats)?"has-error":""?>">
						<label for="swap9" class="col-sm-6 control-label">9</label>
						<div class="col-sm-6 text-right">
							<input type="text" maxlength="1" class="form-control" id="swap9" name="swap[]" value="<?=$swap[35];?>">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
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
	<script type="text/javascript">
	function clearRing() {
	     document.getElementById("decoderRing").value="";
	}
	</script>

		</body>
		</html>