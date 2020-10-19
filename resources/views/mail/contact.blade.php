@extends('layouts.master')
@section('content')
    <div class="pix_section pix-padding-v-40" id="section_forms_1" style="display: block;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-12 column ui-droppable">
					<div class="pix-content pix-padding-bottom-30">
						<h1 class="pix-black-gray-dark pix-no-margin-top">
							<span class="pix_edit_text"><strong>Neem contact op</strong></span>
						</h1>
						<h5 class="pix-black-gray-light pix-padding-bottom-30">
							<span class="pix_edit_text">Vul de gegevens hier onder in</span>
						</h5>
						<div class="text-center">
							<div class="pix-inline-block pix-fixed-width-480">	
							<form class="pix-padding-top-10 pix-padding-bottom-20" id="validation" method="POST" action="">
								{{ csrf_field() }}
									<div class="form-group">
									  <input type="text" class="form-control" name="first" placeholder="Voornaam" required>
									  <div class="invalid-feedback">
										Vul een voornaam in.
									  </div>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="mid" placeholder="Tussenvoegsel">
									</div>
								    <div class="form-group">
									  <input type="text" class="form-control" name="last" placeholder="Achternaam" required>
									  <div class="invalid-feedback">
										Vul een achternaam in.
									  </div>
								    </div>
							       <div class="form-group">
									<input type="email" class="form-control" name="email" placeholder="E-mail" required>
									<div class="invalid-feedback">
										Vul een geldige email in
									  </div>
								   </div>
								   
							       <div class="form-group">
								      <input type="text" class="form-control" name="phone" placeholder="Telefoonnummer (Niet verplicht)">
								    </div>
							       <div class="form-group">
                                    <textarea class="form-control" name="message" rows="5" placeholder="Typ hier je bericht..." required></textarea>
							       </div>
							       <button type="submit" href="succes" class="btn btn-primary btn-block small-text"><span><strong>Verstuur</strong></span></button>
							    </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js'></script>
	<script src="{{asset('js/validation.js')}}"></script>
@endsection