@extends('client.layouts.main')
@section('title',trans('allclient.home'))
@section('content')

<!--========================= FLEX SLIDER =====================-->
<section class="flexslider-container" id="flexslider-container-1">
  <!--slider -->
  @include('client.shared.slider')
  <!-- end slider -->
  @include('client.tour.search_tour')
</section>
@include('client.components.tour_offers')

<!--================ PACKAGES ==============-->

@include('client.components.flight_offers')


<!--==================== HIGHLIGHTS ====================-->
@include('client.components.hightlights')



<!--================ LATEST BLOG ==============-->
@include('client.components.lasted_blog')

<!--========================= NEWSLETTER-1 ==========================-->
@include('client.components.newsletter_1')

@endsection
@section('script1')
@endsection
