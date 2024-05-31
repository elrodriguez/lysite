
<div class="container page__container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center align-items-center" style="padding: 40px 0px;">
            <div class="image-der mr-3">
                <img src="assets/images/libro-blanco.jpg" alt="Card image cap" style="width: 70px; height: 70px; margin: auto;">
            </div>
            <div class="texto">
                <h5 class="mb-0" style="margin-left: -10px;">
                  <strong style="font-size: 1.8rem;letter-spacing: 0.0em;">CURSOS</strong>
                </h5>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-6" style="padding: 15px 0px;">
          <div class="row">
              <div class="col-md-4">
                  <img style="width: 100%;" src="assets/images/cursos/intro.jpg" class="card-img">
              </div>
              <div class="col-md-8">
                  <div>
                      <p class="p-medium">Aborda de manera adecuada la introducción al problema de estudio.</p>
                  </div>
                  <div>
                      <h5 class="mb-0">Videos: 5</h5>
                      <h5 class="mt-0">Guías:&nbsp;&nbsp;&nbsp;13</h5> 
                  </div>                    
                  <div class="rating" style="margin-top: -20px;">
                      <input type="radio" value="1" name="rate" id="star1">
                      <label for="star1" title="text"></label>
                      <input type="radio" value="2" name="rate" id="star2">
                      <label for="star2" title="text"></label>
                      <input type="radio" value="3" name="rate" id="star3">
                      <label for="star3" title="text"></label>
                      <input type="radio" value="4" name="rate" id="star4">
                      <label for="star4" title="text"></label>
                      <input type="radio" value="5" name="rate" id="star5">
                      <label for="star5" title="text"></label>
                  </div>
                  <div style="margin-top: -20px;">
                      <small class="mt-0">1 calificación</small>
                  </div> 
              </div>
          </div>
      </div>
      <div class="col-md-6" style="padding: 15px 0px;">
          <div class="row">
              <div class="col-md-4">
                  <img style="width: 100%;" src="assets/images/cursos/rp.jpg" class="card-img">
              </div>
              <div class="col-md-8">
                  <div>
                      <p class="p-medium">Identifica la problemática de estudio.</p>
                  </div>
                  <div>
                      <h5 class="mb-0">Videos: 5</h5>
                      <h5 class="mt-0">Guías:&nbsp;&nbsp;&nbsp;13</h5> 
                  </div>                    
                  <div class="rating" style="margin-top: -20px;">
                      <input type="radio" value="1" name="rate" id="star1">
                      <label for="star1" title="text"></label>
                      <input type="radio" value="2" name="rate" id="star2">
                      <label for="star2" title="text"></label>
                      <input type="radio" value="3" name="rate" id="star3">
                      <label for="star3" title="text"></label>
                      <input type="radio" value="4" name="rate" id="star4">
                      <label for="star4" title="text"></label>
                      <input type="radio" value="5" name="rate" id="star5">
                      <label for="star5" title="text"></label>
                  </div>
                  <div style="margin-top: -20px;">
                      <small class="mt-0">1 calificación</small>
                  </div> 
              </div>
          </div>
      </div>
      <div class="col-md-6" style="padding: 15px 0px;">
          <div class="row">
              <div class="col-md-4">
                  <img style="width: 100%;" src="assets/images/cursos/ad.jpg" class="card-img">
              </div>
              <div class="col-md-8">
                  <div>
                      <p class="p-medium">Aborda de manera adecuada la introducción al problema de estudio.</p>
                  </div>
                  <div>
                      <h5 class="mb-0">Videos: 5</h5>
                      <h5 class="mt-0">Guías:&nbsp;&nbsp;&nbsp;13</h5> 
                  </div>                    
                  <div class="rating" style="margin-top: -20px;">
                      <input type="radio" value="1" name="rate" id="star1">
                      <label for="star1" title="text"></label>
                      <input type="radio" value="2" name="rate" id="star2">
                      <label for="star2" title="text"></label>
                      <input type="radio" value="3" name="rate" id="star3">
                      <label for="star3" title="text"></label>
                      <input type="radio" value="4" name="rate" id="star4">
                      <label for="star4" title="text"></label>
                      <input type="radio" value="5" name="rate" id="star5">
                      <label for="star5" title="text"></label>
                  </div>
                  <div style="margin-top: -20px;">
                      <small class="mt-0">1 calificación</small>
                  </div> 
              </div>
          </div>
      </div>
    </div>
  </div>




<div class="container">
    @if (count($courses) > 0)
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-6">
                    <a class="card mb-3" style="text-decoration: none; color: inherit; transition: none !important;"
                        href="{{ route('academic_students_my_course', $course->id) }}">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ url($course->course_image) }}" class="card-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p>{{ $course->name }}</p>
                                    <div class="card-title-container">
                                        <h5 class="card-title">Videos:</h5>
                                        <h5 class="card-title">Guías:</h5>
                                    </div>
                                    <div class="rating-container">
                                        <span class="fa fa-star star"></span>
                                        <span class="fa fa-star star"></span>
                                        <span class="fa fa-star star"></span>
                                        <span class="fa fa-star star"></span>
                                        <span class="fa fa-star star"></span>
                                    </div>
                                    <div class="rating-text">
                                        <small>1 calificación</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
    <br>
</div>
