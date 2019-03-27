<?php

use Ibd\Ksiazki;

$ksiazki = new Ksiazki();
$lista = $ksiazki->pobierzBestsellery();

?>

<div class="col-md-2">
	<h1>Bestsellery</h1>
	

	<table class="table"> 
	<tbody>
		<?php foreach($lista as $ks): ?>
			<tr>
				<td>
					<?php if(!empty($ks['zdjecie'])): ?>
						<img src="zdjecia/<?=$ks['zdjecie']?>" alt="<?=$ks['tytul']?>" />
					<?php else: ?>
						brak zdjęcia
					<?php endif; ?>
				</td>
				<td><a href="ksiazki.szczegoly.php?id=<?=$ks['id']?>" title="szczegóły"><b><?=$ks['tytul']?></b></a>
				<p><?=$ks['author']?></p></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>