@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <section class="page-intro"><div><p class="eyebrow">The person behind the plans</p><h1>Your profile.</h1><p class="lead">Your account information in one place.</p></div></section>

    <section class="panel profile-panel">
        @if($user)
            <div class="profile-heading"><div class="avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($user->full_name, 0, 1)) }}</div><div><h2>{{ $user->full_name }}</h2><p class="muted">{{ '@' . $user->username }}</p></div></div>
            <dl class="profile-details">
                <div><dt>Username</dt><dd>{{ $user->username }}</dd></div>
                <div><dt>Full name</dt><dd>{{ $user->full_name }}</dd></div>
                <div><dt>Email</dt><dd>{{ $user->email }}</dd></div>
            </dl>
        @else
            <div class="empty-state"><p>No profile is available.</p></div>
        @endif
    </section>
@endsection
