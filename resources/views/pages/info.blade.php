@extends('layouts.master')
@section('title')
<title>Informații clienți - Mirasoil</title>
@endsection
@section('extra-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
@section('content')
<div id="transport">
    <div class="columns-container">
		<div id="columns" class="container">
			<div class="row">
				<div id="center_column" class="center_column col-xs-12 col-sm-12">
					<article class="rte">
					    <h1 class="page-heading bottom-indent text-center pb-5">Informații utile clienți</h1>   <!---pb stands for padding bottom--->
						<div class="row">
							<div class="col-xs-12 col-sm-4">
								<div class="cms-block">
									<h3 class="page-subheading text-center pb-4" id="romania">Metoda de livrare-detalii importante</h3>
									<p><strong class="dark">Momentan, toate comenzile procesate online se achită <strong>ramburs la curier</strong>.</strong></p>
							
									<p>Comenzile sunt procesate telefonic, la adresa de email <a href="mailto:contact@mirasoil.ro">contact@mirasoil.ro</a> sau prin mesaj privat pe pagina de facebook pe care o găsiți <a href="https://www.facebook.com/mirasoil16/">aici</a>.</p>
									<p>În județul Alba, pentru comenzi sub 200 lei, taxa de expediere este de <strong>10 lei </strong>.</p>
									<p>Pentru expedierea coletelor folosim companiile de curierat rapid GLS și FanCourier.<br /></p>
									<p>*Având în vedere numărul mic de comenzi procesate online, suntem obligați să calculăm costul transportului pentru fiecare comandă în parte, fapt pentru care vă încurajăm să ne contactați telefonic sau la <a href="index.php#contact">adresa de email</a>.</p>
									<p>*Companiile de curierat sunt contactate în ziua în care doriți să achiziționați produse de la noi, exceptând zilele de sâmbătă și duminică, neavând un contact în prealabil cu acestea în momentul de față. </p>
								</div>
							</div>
						    <div class="col-xs-12 col-sm-4">
								<div class="cms-box">
									<h3 class="page-subheading text-center pb-4">Întrebări frecvente</h3>
									<p><strong class="dark">În această secțiune vor fi postate toate întrebările dumneavoastră</strong></p>
									<p>Cu ajutorul acestor întrebări încercăm să îmbunătățim calitatea vizitei dumneavoastră pe pagina noastră!<strong></strong> </p>
									<form method = "post" action = "#">
                                    <label for="exampleFormControlTextarea3">Postați întrebarea dumneavoastră:</label>
										<textarea rows="4" cols="35" name="question" id="exampleFormControlTextarea3">Introduceți întrebarea aici..</textarea>
                                        <br>
										<input type = "submit">
                                    </form>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="cms-box">
								<h3 class="page-subheading text-center pb-4">Ai comandat un produs de la noi ?</h3>
								<p><strong class="dark">Lasă-ne un review !</strong></p>
								<p>Ne dorim să aflăm părerea ta despre experiența cu produsele noastre. Fie că ești mulțumit sau ai anumite nemulțumiri, noi te încurajăm să îți exprimi părerea pentru a-i ajuta și pe ceilalți să își formeze o impresie !</p>
								<ul>
								    <li><p>Transmite-ne motivul pentru care ți-a plăcut/displăcut un produs</p></li>
								    <li><p>Spune-ne ce am putea îmbunătăți</p></li>
								    <li><p>Împărtășește cu noi motivul pentru care ai recomanda produsele și altor clienți</p></li>
							    </ul>
								<p><strong class="dark">Există situații în care review-urile pot fi respinse din cauza mai multor motive:</strong></p>
								<ul>
									<li><p>limbaj neadecvat</p></li>
									<li><p>folosirea datelor personale-evită includerea informațiilor legate de nume, adresă, număr de telefon, etc.</p></li>
									<li><p>detalii ce nu țin de produse - pentru acestea te rugăm să ne contactezi în <a href="index.php#contact">privat</a> </p></li>
								</ul>
								<p><i>Site-ul este încă în construcție, de aceea vă recomandăm verificarea periodică a acestuia pentru a fi la curent cu noutățile.</i></p>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection