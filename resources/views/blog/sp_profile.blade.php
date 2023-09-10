
<?php
	$data = new stdClass();
	$data->title = $user->first_name . ' ' . $user->last_name;
	$data->image = $user->user_img;
?>
@include('blog.header',['post' => $data])

<section style="border-top: 1px solid #c9c9c9">
	 <div class="cover-image" style="background-image: url('https://angular-material.fusetheme.com/assets/images/pages/profile/cover.jpg'); height: 50vh; background-size: 100% auto; background-repeat: no-repeat; background-position: center;">
        <!-- Add any content you want to overlay on the cover image -->
    </div>
	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-md-3">
			 <div class="card" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="text-center mt-4">
                	@if($user->user_img)
                    <img src="{{asset('frontend-assets/images/users/'.$user->user_img)}}" alt="Profile Image" class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;">
                	@else
                    <img src="{{asset('frontend-assets/images/avt.jpeg')}}" alt="Profile Image" class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;">
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$user->first_name}} {{$user->last_name}}</h5>
                    <p class="card-text text-center">
                      @foreach(json_decode($user->category_id) as $key => $cat)
                        <span class="data-value text-soft">{{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>
                        @if ($key < count(json_decode($user->category_id)) - 1), 
                        @endif
                    @endforeach
                    </p>
                </div>
            </div>
			</div>
			<div class="col-md-8 ml-md-auto">
				<h2>About {{$user->first_name}} </h2>
				<div class="row mt-5 mb-5 border-bottom">
					<div class="col-md-6 d-flex">
						<p class="mr-4 font-weight-bold">Year of experience:</p>
						<p>{{ $user->experience }}</p>
					</div>
					<div class="col-md-6 d-flex">
						<p class="mr-4 font-weight-bold">Country:</p>
						<p>{{Acelle\Jobs\HelperJob::countryname($user->country)->name}}</p>
					</div>
					<div class="col-md-6 d-flex">
						<p class="mr-4 font-weight-bold">Location:</p>
						<p>{{ $user->address }}</p>
					</div>
					<div class="col-md-6">
						
					</div>
					
				</div>

				<h2>Biography</h2>
				<div class="row mb-5 border-bottom">
					<div class="col-md-12">
						<p>
						{{$user->biography}}
						</p>
					</div>
				</div>
				<h2>Gallery</h2>
				 <div class="row">
				  @foreach($user->gallery as  $key => $gallery)
				    <div class="col-md-4 mb-4 text-center">
				        <a href="#" data-toggle="modal" data-target="#imageModal" data-slide-to="{{ $key }}">
				            <img src="{{ asset('frontend-assets/images/'.$gallery->image)}}" alt="Image {{ $key + 1 }}" class="img-fluid gallery-img" style="max-height: 200px; min-height: 200px">
				        </a>
				    </div>
				    @endforeach
			        
			        <!-- Add more image columns as needed -->
			    </div>
			    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h5 class="modal-title" id="imageModalLabel">Gallery Slider</h5>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                </button>
			            </div>
			            <div class="modal-body">
			                <div id="imageSlider" class="carousel slide" data-ride="carousel">
			                    <div class="carousel-inner">
			                    	@foreach($user->gallery as $key => $gallery)
							        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
							            <img src="{{ asset('frontend-assets/images/'.$gallery->image)}}" alt="Image {{ $key + 1 }}" class="d-block w-100">
							        </div>
							        @endforeach
			                        <!-- Add more carousel items as needed -->
			                    </div>
			                    <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
			                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			                        <span class="sr-only">Previous</span>
			                    </a>
			                    <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
			                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
			                        <span class="sr-only">Next</span>
			                    </a>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			</div>
			
		</div>
		
	</div>
</section>

@include('blog.footer')
<script>
    jQuery(document).ready(function () {
        // Function to update the image slider on image click
        $('.gallery-img').click(function () {
            var slideTo = $(this).data('slide-to');
            $('#imageSlider').carousel(slideTo);
        });

        // Initialize the image slider when the modal is shown
        $('#imageModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var slideTo = button.data('slide-to');
            $('#imageSlider').carousel(slideTo);
        });
    });
</script>