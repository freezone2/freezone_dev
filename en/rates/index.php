<?
//define('HEADER_SUB_CLASS', 'header-orders to-fixed h0');
define('CONTENT_SUB_CLASS', 'certificate-full');
//define('FOOTER_SUB_CLASS', 'footer-left footer-certificate footer-hide-info');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Rates");
?>

  <section class="section index-service-list has-drop tab<?=(NEW_DES == 1 ? ' container' : "")?>">
		<div class="index-service-in">
			<div class="section-wrap">
			<br /><br /><br /><br /><br /><br />
			
			<h2>Tariffs for sportsmen</h2>
			<!--
			<table class="prof-rates">
				<thead>
				<tr>
						<td rowspan="2">
						Rates
						</td>
						<td colspan="2">Tunnel 12/12'</td>
						<td colspan="2">Tunnel 17/17'</td>
				</tr>
				<tr>
						<td>Day</td>
						<td>Night</td>
						<td>Day</td>
						<td>Night</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td >
						15 minutes
						</td>
						<td>6 000 RUB</td>
						<td>5 000 RUB</td>
						<td>7 000 RUB</td>
						<td>6 000 RUB</td>
					</tr>
					<tr>
						<td>
						<div>
						30 minutes
						</td>
						<td>10 500 RUB</td>
						<td>8 500 RUB</td>
						<td>12 500 RUB</td>
						<td>10 500 RUB</td>
					</tr>
					<tr>
						<td>
						<div>
						60 minutes
						</td>
						<td>21 000 RUB</td>
						<td>17 000 RUB</td>
						<td>25 000 RUB</td>
						<td>21 000 RUB</td>
					</tr>
				</tbody>
			</table>

			<br /><br />
			<p class="inf-hint">* Night tariff in tunnel 12ft is valid from 01:00 to 16:00 on weekdays, from 01:00 to 10:00 on weekends (from Friday to Saturday and from Saturday to Sunday). <br />
			* The night tariff in the tunnel 17ft is valid from 01:00 to 10:00 any day.</p>
			<br /><br />
			
			-->
			12х12 tunnel: <br />
			Day rate 16.00-01.00 - 360 usd  <br />
			Nights rate 01.00-16.00 -  290 usd
			<br /> <br />
			17/17 tunnel:  <br />
			Day rate 10.00-01.00 - 420 usd  <br />
			Nights rate 01.00-10.00 - 360 usd
			
			</div>
			
			
			

			
		</div>
	</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>