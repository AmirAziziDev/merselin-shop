<div class="modal fade mt-5" id="removeFromWishlist{{$product->id}}">
	<div class="modal-dialog">
		<div class="modal-content wishlist">
			<div class="modal-footer flag">
				<button onClick="Livewire.emit('removeFromWishlist',{{ $product->id }})"
				        data-dismiss="modal"></button>
			</div>
		</div>
	</div>
</div>