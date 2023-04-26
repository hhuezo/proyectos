<div class="alert alert-info alert-dismissible text-center" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h2><strong><i class="fa fa-info-circle"></i></strong> Compra realizada correctamente.</h2>

	<div class="text-center">
		<?php if (\Session::get('id_tipo_factura')=='1'): ?>
			<a href="{{url('facturaPago',  \Session::get('cart_id') )}}" target="_blank">
					<button class="btn btn-success btn-round"    >
							<i class="material-icons">print</i>&nbsp;Imprimir Pedido

					</button>

			</a>
		<?php endif; ?>

		<?php if (\Session::get('id_tipo_factura')=='2'): ?>
			<a href="{{url('facturaPago',  \Session::get('cart_id') )}}" target="_blank">
					<button class="btn btn-success btn-round"    >
							<i class="material-icons">print</i>&nbsp;Imprimir Pedido

					</button>

			</a>
		<?php endif; ?>

		<?php if (\Session::get('id_tipo_factura')=='3'): ?>
			<a href="{{url('ticket',  \Session::get('cart_id') )}}" target="_blank">
					<button class="btn btn-success btn-round"    >
							<i class="material-icons">print</i>&nbsp;Imprimir Pedido

					</button>

			</a>
		<?php endif; ?>


	</div>

</div>
