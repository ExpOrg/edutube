@extends('layouts.app')
@section('content')
<div class='col-lg-12'>
 <div class='profile-top-bar'>
   <a class='edu-link-default' href='#'> Back to Profile </a>
 </div>
 <div class='row'>
  <div class='col-sm-3'>
    <div class="nav flex-column nav-pills edu-pill-wrapper" id="v-pills-tab" role="tablist" aria-orientation="vertical">
	  <a class="nav-link active" data-toggle="pill" href="#basic-info-tab" role="tab" aria-selected="true">Basic Information</a>
	  <a class="nav-link" data-toggle="pill" href="#contact-info-tab" role="tab" aria-selected="true">Contact Information</a>
	  <a class="nav-link" data-toggle="pill" href="#about-info-tab" role="tab" aria-selected="true">About Me</a>
	  <a class="nav-link" data-toggle="pill" href="#education-info-tab" role="tab" aria-selected="true">Education</a>
	  <a class="nav-link" data-toggle="pill" href="#language-info-tab" role="tab" aria-selected="true">Language</a>
	</div>
  </div>
  <div class='col-sm-9'>
    <div class="tab-content" id="v-pills-tabContent">
	  <div class="tab-pane fade show active" id="basic-info-tab" role="tabpanel">
        @include('users.profile._basic_info')
	  </div>
	  <div class="tab-pane fade" id="contact-info-tab" role="tabpanel">
        @include('users.profile._contact_info')
	  </div>
	  <div class="tab-pane fade" id="about-info-tab" role="tabpanel">
        @include('users.profile._about_info')
	  </div>
	  <div class="tab-pane fade" id="education-info-tab" role="tabpanel">
        @include('users.profile._education_info')
	  </div>
	  <div id='language-info-tab' class="tab-pane fade" role="tabpanel">
        @include('users.profile._language_info')
	  </div>
	</div>
  </div>
 </div>
</div>
@stop