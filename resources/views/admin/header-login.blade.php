<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @php
$site = \App\Models\Site::select('site_name','banner_image', 'favicon', 'hide_sitename')
->orderBy('updated_at', 'desc')->first();
@endphp
@if($site && $site->favicon)
<link rel="shortcut icon" href="{{ asset('storage/app/public/'.$site->favicon) }}" type="image/x-icon">
@endif
  <title>{{ $site->site_name }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('public/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('public/vendors/css/vendor.bundle.addons.css')}}">
  <link rel="stylesheet" href="{{asset('public/vendors/css/bootstrap.min.css')}}">
  <link  href="{{asset('public/vendors/css/bootstrap-icons.css')}}" rel="stylesheet">
  <link  href="{{asset('public/vendors/css/boxicons.min.css')}}" rel="stylesheet">
  <link  href="{{asset('public/vendors/css/quill.snow.css')}}" rel="stylesheet">
  <link  href="{{asset('public/vendors/css/quill.bubble.css')}}" rel="stylesheet">
  <link  href="{{asset('public/vendors/css/remixicon.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('public/css/horizontal-layout/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="" />
</head>

<body>


