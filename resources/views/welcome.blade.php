@extends('layouts.app')
@section('content')
  @include('shared.slider')
  <div class='landing-top-section'>
  <section id="largest-community"> <!-- Largest community -->
    <div class="largest-brand-wrap">
      <div class="row brand-row">
        <div class="col-xs-12 col-md-4 brand-column">
          <div class="brand-item">
            <div class="item-img">
              <img src="{{asset('images/community.png')}}" class="img-responsive" alt="">
            </div>
            <div class="item-text">
              <h4>Largest Community</h4>
              <p>
                Be a part of our community
              </p>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-4 brand-column">
          <div class="brand-item">
            <div class="item-img">
              <img src="{{asset('images/tutor.png')}}" class="img-responsive" alt="">
            </div>
            <div class="item-text">
              <h4>Expert Tutors</h4>
              <p>
                Get assistance from your tutor
              </p>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-4 brand-column">
          <div class="brand-item">
            <div class="item-img">
              <img src="{{asset('images/access.png')}}" class="img-responsive" alt="">
            </div>
            <div class="item-text">
              <h4>Lifetime Access</h4>
              <p>
                Learn at your own time
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="online-learn">
    <div class="learn-anytime">
    <div class="col-lg-12">
      <div class="row learn-anytime-row">
        <div class="col-md-6 left-col">
          <h4>
            ONLINE LEARNING ASSISTANCE ANYTIME
          </h4>
          <h5>
            Find a tutor & solve your problem
          </h5>
          <p>
            Are your stuck with a problem that need immediate solution? Write down and get
            microtutoring help while at home or on the go. Registered experts are here to
            help from renowned institutions. Learn something new everyday.
          </p>
          <form class="search-form" role="search">
            <div class="input-group search-group-btn">
              <input type="text" class="form-control search-btn-input" placeholder="Username">
              <button type="submit" class="input-group-addon group-btn">
                Find a Tutor
              </button>
            </div>
            <!--<div class="form-group">-->
            <!--<input type="text" class="form-control" placeholder="Search">-->
            <!--</div>-->
          </form>
        </div>
        <div class="col-md-6 right-col"></div>
      </div>
    </div>
    </div>
  </section>
  </div>
  <section id="master-skill">
    <div class="skill">
      <h2 class="text-center">MASTER YOUR SKILLS</h2>
      <div class="skill-item-wrap">
        <div class="row skill-row text-center">
          <div class="col-md-6 col-xs-12 skill-col">
            <div class="item">
              <h2>ACADEMIC COURSES</h2>
              <p>Courses with details curriculum from expert tutors.</p>
              <a href="" class="primary-btn btn">Discover</a>
            </div>
          </div>
          <div class="col-md-6 col-xs-12 skill-col">
            <div class="item">
              <h2>SPECIAL COURSES</h2>
              <p>Special courses helps students/professionals to develop their skills.</p>
              <a href="" class="primary-btn btn">Discover</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="find-note-section">
    <div class='find-note-container'>
    </div>
  </section>
@stop