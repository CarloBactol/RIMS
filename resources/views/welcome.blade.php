@extends('layouts.app')
@section('css-custom')
<style>
    body {
        background-color: #f8f9fa;
    }

    .jumbotron {
        /* background-color: #007bff; */
        color: #fff;
    }

    .feature {
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }
</style>
@endsection
@section('content')

{{-- <div class="jumbotron text-center">
    <h1 class="display-4">Residents Information Management System (RIMS)</h1>
    <p class="lead">Simplify. Organize. Connect.</p>
</div> --}}

<div class="container" id="about">
    <div class="row">
        <div class="col-md-6">
            <div class="feature">
                <h2>About RIMS</h2>
                <p>RIMS is a state-of-the-art system developed to simplify and optimize the handling of resident
                    information. From basic personal details to complex community analytics, RIMS is designed to be a
                    centralized hub for managing resident records securely and transparently.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="feature" id="features">
                <h2>Key Features</h2>
                <ul>
                    <li>Secure Data Storage</li>
                    <li>Efficient Record Management</li>
                    <li>Community Analytics</li>
                    <li>Communication Hub</li>
                    <li>User-Friendly Interface</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="feature" id="how-it-works">
        <h2>How RIMS Works</h2>
        <p>RIMS operates on a simple principle: centralization and accessibility. All resident data is stored in a
            secure database, accessible only to authorized personnel. Residents can update their information, and
            community leaders can utilize the system for effective governance.</p>
    </div>
</div>

@endsection